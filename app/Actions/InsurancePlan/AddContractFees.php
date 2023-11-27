<?php

declare(strict_types=1);

namespace App\Actions\InsurancePlan;

use App\Http\Casts\InsurancePlan\ContractFeePatiensCast;
use App\Http\Casts\InsurancePlan\ContractFeeSpecificationWrapper;
use App\Http\Casts\InsurancePlan\ContractFeesRequestCast;
use App\Models\Company;
use App\Models\ContractFee;
use App\Models\ContractFeeSpecification;
use App\Models\HealthProfessional;
use App\Models\InsurancePlan;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class AddContractFees
{
    public function invoke(Collection $contractFees, InsurancePlan $insurance, User $user): Collection
    {
        return DB::transaction(function () use ($contractFees, $insurance, $user): Collection {
            $this->syncContractFee($insurance, $contractFees, $user->billing_company_id);

            return $contractFees->map(fn (ContractFeesRequestCast $contractFee) => tap(
                ContractFee::query()->updateOrCreate([
                    'id' => $contractFee->getId(),
                    'billing_company_id' => $contractFee->getBillingCompanyId(),
                ], [
                    'mac_locality_id' => $contractFee->getMacLocality()?->id,
                    'insurance_label_fee_id' => $contractFee->getInsuranceLabelFeeId(),
                    'contract_fee_type_id' => $contractFee->getTypeId(),
                    'start_date' => $contractFee->getStartDate(),
                    'private_note' => $contractFee->getPrivateNote(),
                    'end_date' => $contractFee->getEndDate(),
                    'price' => $contractFee->getPrice(),
                    'price_percentage' => $contractFee->getPricePercentage(),
                ]),
                fn (ContractFee $model) => $this->afterCreate(
                    $model,
                    $insurance,
                    $contractFee,
                )
            ))
            ->map(fn (ContractFee $contractFee) => $contractFee->load([
                'procedures',
                'patients',
                'modifiers',
                'macLocality',
                'companies',
            ]));
        });
    }

    private function afterCreate(
        ContractFee &$contractFee,
        InsurancePlan &$insurance,
        ContractFeesRequestCast $contractFeesRequest
    ): void {
        if (is_null($insurance->contractFees()->find($contractFee->id))) {
            $insurance->contractFees()->attach($contractFee->id);
        }

        $contractFee->procedures()->sync($contractFeesRequest->getProceduresIds());

        $contractFee->modifiers()->sync($contractFeesRequest->getModifierIds());

        $contractFee->companies()->sync($contractFeesRequest->getCompanyId());

        $contractFeesRequest->getPatients()->each(
            fn (ContractFeePatiensCast $patient) => $contractFee->patients()->attach($patient->getId(), [
                'start_date' => $patient->getStartDate(),
                'end_date' => $patient->getEndDate(),
                'created_at' => now(),
                'updated_at' => now(),
            ])
        );

        if ($contractFeesRequest->getHaveContractSpecifications()) {
            $contractFeesRequest->getContractSpecifications()->each(
                function (ContractFeeSpecificationWrapper $contractSpecification, int $contractFeeIndex) use ($contractFee): void {
                    $billingProvider = explode(':', $contractSpecification->getBillingProviderId());
                    $healthProfessional = explode(':', $contractSpecification->getHealthProfessionalId());

                    ContractFeeSpecification::updateOrCreate([
                        'id' => $contractSpecification->getId(),
                    ], [
                        'code' => $contractFee->id.$contractFeeIndex,
                        'contract_fee_id' => $contractFee->id,
                        'billing_provider_type' => ('healthProfessional' === $billingProvider[0]) ? HealthProfessional::class : Company::class,
                        'billing_provider_id' => $billingProvider[1],
                        'billing_provider_tax_id' => $contractSpecification->getBillingProviderTaxId(),
                        'billing_provider_taxonomy_id' => $contractSpecification->getBillingProviderTaxonomyId(),
                        'health_professional_id' => $healthProfessional[1] ?? null,
                        'health_professional_tax_id' => $contractSpecification->getHealthProfessionalTaxId(),
                        'health_professional_taxonomy_id' => $contractSpecification->getHealthProfessionalTaxonomyId(),
                    ]);
                }
            );
        } else {
            $contractFee->contractFeeSpecifications()->delete();
        }
    }

    private function syncContractFee(InsurancePlan $insurance, collection $contractFees, ?int $billingCompanyId): void
    {
        $insurance->contractFees()
            ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingCompanyId): void {
                $query->where('billing_company_id', $billingCompanyId);
            })
            ->get()
            ->each(function (ContractFee $contractFee) use ($insurance, $contractFees) {
                $contractFee->companies()->detach();
                $contractFee->procedures()->detach();
                $contractFee->modifiers()->detach();
                $contractFee->patients()->detach();

                $requestContractIds = $contractFees->map(
                    fn (ContractFeesRequestCast $services) => $services->getId()
                )->toArray();

                !in_array($contractFee->id, $requestContractIds)
                    ? $insurance->contractFees()->detach($contractFee->id)
                    : true;
            });
    }
}

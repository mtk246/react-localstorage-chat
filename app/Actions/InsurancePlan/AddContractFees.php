<?php

declare(strict_types=1);

namespace App\Actions\InsurancePlan;

use App\Http\Casts\InsurancePlan\ContractFeePatiensCast;
use App\Http\Casts\InsurancePlan\ContractFeeSpecificationWrapper;
use App\Http\Casts\InsurancePlan\ContractFeesRequestCast;
use App\Models\InsurancePlan;
use App\Models\ContractFee;
use App\Models\ContractFeeSpecification;
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
                    'mac_locality_id' => $contractFee->getMacLocality()->id,
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
                'insurancePlans',
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

        $contractFee->companies()->sync($contractFeesRequest->getCompanyIds());


        $contractFeesRequest->getPatients()->each(
            fn (ContractFeePatiensCast $patient) => $contractFee->patients()->attach($patient->getId(), [
                'start_date' => $patient->getStartDate(),
                'end_date' => $patient->getEndDate(),
                'created_at' => now(),
                'updated_at' => now(),
            ])
        );

        $contractFeesRequest->getContractSpecifications()->each(
            function (ContractFeeSpecificationWrapper $contractSpecification, int $contractFeeIndex) use ($contractFee): void {
                ContractFeeSpecification::updateOrCreate([
                    'id' => $contractSpecification->getId(),
                ], [
                    'code' => $contractFee->id.$contractFeeIndex,
                    'contract_fee_id' => $contractFee->id,
                    'billing_provider_id' => $contractSpecification->getBillingProviderId(),
                    'billing_provider_taxonomy_id' => $contractSpecification->getBillingProviderTaxonomyId(),
                    'health_professional_id' => $contractSpecification->getHealthProfessionalId(),
                    'health_professional_taxonomy_id' => $contractSpecification->getHealthProfessionalTaxonomyId(),
                ]);
            }
        );
    }

    private function syncContractFee(InsurancePlan $insurance, collection $contractFees, ?int $billingCompanyId): void
    {
        $insurance->contractFees()
            ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingCompanyId): void {
                $query->where('billing_company_id', $billingCompanyId);
            })
            ->whereNotIn('contract_fees.id', $contractFees->map(
                fn (ContractFeesRequestCast $services) => $services->getId()
            )->toArray())
            ->get()
            ->each(function (ContractFee $contractFee) use ($insurance) {
                $contractFee->procedures()->detach();
                $contractFee->patients()->detach();
                $contractFee->modifiers()->detach();
                $contractFee->insurancePlans()->detach();
                $insurance->contractFees()->detach($contractFee->id);
            });
    }
}

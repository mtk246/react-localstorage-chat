<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Http\Casts\Company\ContractFeePatiensCast;
use App\Http\Casts\Company\ContractFeeSpecificationWrapper;
use App\Http\Casts\Company\ContractFeesRequestCast;
use App\Models\Company;
use App\Models\ContractFee;
use App\Models\ContractFeeSpecification;
use App\Models\HealthProfessional;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class AddContractFees
{
    public function invoke(Collection $contractFees, Company $company, User $user): Collection
    {
        return DB::transaction(function () use ($contractFees, $company, $user): Collection {
            $this->syncContractFee($company, $contractFees, $user->billing_company_id);

            return $contractFees->map(function (ContractFeesRequestCast $contractFee) use ($company) {

                $contract = ContractFee::where([
                    'id' => $contractFee->getId(),
                    'billing_company_id' => $contractFee->getBillingCompanyId(),
                    'contract_fee_type_id' => $contractFee->getTypeId(),
                    'start_date' => $contractFee->getStartDate(),
                    'end_date' => $contractFee->getEndDate()
                ])->first();

                if ($contract) {
                    $contract->update([
                        'billing_company_id' => $contractFee->getBillingCompanyId(),
                        'contract_fee_type_id' => $contractFee->getTypeId(),
                        'start_date' => $contractFee->getStartDate(),
                        'end_date' => $contractFee->getEndDate(),
                        'insurance_label_fee_id' => $contractFee->getInsuranceLabelFeeId(),
                        'private_note' => $contractFee->getPrivateNote(),
                        'price' => $contractFee->getPrice(),
                        'price_percentage' => $contractFee->getPricePercentage(),
                    ]);
                }
                else {
                    $contract = ContractFee::create([
                        'billing_company_id' => $contractFee->getBillingCompanyId(),
                        'contract_fee_type_id' => $contractFee->getTypeId(),
                        'start_date' => $contractFee->getStartDate(),
                        'end_date' => $contractFee->getEndDate(),
                        'insurance_label_fee_id' => $contractFee->getInsuranceLabelFeeId(),
                        'private_note' => $contractFee->getPrivateNote(),
                        'price' => $contractFee->getPrice(),
                        'price_percentage' => $contractFee->getPricePercentage(),
                    ]);
                }

                $this->afterCreate(
                    $contract,
                    $company,
                    $contractFee,
                );

                return $contract;
            })
            ->map(fn (ContractFee $contractFee) => $contractFee->load([
                'procedures',
                'patients',
                'modifiers',
                'macLocality',
                'insurancePlans',
                'contractFeeSpecifications',
            ]));
        });
    }

    private function afterCreate(
        ContractFee &$contractFee,
        Company &$company,
        ContractFeesRequestCast $contractFeesRequest
    ): void {
        if (is_null($company->contractFees()->find($contractFee->id))) {
            $company->contractFees()->attach($contractFee->id);
        }

        $contractFee->procedures()->sync($contractFeesRequest->getProceduresIds());

        $contractFee->modifiers()->sync($contractFeesRequest->getModifierIds());

        $contractFee->insurancePlans()->sync($contractFeesRequest->getInsurancePlanIds());

        $contractFee->patients()->detach();
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
    }

    private function syncContractFee(Company $company, collection $contractFees, ?int $billingCompanyId): void
    {
        $company->contractFees()
            ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingCompanyId): void {
                $query->where('billing_company_id', $billingCompanyId);
            })
            ->whereNotIn('contract_fees.id', $contractFees->map(
                fn (ContractFeesRequestCast $services) => $services->getId()
            )->toArray())
            ->get()
            ->each(function (ContractFee $contractFee) use ($company) {
                $contractFee->procedures()->detach();
                $contractFee->patients()->detach();
                $contractFee->modifiers()->detach();
                $contractFee->insurancePlans()->detach();
                $company->contractFees()->detach($contractFee->id);
            });
    }
}

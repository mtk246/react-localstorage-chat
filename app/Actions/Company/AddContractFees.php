<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Http\Casts\Company\ContractFeePatiensCast;
use App\Http\Casts\Company\ContractFeeSpecificationWrapper;
use App\Http\Casts\Company\ContractFeesRequestCast;
use App\Models\Company;
use App\Models\ContractFee;
use App\Models\ContractFeeSpecification;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class AddContractFees
{
    public function invoke(Collection $contractFees, Company $company, User $user)
    {
        return DB::transaction(function () use ($contractFees, $company, $user): Collection {
            $this->syncContractFee($company, $contractFees, $user->billing_company_id);

            return $contractFees->map(fn (ContractFeesRequestCast $contractFeesRequest) => tap(
                ContractFee::query()->updateOrCreate(
                    ['id' => $contractFeesRequest->getId()],
                    $contractFeesRequest->wrapperContractFeesBody()
                ),
                function (ContractFee $contractFee) use ($contractFeesRequest, $company): void {
                    if (is_null($company->contractFees()->find($contractFee->id))) {
                        $company->contractFees()->attach($contractFee->id);
                    }

                    $contractFee->procedures()->sync($contractFeesRequest->getProceduresIds());

                    $contractFee->modifiers()->sync($contractFeesRequest->getModifierIds());

                    $contractFee->insurancePlans()->sync($contractFeesRequest->getInsurancePlanIds());

                    $contractFee->patients()->detach();
                    $contractFeesRequest->getPatients()->each(
                        fn (ContractFeePatiensCast $patient) => $contractFee->patients()->attach(
                            $patient->getId(),
                            $patient->wrapperPatientsBody()
                        )
                    );

                    $contractFeesRequest->getContractSpecifications()->each(
                        function (ContractFeeSpecificationWrapper $contractSpecification, int $contractFeeIndex) use ($contractFee): void {
                            $contractSpecificationRequestBody = $contractSpecification->wrapperContractFeesSpecificationBody();
                            $contractSpecificationRequestBody['code'] = $contractFee->id.$contractFeeIndex;
                            $contractSpecificationRequestBody['contract_fee_id'] = $contractFee->id;

                            ContractFeeSpecification::updateOrCreate(
                                ['id' => $contractSpecification->getId()],
                                $contractSpecificationRequestBody
                            );
                        }
                    );
                }
            ))->map(fn (ContractFee $contractFee) => $contractFee->load([
                'procedures',
                'patients',
                'modifiers',
                'macLocality',
                'insurancePlans',
                'contractFeeSpecifications',
            ]));
        });
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

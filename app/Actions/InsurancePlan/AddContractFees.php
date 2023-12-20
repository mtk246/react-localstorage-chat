<?php

declare(strict_types=1);

namespace App\Actions\InsurancePlan;

use App\Http\Casts\InsurancePlan\ContractFeePatiensCast;
use App\Http\Casts\InsurancePlan\ContractFeeSpecificationWrapper;
use App\Http\Casts\InsurancePlan\ContractFeesRequestCast;
use App\Models\ContractFee;
use App\Models\ContractFeeSpecification;
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

            return $contractFees->map(fn (ContractFeesRequestCast $contractFeesRequest) => tap(
                ContractFee::query()->updateOrCreate(
                    ['id' => $contractFeesRequest->getId()],
                    $contractFeesRequest->wrapperContractFeesBody()
                ),
                function (ContractFee $contractFee) use ($contractFeesRequest, $insurance): void {
                    if (is_null($insurance->contractFees()->find($contractFee->id))) {
                        $insurance->contractFees()->attach($contractFee->id);
                    }

                    $contractFee->procedures()->sync($contractFeesRequest->getProceduresIds());

                    $contractFee->modifiers()->sync($contractFeesRequest->getModifierIds());

                    $contractFee->companies()->sync($contractFeesRequest->getCompanyId());

                    $contractFeesRequest->getPatients()->each(
                        fn (ContractFeePatiensCast $patient) => $contractFee->patients()->attach(
                            $patient->getId(),
                            $patient->wrapperPatientsBody()
                        )
                    );

                    if ($contractFeesRequest->getHaveContractSpecifications()) {
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
                    } else {
                        $contractFee->contractFeeSpecifications()->delete();
                    }
                }
            ))->map(fn (ContractFee $contractFee) => $contractFee->load([
                'procedures',
                'patients',
                'modifiers',
                'macLocality',
                'companies',
                'contractFeeSpecifications',
            ]));
        });
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

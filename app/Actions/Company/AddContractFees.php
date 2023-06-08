<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Http\Casts\Company\ContractFeePatiensCast;
use App\Http\Casts\Company\ContractFeesRequestCast;
use App\Models\Company;
use App\Models\ContractFee;
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
            $this->syncContractFee($company, $contractFees, $user->billingCompanies->first()?->id);

            $contractFees->each(fn (ContractFeesRequestCast $contractFee) => tap(
                ContractFee::query()->updateOrCreate([
                    'id' => $contractFee->getId(),
                    'billing_company_id' => $contractFee->getBillingCompanyId(),
                ], [
                    'company_id' => $company->id,
                    'mac_locality_id' => $contractFee->getMacLocality()->id,
                    'insurance_company_id' => $contractFee->getInsuranceCompanyId(),
                    'insurance_plan_id' => $contractFee->getInsurancePlanId(),
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
                    $contractFee,
                )
            ));

            return $company->contracFees()->with([
                'procedures',
                'patiens',
                'modifiers',
                'macLocality',
                'insuranceCompany',
            ])->get();
        });
    }

    private function afterCreate(ContractFee $contractFee, ContractFeesRequestCast $contractFeesRequest): void
    {
        $contractFeesRequest->getProceduresIds()->each(
            fn (int $procedureId) => $contractFee->procedures()->attach($procedureId)
        );

        $contractFeesRequest->getModifierIds()->each(
            fn (int $modifierId) => $contractFee->modifiers()->attach($modifierId)
        );

        $contractFeesRequest->getPatiens()->each(
            fn (ContractFeePatiensCast $patien) => $contractFee->patiens()->attach($patien->getId(), [
                'start_date' => $patien->getStartDate(),
                'end_date' => $patien->getEndDate(),
                'created_at' => now(),
                'updated_at' => now(),
            ])
        );
    }

    private function syncContractFee(Company $company, collection $contractFees, ?int $billingCompanyId): void
    {
        ContractFee::query()
            ->where('company_id', $company->id)
            ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingCompanyId): void {
                $query->where('billing_company_id', $billingCompanyId);
            })
            ->whereNotIn('id', $contractFees->map(
                fn (ContractFeesRequestCast $services) => $services->getId()
            )->toArray())
            ->get()
            ->each(function (ContractFee $contractFee) {
                $contractFee->procedures()->detach();
                $contractFee->patiens()->detach();
                $contractFee->modifiers()->detach();
                $contractFee->delete();
            });
    }
}

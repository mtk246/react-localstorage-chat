<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Http\Requests\Casts\ContractFeePatiensCast;
use App\Http\Requests\Casts\ContractFeesRequestCast;
use App\Models\Company;
use App\Models\ContractFee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class AddContractFees
{
    public function invoke(Collection $contractFees, Company $company): Collection
    {
        return DB::transaction(function () use ($contractFees, $company): Collection {
            $company->contracFees()->update(['company_id' => null]);

            $contractFees->each(fn (ContractFeesRequestCast $contractFee) => tap(
                ContractFee::create([
                    'company_id' => $company->id,
                    'modifier_id' => $contractFee->getModifierId(),
                    'mac_locality_id' => $contractFee->getMacLocality()->id,
                    'insurance_plan_id' => $contractFee->getInsurancePlanId(),
                    'billing_company_id' => $contractFee->getBillingCompanyId(),
                    'insurance_label_fee_id' => $contractFee->getInsuranceLabelFeeId(),
                    'contract_fee_type_id' => $contractFee->getTypeId(),
                    'start_date' => $contractFee->getStartDate(),
                    'end_date' => $contractFee->getEndDate(),
                    'price' => $contractFee->getPrice(),
                    'price_percentage' => $contractFee->getPricePercentage(),
                ]),
                fn (ContractFee $model) => $this->afterCreate(
                    $model,
                    $contractFee,
                )
            ));

            return $company->contracFees()->with(['procedures', 'patiens'])->get();
        });
    }

    private function afterCreate(ContractFee $contractFee, ContractFeesRequestCast $contractFeesRequest): void
    {
        $contractFeesRequest->getProceduresIds()->each(
            fn (int $procedureId) => $contractFee->procedures()->attach($procedureId)
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
}
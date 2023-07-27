<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Resources\RequestWrapedResource;
use App\Models\ContractFee;
use App\Models\InsurancePlan;
use App\Models\Modifier;
use App\Models\Procedure;

/**
 * @property ContractFee $resource
 */
final class ContractFeeResource extends RequestWrapedResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'billing_company_id' => $this->resource->billing_company_id,
            'type_id' => $this->resource->contract_fee_type_id,
            'procedure_ids' => $this->resource->procedures
                ->map(fn (Procedure $procedure) => $procedure->id)->toArray(),
            'procedures' => $this->resource->procedures
                ->map(function (Procedure $procedure) {
                    return [
                        'id' => $procedure->id,
                        'name' => $procedure->code,
                        'description' => $procedure->description,
                    ];
                })->toArray(),
            'insurance_plan_ids' => $this->resource->insurancePlans
                ->map(fn (InsurancePlan $insurance) => $insurance->id)->toArray(),
            'insurance_plans' => $this->resource->insurancePlans
                ->map(function (InsurancePlan $insurance) {
                    return [
                        'id' => $insurance->id,
                        'name' => $insurance->name,
                    ];
                })->toArray(),
            'modifier_ids' => $this->resource->modifiers
                ->map(fn (Modifier $modifier) => $modifier->id)->toArray(),
            'modifiers' => $this->resource->modifiers
                ->map(function (Modifier $modifier) {
                    return [
                        'id' => $modifier->id,
                        'modifier' => $modifier->modifier,
                        'description' => $modifier->description,
                        'color' => $modifier->classification->getColor(),
                    ];
                })->toArray(),
            'patients' => $this->resource->patients ?? [],
            'contract_specifications' => $this->resource->contractFeeSpecifications ?? [],
            'mac' => $this->resource->macLocality?->mac,
            'locality_number' => $this->resource->macLocality?->locality_number,
            'state' => $this->resource->macLocality?->state,
            'fsa' => $this->resource->macLocality?->fsa,
            'counties' => $this->resource->macLocality?->counties,
            'insurance_label_fee_id' => $this->resource->insurance_label_fee_id,
            'price' => (float) $this->resource->price,
            'price_percentage' => (float) $this->resource->price_percentage,
            'private_note' => $this->resource->private_note,
        ];
    }
}

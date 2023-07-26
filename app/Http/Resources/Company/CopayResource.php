<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Resources\RequestWrapedResource;
use App\Models\Copay;
use App\Models\InsurancePlan;
use App\Models\Procedure;

/**
 * @property Copay $resource
 */
final class CopayResource extends RequestWrapedResource
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
            'private_note' => $this->resource->private_note,
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Resources\RequestWrapedResource;
use App\Models\CompanyProcedure;
use App\Models\Modifier;
use App\Models\Procedure;

/**
 * @property CompanyProcedure $resource
 */
final class ServiceResource extends RequestWrapedResource
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
            'modifier_ids' => $this->resource->modifiers
                ->map(fn (Modifier $modifier) => $modifier->id)->toArray(),
            'modifiers' => $this->resource->modifiers
                ->map(function (Modifier $modifier) {
                    return [
                        'id' => $modifier->id,
                        'modifier' => $modifier->modifier,
                        'color' => $modifier->classification->getColor(),
                    ];
                })->toArray(),
            'mac' => $this->resource->macLocality?->mac,
            'locality_number' => $this->resource->macLocality?->locality_number,
            'state' => $this->resource->macLocality?->state,
            'fsa' => $this->resource->macLocality?->fsa,
            'counties' => $this->resource->macLocality?->counties,
            'insurance_label_fee_id' => $this->resource->insurance_label_fee_id,
            'price' => (float) $this->resource->price,
            'price_percentage' => (float) $this->resource->price_percentage,
            'clia' => $this->resource->clia,
            'medication_application' => !empty($this->resource->medication),
            'medication' => !empty($this->resource->medication)
                ? MedicationResource::make($this->resource->medication)
                : null,
        ];
    }
}

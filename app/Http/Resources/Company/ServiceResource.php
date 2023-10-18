<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Resources\RequestWrapedResource;
use App\Models\CompanyProcedure;
use Cknow\Money\Money;

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
            'procedure_id' => $this->resource->procedure_id,
            'procedure' => (isset($this->resource->procedure))
                ? [
                    'id' => $this->resource->procedure->id,
                    'name' => $this->resource->procedure->code,
                    'description' => $this->resource->procedure->description,
                ]
                : null,
            'revenue_code_id' => $this->resource->revenue_code_id,
            'revenue_code' => (isset($this->resource->revenueCode))
                ? [
                    'id' => $this->resource->revenueCode->id,
                    'name' => $this->resource->revenueCode->code,
                    'description' => $this->resource->revenueCode->description,
                ]
                : null,
            'modifier_id' => $this->resource->modifier_id,
            'modifier' => (isset($this->resource->modifier))
                    ? [
                        'id' => $this->resource->modifier->id,
                        'modifier' => $this->resource->modifier->modifier,
                        'color' => $this->resource->modifier->classification->getColor(),
                    ]
                    : null,
            'mac' => $this->resource->macLocality?->mac,
            'locality_number' => $this->resource->macLocality?->locality_number,
            'state' => $this->resource->macLocality?->state,
            'fsa' => $this->resource->macLocality?->fsa,
            'counties' => $this->resource->macLocality?->counties,
            'insurance_label_fee_id' => $this->resource->insurance_label_fee_id,
            'price' => Money::parse($this->resource->price, null, true)->formatByDecimal(),
            'price_percentage' => Money::parse($this->resource->price_percentage, null, true)->formatByDecimal(),
            'clia' => $this->resource->clia,
            'medication_application' => !empty($this->resource->medication),
            'medication' => !empty($this->resource->medication)
                ? MedicationResource::make($this->resource->medication)
                : null,
        ];
    }
}

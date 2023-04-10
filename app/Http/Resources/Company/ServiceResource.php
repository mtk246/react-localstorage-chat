<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Resources\RequestWrapedResource;
use App\Models\CompanyProcedure;

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
            'description' => $this->resource->procedure->description,
            'modifier_id' => $this->resource->modifier_id,
            'mac' => $this->resource->macLocality->mac,
            'locality_number' => $this->resource->macLocality->locality_number,
            'state' => $this->resource->macLocality->state,
            'fsa' => $this->resource->macLocality->fsa,
            'counties' => $this->resource->macLocality->counties,
            'insurance_label_fee_id' => $this->resource->insurance_label_fee_id,
            'price' => $this->resource->price,
            'price_percentage' => $this->resource->price_percentage,
            'clia' => $this->resource->clia,
            'medication_application' => $this->resource->medications->count() > 0,
            'medications' => MedicationResource::collection($this->resource->medications),
        ];
    }
}

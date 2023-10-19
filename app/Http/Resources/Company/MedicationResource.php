<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Resources\RequestWrapedResource;
use App\Models\Medication;

/**
 * @property Medication $resource
 */
final class MedicationResource extends RequestWrapedResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'code' => $this->resource->code,
            'drug_code' => $this->resource->drug_code,
            'measurement_unit_id' => $this->resource->measurement_unit_id?->value,
            'measurement_unit' => !empty($this->resource->measurement_unit_id)
                ? $this->resource->measurement_unit_id->getCode().' - '.$this->resource->measurement_unit_id->getDescription()
                : '',
            'units' => (float) $this->resource->units ?? '',
            'units_limit' => (((int) $this->resource->units_limit) > 0) ? (int) $this->resource->units_limit : '',
            'link_sequence_number' => $this->resource->link_sequence_number ?? '',
            'pharmacy_prescription_number' => $this->resource->pharmacy_prescription_number ?? '',
            'repackaged_NDC' => $this->resource->repackaged_NDC ?? false,
            'code_NDC' => $this->resource->code_NDC ?? '',
            'claim_note_required' => (bool) $this->resource->claim_note_required ?? false,
            'note' => $this->resource->note ?? '',
        ];
    }
}

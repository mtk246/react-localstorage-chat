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
            'batch' => $this->resource->batch,
            'quantity' => $this->resource->quantity,
            'frequency' => $this->resource->frequency,
            'date' => $this->resource->date,
        ];
    }
}

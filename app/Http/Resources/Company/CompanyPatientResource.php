<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Casts\Company\UpdatePatientRequest;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property $resource
 * @property UpdatePatientRequest $request
 */
final class CompanyPatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->pivot->id,
            'patient_id' => $this->resource->pivot->patient_id,
            'med_num' => $this->resource->pivot->med_num ?? '',
            'billing_company_id' => $this->resource->pivot->billing_company_id,
        ];
    }
}

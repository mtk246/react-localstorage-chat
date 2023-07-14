<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Models\Facility;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Facility $resource */
final class FacilityResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request): array
    {
        return [
            'billing_company_id' => $this->resource->pivot->billing_company_id,
            'facility_id' => $this->resource->id,
            'billing_company' => $this->resource->billingCompanies()->find(
                $this->resource->pivot->billing_company_id,
            )->name ?? '',
            'facility' => $this->resource->name,
            'facility_types' => $this->resource->facilityTypes ?? [],
        ];
    }
}

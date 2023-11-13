<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Http\Resources\Company\TaxonomiesResource;
use App\Models\Facility;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Facility $resource */
final class FacilityResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'npi' => $this->resource->npi,
            'facility_name' => $this->resource->name,
            'code' => $this->resource->code,
            'nppes_verified_at' => $this->resource->nppes_verified_at,
            'other_name' => $this->resource->other_name,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'taxonomies' => TaxonomiesResource::collection(
                $this->resource->taxonomies()->orderBy('id')->get()
            ),
            'place_of_services' => $this->resource->placeOfServices,
            'facility_types' => $this->resource->facilityTypes,
            'bill_classifications' => $this->resource->billClassifications,
        ];
    }
}

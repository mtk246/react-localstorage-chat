<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Models\Claims\ClaimDemographicInformation;
use App\Models\Facility;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property ClaimDemographicInformation $resource */
final class FacilityResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        $taxonomyData = [];
        $placeOfServicesData = [];
        $facilityTypesData = [];
        $billClassificationsData = [];

        $facility = Facility::with(
            'taxonomies',
            'placeOfServices',
            'facilityTypes',
            'billClassifications'
        )
            ->find($this->resource->facility_id);

        $taxonomies = $facility->taxonomies ?? [];
        $placeOfServices = $facility->placeOfServices ?? [];
        $facilityTypes = $facility->facilityTypes ?? [];
        $billClassifications = $facility->billClassifications ?? [];

        foreach ($taxonomies as $taxonomy) {
            $taxonomyData[] = [
                'taxonomy_id' => $taxonomy->id,
                'taxonomy_tax_id' => $taxonomy->tax_id,
                'taxonomy_name' => $taxonomy->name,
                'is_primary' => $taxonomy->primary,
                'created_at' => $taxonomy->created_at,
                'updated_at' => $taxonomy->updated_at,
            ];
        }

        foreach ($placeOfServices as $pos) {
            $placeOfServicesData[] = [
                'id' => $pos->id,
                'name' => $pos->name,
                'code' => $pos->code,
                'created_at' => $pos->created_at,
                'updated_at' => $pos->updated_at,
            ];
        }

        foreach ($facilityTypes as $ft) {
            $facilityTypesData[] = [
                'id' => $ft->id,
                'type' => $ft->type,
                'code' => $ft->code,
                'created_at' => $ft->created_at,
                'updated_at' => $ft->updated_at,
            ];
        }

        foreach ($billClassifications as $bC) {
            $billClassificationsData[] = [
                'id' => $bC->id,
                'name' => $bC->name,
                'code' => $bC->code,
                'created_at' => $bC->created_at,
                'updated_at' => $bC->updated_at,
            ];
        }

        $commonFields = [
            'id' => $facility->id,
            'npi' => $facility->npi,
            'facility_name' => $facility->name,
            'code' => $facility->code,
            'nppes_verified_at' => $facility->nppes_verified_at,
            'other_name' => $facility->other_name,
            'created_at' => $facility->created_at,
            'updated_at' => $facility->updated_at,
            'taxonomies' => $taxonomyData,
            'place_of_services' => $placeOfServices,
            'facility_types' => $facilityTypes,
            'bill_classifications' => $billClassifications,
        ];

        return $commonFields;
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim;

use App\Models\Claims\ClaimDemographicInformation;
use App\Models\Company;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property ClaimDemographicInformation $resource */
final class CompanyResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /** @return array<string, mixed> */
    public function toArray($request): array
    {
        $company = Company::with('taxonomies')->find($this->resource->company_id);
        $taxonomies = $company->taxonomies;
        $taxonomyData = [];

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

        $commonFields = [
            'id' => $company->id,
            'npi' => $company->npi,
            'company_name' => $company->name,
            'code' => $company->code,
            'ein' => $company->ein,
            'taxonomies' => $taxonomyData,
        ];

        return $commonFields;
    }
}

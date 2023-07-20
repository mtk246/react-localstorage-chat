<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Casts\Company\UpdateCompanyRequestCast;
use App\Http\Resources\RequestWrapedResource;
use App\Models\Company;

/** @property Company $resource */
final class CompanyDataResource extends RequestWrapedResource
{
    /**
     * @param UpdateCompanyRequestCast $request
     *
     * @return array<key, string>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'npi' => $this->resource->npi,
            'ein' => $this->resource->ein,
            'clia' => $this->resource->clia ?? '',
            'name' => $this->resource->name,
            'abbreviation' => $this->resource
                ->abbreviations()
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->first()?->abbreviation ?? '',
            'nickname' => $this->resource
                ->nicknames()
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->first()?->nickname ?? '',
            'miscellaneous' => $this->resource
                ->billingCompanies()
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->first()?->pivot?->miscellaneous ?? '',
            'claim_format_ids' => $this->resource
                ->billingCompanies()
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->first()?->pivot?->claim_format_ids ?? [],
            'other_name' => $this->resource->other_name ?? '',
            'taxonomies' => TaxonomiesResource::collection(
                $this->resource->taxonomies()->orderBy('id')->get()
            ),
        ];
    }
}

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
            'npi' => $this->resource->npi,
            'ein' => $this->resource->ein,
            'upin' => $this->resource->upin,
            'clia' => $this->resource->clia,
            'name' => $this->resource->name,
            'abbreviation' => $this->resource
                ->abbreviations()
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->first()?->abbreviation,
            'nickname' => $this->resource
                ->nicknames()
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->first()?->nickname,
            'taxonomies' => TaxonomiesResource::collection(
                $this->resource->taxonomies()->orderBy('id')->get()
            ),
            
        ];
    }
}

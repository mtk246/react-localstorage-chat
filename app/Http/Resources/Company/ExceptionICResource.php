<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Casts\Company\StoreExceptionICRequestCast;
use App\Http\Resources\RequestWrapedResource;
use App\Models\ExceptionInsuranceCompany;

/**
 * @property ExceptionInsuranceCompany $resource
 * @property StoreExceptionICRequestCast $request
 */
final class ExceptionICResource extends RequestWrapedResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'billing_company_id' => $this->resource->billing_company_id,
            'billing_company' => $this->resource->billingCompany->name ?? '',
            'insurance_company_id' => $this->resource->insurance_company_id,
            'insurance_company' => $this->resource->insuranceCompany?->name ?? '',
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}

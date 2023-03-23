<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Casts\Company\StoreExectionICRequestCast;
use App\Http\Resources\RequestWrapedResource;
use App\Models\ExceptionInsuranceCompany;

/**
 * @property ExceptionInsuranceCompany $resource
 * @property StoreExectionICRequestCast $request
 */
final class ExectionICResource extends RequestWrapedResource
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
            'insurance_company_id' => $this->resource->insurance_company_id,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}

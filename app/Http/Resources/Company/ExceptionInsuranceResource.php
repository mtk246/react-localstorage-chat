<?php

declare(strict_types=1);

namespace App\Http\Resources\Company;

use App\Http\Resources\RequestWrapedResource;
use App\Models\ExceptionInsuranceCompany;
use App\Models\InsurancePlan;

/**
 * @property ExceptionInsuranceCompany $resource
 */
final class ExceptionInsuranceResource extends RequestWrapedResource
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
            'insurance_plan_ids' => $this->resource->insurance_plan_ids ?? [],
            'insurance_plans' => array_map(fn ($modelId) => [
                'id' => $modelId,
                'name' => InsurancePlan::find($modelId)?->name ?? '',
            ], $this->resource->insurance_plan_ids ?? []),
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Resources\InsurancePlan;

use App\Http\Resources\RequestWrapedResource;
use App\Models\Company;
use App\Models\Copay;
use App\Models\Procedure;

/**
 * @property Copay $resource
 */
final class CopayResource extends RequestWrapedResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'billing_company_id' => $this->resource->billing_company_id,
            'procedure_ids' => $this->resource->procedures
                ->map(fn (Procedure $procedure) => $procedure->id)->toArray(),
            'procedures' => $this->resource->procedures
                ->map(function (Procedure $procedure) {
                    return [
                        'id' => $procedure->id,
                        'name' => $procedure->code,
                        'description' => $procedure->description,
                    ];
                })->toArray(),
            'companies_ids' => $this->resource->companies
                ->map(fn (Company $company) => $company->id)->toArray(),
            'companies' => $this->resource->companies
                ->map(function (Company $company) {
                    return [
                        'id' => $company->id,
                        'name' => $company->name,
                    ];
                })->toArray(),
            'copay' => (float) $this->resource->copay,
            'private_note' => $this->resource->private_note,
        ];
    }
}

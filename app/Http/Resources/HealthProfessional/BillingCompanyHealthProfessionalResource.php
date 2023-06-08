<?php

declare(strict_types=1);

namespace App\Http\Resources\HealthProfessional;

use Illuminate\Http\Resources\Json\JsonResource;

/**  @property BillingCompanyHealthProfessionalResource $resource */
final class BillingCompanyHealthProfessionalResource extends JsonResource
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
            'is_provider' => $this->resource->is_provider,
            'npi_company' => $this->resource->npi_company,
            'company_id' => $this->resource->company_id,
            'status' => $this->resource->status,
            'billing_companies' => $this->resource->billingCompanies,
        ];
    }
}

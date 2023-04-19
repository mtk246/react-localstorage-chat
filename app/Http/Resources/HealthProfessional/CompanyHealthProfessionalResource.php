<?php

declare(strict_types=1);

namespace App\Http\Resources\HealthProfessional;

use App\Models\CompanyHealthProfessional;
use Illuminate\Http\Resources\Json\JsonResource;

/**  @property CompanyHealthProfessional $resource */
final class CompanyHealthProfessionalResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'company_id' => $this->resource->company_id,
            'company_name' => $this->resource->company->name,
            'billing_company_id' => $this->resource->billing_company_id,
            'billing_company_name' => $this->resource->billingCompany->name,
            'health_professional_id' => $this->resource->health_professional_id,
            'authorization' => AuthorizationResource::collection($this->resource->authorization),
        ];
    }
}

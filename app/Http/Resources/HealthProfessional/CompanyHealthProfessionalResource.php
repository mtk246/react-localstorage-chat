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
            'health_professional_id' => $this->resource->health_professional_id,
            'authorization' => $this->resource->authorization,
        ];
    }
}

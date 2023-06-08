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
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

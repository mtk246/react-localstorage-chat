<?php

declare(strict_types=1);

namespace App\Http\Resources\Permissions;

use App\Models\BillingCompany\MembershipRole;
use Illuminate\Http\Resources\Json\JsonResource;

/**  @property MembershipRole $resource */
final class RoleResource extends JsonResource
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
            'name' => $this->resource->name,
            'note' => $this->resource->description,
            'billing_company_id' => $this->resource->billing_company_id,
            'billing_company' => $this->resource->billingCompany,
            'permissions' => PermitResource::collection($this->resource->permits),
        ];
    }
}

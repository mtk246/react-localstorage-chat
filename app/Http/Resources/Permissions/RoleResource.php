<?php

declare(strict_types=1);

namespace App\Http\Resources\Permissions;

use App\Models\User\Role;
use Illuminate\Http\Resources\Json\JsonResource;

/**  @property Role $resource */
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
            'permissions' => PermitResource::collection($this->resource->permissions),
            'create_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Roles\Models\Role;
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
            'slug' => $this->resource->slug,
            'description' => $this->resource->description,
            'level' => $this->resource->level,
            'set_at' => $this->resource?->pivot?->updated_at,
        ];
    }
}

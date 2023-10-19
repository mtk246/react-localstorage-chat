<?php

declare(strict_types=1);

namespace App\Http\Resources\Permissions;

use App\Models\Permissions\Permission;
use Illuminate\Http\Resources\Json\JsonResource;

/**  @property Permission $resource */
final class PermitResource extends JsonResource
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
            'name' => $this->resource->name,
            'slug' => $this->resource->slug,
            'description' => $this->resource->description,
            'module' => $this->resource->module,
            'constraint' => $this->resource->constraint,
        ];
    }
}

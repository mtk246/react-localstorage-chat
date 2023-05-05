<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Http\Resources\Enums\ColorsTypeResource;
use App\Http\Resources\Enums\ColorTypeResource;
use App\Models\Modifier;

/**
 * @property Modifier $resource
 */
final class ModifierResource extends RequestWrapedResource
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
            'modifier' => $this->resource->modifier,
            'special_coding_instructions' => $this->resource->special_coding_instructions,
            'active' => $this->resource->active,
            'start_date' => $this->resource->start_date,
            'end_date' => $this->resource->end_date,
            'classification' => new ColorTypeResource($this->resource->classification),
            'type' => new ColorsTypeResource($this->resource->type),
            'description' => $this->resource->description,
            'public_note' => $this->resource->publicNote,
            'modifier_invalid_combinations' => $this->resource->modifierInvalidCombinations,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
            'last_modified' => $this->resource->last_modified,
        ];
    }
}

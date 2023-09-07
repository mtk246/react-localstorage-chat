<?php

declare(strict_types=1);

namespace App\Http\Resources\Procedure;

use App\Models\Modifier;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property Modifier $resource */
final class ListModifierResource extends JsonResource
{
    /** @param \Illuminate\Http\Request $request */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'code' => $this->resource->modifier,
            'color' => $this->resource->classification->getColor(),
            'name' => $this->resource->modifier,
            'description' => $this->resource->description,
        ];
    }
}

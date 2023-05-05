<?php

declare(strict_types=1);

namespace App\Http\Resources\Enums;

use App\Enums\Interfaces\ColorTypeInterface;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property ColorTypeInterface $resource */
final class ColorTypeResource extends JsonResource
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
            'id' => $this->resource->value,
            'color' => $this->resource->getColor(),
            'name' => $this->resource->getName(),
        ];
    }
}

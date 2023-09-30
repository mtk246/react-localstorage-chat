<?php

declare(strict_types=1);

namespace App\Http\Resources\Enums;

use App\Enums\Interfaces\ColorsTypeInterface;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property ColorsTypeInterface $resource */
final class ColorsTypeResource extends JsonResource
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
            'colors' => [
                'background' => $this->resource->getBackgroundColor(),
                'text' => $this->resource->getTextColor(),
            ],
            'name' => $this->resource->getName(),
        ];
    }
}

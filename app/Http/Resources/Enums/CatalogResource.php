<?php

declare(strict_types=1);

namespace App\Http\Resources\Enums;

use App\Enums\Interfaces\CatalogInterface;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property CatalogInterface $resource */
final class CatalogResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->value,
            'code' => $this->resource->getCode(),
            'name' => $this->resource->getDescription(),
        ];
    }
}

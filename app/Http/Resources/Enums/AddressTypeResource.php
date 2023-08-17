<?php

declare(strict_types=1);

namespace App\Http\Resources\Enums;

use App\Enums\AddressType;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property AddressType $resource */
final class AddressTypeResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->value,
            'name' => $this->resource->getName(),
        ];
    }
}

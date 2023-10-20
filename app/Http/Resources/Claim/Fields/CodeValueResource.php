<?php

declare(strict_types=1);

namespace App\Http\Resources\Claim\Fields;

use App\Enums\Company\CodeValueFields;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property CodeValueFields $resource */
final class CodeValueResource extends JsonResource
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
            'code' => $this->resource->getCode(),
            'name' => $this->resource->getName(),
            'type' => $this->resource->getType(),
        ];
    }
}

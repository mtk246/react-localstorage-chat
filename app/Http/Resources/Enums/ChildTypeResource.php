<?php

declare(strict_types=1);

namespace App\Http\Resources\Enums;

use App\Enums\Interfaces\HasChildInterface;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property HasChildInterface $resource */
final class ChildTypeResource extends JsonResource
{
    public function __construct(
        HasChildInterface $enum,
        public readonly string $resourceClass,
    ) {
        parent::__construct($enum);
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return EnumResource::collection(collect($this->resource->getChild()::cases()), $this->resourceClass);
    }
}

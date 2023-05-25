<?php

declare(strict_types=1);

namespace App\Http\Resources\Enums;

use App\Enums\Interfaces\HasChildInterface;
use App\Enums\Interfaces\RelatedEnumsInterface;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property RelatedEnumsInterface|null $resource */
final class ChildTypeResource extends JsonResource
{
    public function __construct(
        ?HasChildInterface $enum,
        public readonly string $resourceClass,
    ) {
        parent::__construct($enum?->getChild());
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request)
    {
        return new EnumResource(collect(
            $this->resource
                ? $this->resource::cases()
                : null
        ), $this->resourceClass);
    }
}

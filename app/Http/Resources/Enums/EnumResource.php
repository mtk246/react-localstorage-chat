<?php

declare(strict_types=1);

namespace App\Http\Resources\Enums;

use App\Enums\Interfaces\PublicInterface;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property \UnitEnum $enum
 * @property class-string $resourceClass
 */
final class EnumResource extends JsonResource
{
    public function __construct(
        public readonly string $enum,
        public readonly string $resourceClass,
    ) {
        parent::__construct([]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array<key, string>
     */
    public function toArray($request): array
    {
        return collect($this->enum::cases())
            ->map(fn (PublicInterface $value) => $value->getPublic() ?? true
                ? new $this->resourceClass($value)
                : null
            )
            ->filter()
            ->toArray();
    }
}

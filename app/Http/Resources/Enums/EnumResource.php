<?php

declare(strict_types=1);

namespace App\Http\Resources\Enums;

use App\Enums\Interfaces\PublicInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

/**
 * @property Collection<int, \UnitEnum> $enum
 * @property class-string $resourceClass
 */
final class EnumResource extends JsonResource
{
    public function __construct(
        public readonly Collection $enum,
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
        return $this->enum
            ->map(fn (PublicInterface $value) => $value->getPublic() ?? true
                ? new $this->resourceClass($value)
                : null
            )
            ->filter()
            ->toArray();
    }
}

<?php

declare(strict_types=1);

namespace App\Enums\Attributes;

use Attribute;

#[\Attribute]
final class RangeAttribute
{
    public function __construct(
        public readonly string|int $min,
        public readonly string|int $max,
    ) {
    }
}

<?php

declare(strict_types=1);

namespace App\Enums\Attributes;

use Attribute;

#[\Attribute]
final class ChildAttribute
{
    public function __construct(
        public readonly string $value,
    ) {
    }
}
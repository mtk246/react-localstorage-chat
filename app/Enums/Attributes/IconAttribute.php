<?php

declare(strict_types=1);

namespace App\Enums\Attributes;

#[\Attribute]
abstract class IconAttribute
{
    public function __construct(
        public readonly string $value,
    ) {
    }
}

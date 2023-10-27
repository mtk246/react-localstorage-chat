<?php

declare(strict_types=1);

namespace App\Enums\Attributes;

#[\Attribute]
abstract class AttributeClass
{
    public function __construct(
        public readonly string|int|bool $value,
    ) {
    }
}

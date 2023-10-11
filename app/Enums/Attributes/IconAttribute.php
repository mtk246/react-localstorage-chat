<?php

declare(strict_types=1);

namespace App\Enums\Attributes;

use Attribute;

#[\Attribute]
abstract class IconAttribute
{
    public function __construct(
        public readonly string $value,
    ) {
    }
}

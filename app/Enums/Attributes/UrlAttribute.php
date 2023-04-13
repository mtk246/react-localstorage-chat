<?php

declare(strict_types=1);

namespace App\Enums\Attributes;

final class UrlAttribute extends AttributeClass
{
    public function __construct(
        string $value,
        string $baseUrl = '',
    ) {
        parent::__construct($baseUrl.$value);
    }
}

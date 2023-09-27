<?php

declare(strict_types=1);

namespace App\Enums\Traits;

use App\Enums\Attributes\DescriptionAttribute;
use App\Enums\Attributes\IconAttribute;

trait HasIconAttributes
{
    use HasAttributes;

    public function getIcon(): string
    {
        return $this->getAttribute(IconAttribute::class);
    }

    public function getDescription(): string
    {
        return $this->getAttribute(DescriptionAttribute::class);
    }
}

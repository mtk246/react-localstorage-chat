<?php

declare(strict_types=1);

namespace App\Enums\Traits;

use App\Enums\Attributes\ColorAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;

trait HasColorAttributes
{
    use HasAttributes;

    public function getColor(): string
    {
        return $this->getAttribute(ColorAttribute::class);
    }

    public function getName(): string
    {
        return $this->getAttribute(NameAttribute::class);
    }

    public function getPublic(): bool
    {
        return $this->getAttribute(PublicAttribute::class);
    }
}

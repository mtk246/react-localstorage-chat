<?php

declare(strict_types=1);

namespace App\Enums\Traits;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;

trait HasTypeAttributes
{
    use HasAttributes;

    public function getName(): string
    {
        return $this->getAttribute(NameAttribute::class);
    }

    public function getPublic(): bool
    {
        return $this->getAttribute(PublicAttribute::class);
    }
}

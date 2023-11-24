<?php

declare(strict_types=1);

namespace App\Enums\Traits;

use App\Enums\Attributes\NextAttribute;
use App\Enums\Attributes\NumberAttribute;
use App\Enums\Attributes\PublicAttribute;

trait HasVersionAttributes
{
    use HasAttributes;

    public function getNext(): string
    {
        return $this->getAttribute(NextAttribute::class);
    }

    public function getNumber(): string
    {
        return $this->getAttribute(NumberAttribute::class);
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

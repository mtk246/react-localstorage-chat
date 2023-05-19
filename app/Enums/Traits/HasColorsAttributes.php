<?php

declare(strict_types=1);

namespace App\Enums\Traits;

use App\Enums\Attributes\BackgroundCollorAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\TextCollorAttribute;

trait HasColorsAttributes
{
    use HasAttributes;

    public function getBackgroundCollor(): string
    {
        return $this->getAttribute(BackgroundCollorAttribute::class);
    }

    public function getTextCollor(): string
    {
        return $this->getAttribute(TextCollorAttribute::class);
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
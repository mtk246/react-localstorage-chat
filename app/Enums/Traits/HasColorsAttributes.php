<?php

declare(strict_types=1);

namespace App\Enums\Traits;

use App\Enums\Attributes\BackgroundColorAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\TextColorAttribute;

trait HasColorsAttributes
{
    use HasAttributes;

    public function getBackgroundColor(): string
    {
        return $this->getAttribute(BackgroundColorAttribute::class);
    }

    public function getTextColor(): string
    {
        return $this->getAttribute(TextColorAttribute::class);
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

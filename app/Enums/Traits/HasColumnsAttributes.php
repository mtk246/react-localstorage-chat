<?php

declare(strict_types=1);

namespace App\Enums\Traits;

use App\Enums\Attributes\AlignAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\TextAttribute;
use App\Enums\Attributes\TypeAttribute;
use App\Enums\Attributes\WidthAttribute;

trait HasColumnsAttributes
{
    use HasAttributes;

    public function getId(): string
    {
        return $this->getAttribute(NameAttribute::class);
    }

    public function getName(): string
    {
        return $this->getAttribute(NameAttribute::class);
    }

    public function getType(): string
    {
        return $this->getAttribute(TypeAttribute::class);
    }

    public function getAlign(): string
    {
        return $this->getAttribute(AlignAttribute::class);
    }

    public function getText(): string
    {
        return $this->getAttribute(TextAttribute::class);
    }

    public function getWidth(): string
    {
        return $this->getAttribute(WidthAttribute::class);
    }

    public function getPublic(): bool
    {
        return $this->getAttribute(PublicAttribute::class);
    }
}

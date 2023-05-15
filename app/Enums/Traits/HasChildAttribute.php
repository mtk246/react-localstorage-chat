<?php

declare(strict_types=1);

namespace App\Enums\Traits;

use App\Enums\Attributes\ChildAttribute;

trait HasChildAttribute
{
    use HasAttributes;

    public function getChild(): string
    {
        return $this->getAttribute(ChildAttribute::class);
    }
}

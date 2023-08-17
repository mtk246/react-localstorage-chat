<?php

declare(strict_types=1);

namespace App\Enums\Traits;

use App\Enums\Attributes\CodeAttribute;

trait HasCodeAttribute
{
    use HasAttributes;

    public function getCode(): ?string
    {
        return $this->getAttribute(CodeAttribute::class);
    }
}

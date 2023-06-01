<?php

declare(strict_types=1);

namespace App\Enums\Traits;

use App\Enums\Attributes\RangeAttribute;

trait HasRangeAttribute
{
    use HasAttributes;

    public function getRange(): ?RangeAttribute
    {
        return $this->getAttributeInstance(RangeAttribute::class);
    }
}

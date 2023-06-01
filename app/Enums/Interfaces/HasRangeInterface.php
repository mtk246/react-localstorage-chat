<?php

declare(strict_types=1);

namespace App\Enums\Interfaces;

use App\Enums\Attributes\RangeAttribute;

interface HasRangeInterface extends PublicInterface
{
    public function getRange(): ?RangeAttribute;
}

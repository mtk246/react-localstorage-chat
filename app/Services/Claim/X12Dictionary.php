<?php

declare(strict_types=1);

namespace App\Services\Claim;

use App\Enums\Claim\FormatType;

final class X12Dictionary extends Dictionary
{
    protected string $format = FormatType::X12;
}

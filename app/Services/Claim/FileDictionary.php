<?php

declare(strict_types=1);

namespace App\Services\Claim;

use App\Enums\Claim\FormatType;

final class FileDictionary extends Dictionary
{
    protected string $format = FormatType::FILE;
}

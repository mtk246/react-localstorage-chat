<?php

declare(strict_types=1);

namespace App\Enums\Claim;

enum FormatType: string
{
    case FILE = 'file';
    case X12 = 'X12';
    case JSON = 'json';
}

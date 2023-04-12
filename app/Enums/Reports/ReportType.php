<?php

declare(strict_types=1);

namespace App\Enums\Reports;

use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;

enum ReportType: string
{
    use EnumToArray;
    use HasAttributes;

    case TYPE_A = '1';
    case TYPE_B = '2';
}

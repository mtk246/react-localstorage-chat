<?php

declare(strict_types=1);

namespace App\Enums\Tableau;

use App\Enums\Traits\EnumToArray;

enum WorkbookGroupType: string
{
    use EnumToArray;

    case TEMPORAL = 'temporal';
}

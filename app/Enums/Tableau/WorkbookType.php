<?php

declare(strict_types=1);

namespace App\Enums\Tableau;

use App\Enums\Traits\EnumToArray;

enum WorkbookType: string
{
    use EnumToArray;

    case DASHBOARD = 'dashboard';
    case REPORT = 'report';
}

<?php

declare(strict_types=1);

namespace App\Enums\Claim;

enum RuleType: string
{
    case DATE = 'date';
    case BOOLEAN = 'boolean';
    case SINGLE = 'single';
    case MULTIPLE = 'multiple';
}

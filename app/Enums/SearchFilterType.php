<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Traits\HasAttributes;

enum SearchFilterType: string
{
    use HasAttributes;

    case BILLING_COMPANY = 'billing_company';
    case CLAIM = 'claim';
    case COMPANY = 'company';
    case FACILITY = 'facility';
    case HEALTH_PROFESSIONAL = 'health_professional';
}

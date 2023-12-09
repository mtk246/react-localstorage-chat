<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Traits\HasAttributes;

enum SearchFilterType: string
{
    use HasAttributes;

    case BILLING_COMPANY = 'billing_company';
    case CLAIM = 'claim';
    case CLAIM_RULE = 'claim_rule';
    case COMPANY = 'company';
    case FACILITY = 'facility';
    case HEALTH_PROFESSIONAL = 'health_professional';
    case PATIENT = 'patient';
    case INSURANCE_COMPANY = 'insurance_company';
    case INSURANCE_PLAN = 'insurance_plan';
    case PROCEDURE = 'procedure';
    case DIACNOSIS = 'diagnosis';
    case MODIFIER = 'modifier';
    case USER = 'user';
    case CLEARING_HOUSE = 'clearing_house';
    case PAYMENT_BATCH = 'payment_batch';
}

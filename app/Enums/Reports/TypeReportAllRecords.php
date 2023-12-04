<?php

declare(strict_types=1);

namespace App\Enums\Reports;

use BenSampo\Enum\Enum;

final class TypeReportAllRecords extends Enum
{
    public const DETAILED_PATIENT = 'detailed_patient';
    public const GENERAL_PATIENT = 'general_patient';
    public const GENERAL_FACILITY = 'general_facility';
    public const GENERAL_HEALTHCARE_PROFESSIONAL = 'general_healthcare_professional';
    public const PAYER_MIX = 'payer_mix';
}

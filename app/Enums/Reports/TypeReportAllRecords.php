<?php

declare(strict_types=1);

namespace App\Enums\Reports;

use BenSampo\Enum\Enum;

final class TypeReportAllRecords extends Enum
{
    public const DETAILED_PATIENT = 'detailed patient';
    public const GENERAL_PATIENT = 'general patient';
    public const GENERAL_FACILITY = 'general facility';
    public const GENERAL_HEALTHCARE_PROFESSIONAL = 'general healthcare professional';
}

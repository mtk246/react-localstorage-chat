<?php

declare(strict_types=1);

namespace App\Enums\Diagnoses\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum CategoryIIType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Composite Measures')]
    #[RangeAttribute('0001F', '0015F')]
    #[PublicAttribute(true)]
    case COMPOSITE_MEASURES = 1;

    #[NameAttribute('Patient Management')]
    #[RangeAttribute('0500F', '0584F')]
    #[PublicAttribute(true)]
    case PATIENT_MANAGEMENT = 2;

    #[NameAttribute('Patient History')]
    #[RangeAttribute('1000F', '1505F')]
    #[PublicAttribute(true)]
    case PATIENT_HISTORY = 3;

    #[NameAttribute('Physical Examination')]
    #[RangeAttribute('2000F', '2060F')]
    #[PublicAttribute(true)]
    case PHYSICAL_EXAMINATION = 4;

    #[NameAttribute('Diagnostic/Screening Processes or Results')]
    #[RangeAttribute('3006F', '3776F')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC_SCREENING_PROCESSES_OR_RESULTS = 5;

    #[NameAttribute('Therapeutic, Preventive or Other Interventions')]
    #[RangeAttribute('4000F', '4563F')]
    #[PublicAttribute(true)]
    case THERAPEUTIC_PREVENTIVE_OR_OTHER_INTERVENTIONS = 6;

    #[NameAttribute('Follow-up or Other Outcomes')]
    #[RangeAttribute('5005F', '5250F')]
    #[PublicAttribute(true)]
    case FOLLOW_UP_OR_OTHER_OUTCOMES = 7;

    #[NameAttribute('Patient Safety')]
    #[RangeAttribute('6005F', '6150F')]
    #[PublicAttribute(true)]
    case PATIENT_SAFETY = 8;

    #[NameAttribute('Structural Measures')]
    #[RangeAttribute('7010F', '7025F')]
    #[PublicAttribute(true)]
    case STRUCTURAL_MEASURES = 9;

    #[NameAttribute('Non-Measure Category II Codes')]
    #[RangeAttribute('9001F', '9007F')]
    #[PublicAttribute(true)]
    case NON_MEASURE_CATEGORY_II_CODES = 10;
}

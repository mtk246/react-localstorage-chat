<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\HasChildInterface;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum CategoryIIType: int implements TypeInterface, HasChildInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;

    #[NameAttribute('Composite Measures')]
    #[PublicAttribute(true)]
    case COMPOSITE_MEASURES = 1;

    #[NameAttribute('Patient Management')]
    #[PublicAttribute(true)]
    case PATIENT_MANAGEMENT = 2;

    #[NameAttribute('Patient History')]
    #[PublicAttribute(true)]
    case PATIENT_HISTORY = 3;

    #[NameAttribute('Physical Examination')]
    #[PublicAttribute(true)]
    case PHYSICAL_EXAMINATION = 4;

    #[NameAttribute('Diagnostic/Screening Processes or Results')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC_SCREENING_PROCESSES_OR_RESULTS = 5;

    #[NameAttribute('Therapeutic, Preventive or Other Interventions')]
    #[PublicAttribute(true)]
    case THERAPEUTIC_PREVENTIVE_OR_OTHER_INTERVENTIONS = 6;

    #[NameAttribute('Follow-up or Other Outcomes')]
    #[PublicAttribute(true)]
    case FOLLOW_UP_OR_OTHER_OUTCOMES = 7;

    #[NameAttribute('Patient Safety')]
    #[PublicAttribute(true)]
    case PATIENT_SAFETY = 8;

    #[NameAttribute('Structural Measures')]
    #[PublicAttribute(true)]
    case STRUCTURAL_MEASURES = 9;

    #[NameAttribute('Non-Measure Category II Codes')]
    #[PublicAttribute(true)]
    case NON_MEASURE_CATEGORY_II_CODES = 10;
}

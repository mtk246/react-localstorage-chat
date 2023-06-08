<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum NationalCodeType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Nursing Services')]
    #[PublicAttribute(true)]
    case NURSING_SERVICES = 1;

    #[NameAttribute('Alcohol and Substance Abuse Services')]
    #[PublicAttribute(true)]
    case ALCOHOL_AND_SUBSTANCE_ABUSE_SERVICES = 2;

    #[NameAttribute('Other Services')]
    #[PublicAttribute(true)]
    case OTHER_SERVICES = 3;

    #[NameAttribute('Home Health Services')]
    #[PublicAttribute(true)]
    case HOME_HEALTH_SERVICES = 4;

    #[NameAttribute('Screenings, Assessments, and Treatments, Individual and Family')]
    #[PublicAttribute(true)]
    case SCREENINGS_ASSESSMENTS_AND_TREATMENTS_INDIVIDUAL_AND_FAMILY = 5;

    #[NameAttribute('Additional Nursing Services')]
    #[PublicAttribute(true)]
    case ADDITIONAL_NURSING_SERVICES = 6;

    #[NameAttribute('Doula Birth Worker Services')]
    #[PublicAttribute(true)]
    case DOULA_BIRTH_WORKER_SERVICES = 7;

    #[NameAttribute('Behavioral Health Services')]
    #[PublicAttribute(true)]
    case BEHAVIORAL_HEALTH_SERVICES = 8;

    #[NameAttribute('Miscellaneous Services and Supplies')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_SERVICES_AND_SUPPLIES = 9;

    #[NameAttribute('Transportation Services')]
    #[PublicAttribute(true)]
    case TRANSPORTATION_SERVICES = 10;

    #[NameAttribute('Preadmission Screening')]
    #[PublicAttribute(true)]
    case PREADMISSION_SCREENING = 11;

    #[NameAttribute('Waiver Services')]
    #[PublicAttribute(true)]
    case WAIVER_SERVICES = 12;

    #[NameAttribute('Hospice Care')]
    #[PublicAttribute(true)]
    case HOSPICE_CARE = 13;

    #[NameAttribute('Prevocational Habilitation Waiver Services')]
    #[PublicAttribute(true)]
    case PREVOCATIONAL_HABILITATION_WAIVER_SERVICES = 14;

    #[NameAttribute('Long-term Residential Care')]
    #[PublicAttribute(true)]
    case LONG_TERM_RESIDENTIAL_CARE = 15;

    #[NameAttribute('Non-emergency Transportation Fees')]
    #[PublicAttribute(true)]
    case NON_EMERGENCY_TRANSPORTATION_FEES = 16;

    #[NameAttribute('Financial Management and Supports Brokerage Services, Per Diem')]
    #[PublicAttribute(true)]
    case FINANCIAL_MANAGEMENT_AND_SUPPORTS_BROKERAGE_SERVICES_PER_DIEM = 17;

    #[NameAttribute('Services Related to Breast Milk')]
    #[PublicAttribute(true)]
    case SERVICES_RELATED_TO_BREAST_MILK = 18;

    #[NameAttribute('Incontinence Supplies')]
    #[PublicAttribute(true)]
    case INCONTINENCE_SUPPLIES = 19;

    #[NameAttribute('Other and Unspecified Supplies')]
    #[PublicAttribute(true)]
    case OTHER_AND_UNSPECIFIED_SUPPLIES = 20;
}

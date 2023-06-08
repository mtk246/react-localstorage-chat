<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum NationalCodeType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Nursing Services')]
    #[RangeAttribute('T1000', 'T1005')]
    #[PublicAttribute(true)]
    case NURSING_SERVICES = 1;

    #[NameAttribute('Alcohol and Substance Abuse Services')]
    #[RangeAttribute('T1006', 'T1012')]
    #[PublicAttribute(true)]
    case ALCOHOL_AND_SUBSTANCE_ABUSE_SERVICES = 2;

    #[NameAttribute('Other Services')]
    #[RangeAttribute('T1013', 'T1018')]
    #[PublicAttribute(true)]
    case OTHER_SERVICES = 3;

    #[NameAttribute('Home Health Services')]
    #[RangeAttribute('T1019', 'T1022')]
    #[PublicAttribute(true)]
    case HOME_HEALTH_SERVICES = 4;

    #[NameAttribute('Screenings, Assessments, and Treatments, Individual and Family')]
    #[RangeAttribute('T1023', 'T1029')]
    #[PublicAttribute(true)]
    case SCREENINGS_ASSESSMENTS_AND_TREATMENTS_INDIVIDUAL_AND_FAMILY = 5;

    #[NameAttribute('Additional Nursing Services')]
    #[RangeAttribute('T1030', 'T1031')]
    #[PublicAttribute(true)]
    case ADDITIONAL_NURSING_SERVICES = 6;

    #[NameAttribute('Doula Birth Worker Services')]
    #[RangeAttribute('T1032', 'T1033')]
    #[PublicAttribute(true)]
    case DOULA_BIRTH_WORKER_SERVICES = 7;

    #[NameAttribute('Behavioral Health Services')]
    #[RangeAttribute('T1040', 'T1041')]
    #[PublicAttribute(true)]
    case BEHAVIORAL_HEALTH_SERVICES = 8;

    #[NameAttribute('Miscellaneous Services and Supplies')]
    #[RangeAttribute('T1502', 'T1999')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_SERVICES_AND_SUPPLIES = 9;

    #[NameAttribute('Transportation Services')]
    #[RangeAttribute('T2001', 'T2007')]
    #[PublicAttribute(true)]
    case TRANSPORTATION_SERVICES = 10;

    #[NameAttribute('Preadmission Screening')]
    #[RangeAttribute('T2010', 'T2011')]
    #[PublicAttribute(true)]
    case PREADMISSION_SCREENING = 11;

    #[NameAttribute('Waiver Services')]
    #[RangeAttribute('T2012', 'T2041')]
    #[PublicAttribute(true)]
    case WAIVER_SERVICES = 12;

    #[NameAttribute('Hospice Care')]
    #[RangeAttribute('T2042', 'T2046')]
    #[PublicAttribute(true)]
    case HOSPICE_CARE = 13;

    #[NameAttribute('Prevocational Habilitation Waiver Services')]
    #[RangeAttribute('T2047', 'T2047')]
    #[PublicAttribute(true)]
    case PREVOCATIONAL_HABILITATION_WAIVER_SERVICES = 14;

    #[NameAttribute('Long-term Residential Care')]
    #[RangeAttribute('T2048', 'T2048')]
    #[PublicAttribute(true)]
    case LONG_TERM_RESIDENTIAL_CARE = 15;

    #[NameAttribute('Non-emergency Transportation Fees')]
    #[RangeAttribute('T2049', 'T2049')]
    #[PublicAttribute(true)]
    case NON_EMERGENCY_TRANSPORTATION_FEES = 16;

    #[NameAttribute('Financial Management and Supports Brokerage Services, Per Diem')]
    #[RangeAttribute('T2050', 'T2051')]
    #[PublicAttribute(true)]
    case FINANCIAL_MANAGEMENT_AND_SUPPORTS_BROKERAGE_SERVICES_PER_DIEM = 17;

    #[NameAttribute('Services Related to Breast Milk')]
    #[RangeAttribute('T2101', 'T2101')]
    #[PublicAttribute(true)]
    case SERVICES_RELATED_TO_BREAST_MILK = 18;

    #[NameAttribute('Incontinence Supplies')]
    #[RangeAttribute('T4521', 'T4545')]
    #[PublicAttribute(true)]
    case INCONTINENCE_SUPPLIES = 19;

    #[NameAttribute('Other and Unspecified Supplies')]
    #[RangeAttribute('T5001', 'T5999')]
    #[PublicAttribute(true)]
    case OTHER_AND_UNSPECIFIED_SUPPLIES = 20;
}

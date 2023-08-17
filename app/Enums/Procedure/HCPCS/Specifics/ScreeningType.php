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

enum ScreeningType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('TB Screening')]
    #[RangeAttribute('M1003', 'M1005')]
    #[PublicAttribute(true)]
    case TB_SCREENING = 1;

    #[NameAttribute('Evaluation AND Assessment')]
    #[RangeAttribute('M1006', 'M1014')]
    #[PublicAttribute(true)]
    case EVALUATION_AND_ASSESSMENT = 2;

    #[NameAttribute('Patient Status')]
    #[RangeAttribute('M1016', 'M1018')]
    #[PublicAttribute(true)]
    case PATIENT_STATUS = 3;

    #[NameAttribute('Adolescent Depression, Remission AND Management')]
    #[RangeAttribute('M1019', 'M1026')]
    #[PublicAttribute(true)]
    case ADOLESCENT_DEPRESSION_REMISSION_AND_MANAGEMENT = 4;

    #[NameAttribute('Head Imaging')]
    #[RangeAttribute('M1027', 'M1031')]
    #[PublicAttribute(true)]
    case HEAD_IMAGING = 5;

    #[NameAttribute('Pharmacotherapy for OUD')]
    #[RangeAttribute('M1032', 'M1036')]
    #[PublicAttribute(true)]
    case PHARMACOTHERAPY_FOR_OUD = 6;

    #[NameAttribute('Lumbar Spine Associated Conditions')]
    #[RangeAttribute('M1037', 'M1041')]
    #[PublicAttribute(true)]
    case LUMBAR_SPINE_ASSOCIATED_CONDITIONS = 7;

    #[NameAttribute('Functional STATUS Measurement')]
    #[RangeAttribute('M1043', 'M1049')]
    #[PublicAttribute(true)]
    case FUNCTIONAL_STATUS_MEASUREMENT = 8;

    #[NameAttribute('Lumbar Spine Conditions')]
    #[RangeAttribute('M1051', 'M1051')]
    #[PublicAttribute(true)]
    case LUMBAR_SPINE_CONDITIONS = 9;

    #[NameAttribute('Limb Pain Assessment')]
    #[RangeAttribute('M1052', 'M1052')]
    #[PublicAttribute(true)]
    case LIMB_PAIN_ASSESSMENT = 10;

    #[NameAttribute('Urgent Care Visit')]
    #[RangeAttribute('M1054', 'M1054')]
    #[PublicAttribute(true)]
    case URGENT_CARE_VISIT = 11;

    #[NameAttribute('Anticoagulation Management')]
    #[RangeAttribute('M1055', 'M1057')]
    #[PublicAttribute(true)]
    case ANTICOAGULATION_MANAGEMENT = 12;

    #[NameAttribute('Performance Assessment')]
    #[RangeAttribute('M1058', 'M1060')]
    #[PublicAttribute(true)]
    case PERFORMANCE_ASSESSMENT = 13;

    #[NameAttribute('Hospice Services')]
    #[RangeAttribute('M1067', 'M1067')]
    #[PublicAttribute(true)]
    case HOSPICE_SERVICES = 14;

    #[NameAttribute('Mobility Status')]
    #[RangeAttribute('M1068', 'M1068')]
    #[PublicAttribute(true)]
    case MOBILITY_STATUS = 15;

    #[NameAttribute('Fall Risk Assessment')]
    #[RangeAttribute('M1069', 'M1070')]
    #[PublicAttribute(true)]
    case FALL_RISK_ASSESSMENT = 16;
}

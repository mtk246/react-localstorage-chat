<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum ScreeningType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('TB Screening')]
    #[PublicAttribute(true)]
    case TB_SCREENING = 1;

    #[NameAttribute('Evaluation AND Assessment')]
    #[PublicAttribute(true)]
    case EVALUATION_AND_ASSESSMENT = 2;

    #[NameAttribute('Patient Status')]
    #[PublicAttribute(true)]
    case PATIENT_STATUS = 3;

    #[NameAttribute('Adolescent Depression, Remission AND Management')]
    #[PublicAttribute(true)]
    case ADOLESCENT_DEPRESSION_REMISSION_AND_MANAGEMENT = 4;

    #[NameAttribute('Head Imaging')]
    #[PublicAttribute(true)]
    case HEAD_IMAGING = 5;

    #[NameAttribute('Pharmacotherapy for OUD')]
    #[PublicAttribute(true)]
    case PHARMACOTHERAPY_FOR_OUD = 6;

    #[NameAttribute('Lumbar Spine Associated Conditions')]
    #[PublicAttribute(true)]
    case LUMBAR_SPINE_ASSOCIATED_CONDITIONS = 7;

    #[NameAttribute('Functional STATUS Measurement')]
    #[PublicAttribute(true)]
    case FUNCTIONAL_STATUS_MEASUREMENT = 8;

    #[NameAttribute('Lumbar Spine Conditions')]
    #[PublicAttribute(true)]
    case LUMBAR_SPINE_CONDITIONS = 9;

    #[NameAttribute('Limb Pain Assessment')]
    #[PublicAttribute(true)]
    case LIMB_PAIN_ASSESSMENT = 10;

    #[NameAttribute('Urgent Care Visit')]
    #[PublicAttribute(true)]
    case URGENT_CARE_VISIT = 11;

    #[NameAttribute('Anticoagulation Management')]
    #[PublicAttribute(true)]
    case ANTICOAGULATION_MANAGEMENT = 12;

    #[NameAttribute('Performance Assessment')]
    #[PublicAttribute(true)]
    case PERFORMANCE_ASSESSMENT = 13;

    #[NameAttribute('Hospice Services')]
    #[PublicAttribute(true)]
    case HOSPICE_SERVICES = 14;

    #[NameAttribute('Mobility Status')]
    #[PublicAttribute(true)]
    case MOBILITY_STATUS = 15;

    #[NameAttribute('Fall Risk Assessment')]
    #[PublicAttribute(true)]
    case FALL_RISK_ASSESSMENT = 16;
}

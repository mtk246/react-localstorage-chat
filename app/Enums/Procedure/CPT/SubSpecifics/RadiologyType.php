<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\SubSpecifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum RadiologyType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasRangeAttribute;
    use HasChildAttribute;

    #[NameAttribute('Diagnostic Radiology (Diagnostic Imaging) Procedures')]
    #[RangeAttribute('70010', '76499')]
    #[PublicAttribute(true)]
    case DIACNOSTIC_IMAGING = 1;

    #[NameAttribute('Diagnostic Ultrasound Procedures')]
    #[RangeAttribute('76506', '76999')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC_ULTRASOUND = 2;

    #[NameAttribute('Radiologic Guidance')]
    #[RangeAttribute('77001', '77022')]
    #[PublicAttribute(true)]
    case RADIOLOGIC_GUIDANCE = 3;

    #[NameAttribute('Breast, Mammography')]
    #[RangeAttribute('77046', '77067')]
    #[PublicAttribute(true)]
    case MAMMOGRAPHY = 4;

    #[NameAttribute('Bone/Joint Studies')]
    #[RangeAttribute('77071', '77092')]
    #[PublicAttribute(true)]
    case BONE_JOINT_STUDIES = 5;

    #[NameAttribute('Radiation Oncology Treatment')]
    #[RangeAttribute('77261', '77799')]
    #[PublicAttribute(true)]
    case RADIATION_ONCOLOGY_TREATMENT = 6;

    #[NameAttribute('Nuclear Medicine Procedures')]
    #[RangeAttribute('78012', '79999')]
    #[PublicAttribute(true)]
    case NUCLEAR_MEDICINE_PROCEDURES = 7;
}

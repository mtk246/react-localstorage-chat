<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT\SubSpecifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum RadiologyType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Diagnostic Radiology (Diagnostic Imaging) Procedures')]
    #[PublicAttribute(true)]
    case DIACNOSTIC_IMAGING = 1;

    #[NameAttribute('Diagnostic Ultrasound Procedures')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC_ULTRASOUND = 2;

    #[NameAttribute('Radiologic Guidance')]
    #[PublicAttribute(true)]
    case RADIOLOGIC_GUIDANCE = 3;

    #[NameAttribute('Breast, Mammography')]
    #[PublicAttribute(true)]
    case MAMMOGRAPHY = 4;

    #[NameAttribute('Bone/Joint Studies')]
    #[PublicAttribute(true)]
    case BONE_JOINT_STUDIES = 5;

    #[NameAttribute('Radiation Oncology Treatment')]
    #[PublicAttribute(true)]
    case RADIATION_ONCOLOGY_TREATMENT = 6;

    #[NameAttribute('Nuclear Medicine Procedures')]
    #[PublicAttribute(true)]
    case NUCLEAR_MEDICINE_PROCEDURES = 7;
}

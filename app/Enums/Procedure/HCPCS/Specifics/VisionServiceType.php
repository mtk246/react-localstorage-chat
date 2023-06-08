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

enum VisionServiceType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Spectacle Frames')]
    #[RangeAttribute('V2020', 'V2025')]
    #[PublicAttribute(true)]
    case SPECTACLE_FRAMES = 1;

    #[NameAttribute('Lenses, Single Vision')]
    #[RangeAttribute('V2100', 'V2199')]
    #[PublicAttribute(true)]
    case LENSES_SINGLE_VISION = 2;

    #[NameAttribute('Lenses, Bifocals')]
    #[RangeAttribute('V2200', 'V2299')]
    #[PublicAttribute(true)]
    case LENSES_BIFOCALS = 3;

    #[NameAttribute('Lenses, Trifocal')]
    #[RangeAttribute('V2300', 'V2399')]
    #[PublicAttribute(true)]
    case LENSES_TRIFOCAL = 4;

    #[NameAttribute('Lenses, Aspherical and Variable Sphericity')]
    #[RangeAttribute('V2410', 'V2499')]
    #[PublicAttribute(true)]
    case LENSES_ASPHERICAL_AND_VARIABLE_SPHERICITY = 5;

    #[NameAttribute('Assorted Contact Lenses')]
    #[RangeAttribute('V2500', 'V2599')]
    #[PublicAttribute(true)]
    case ASSORTED_CONTACT_LENSES = 6;

    #[NameAttribute('Low and Near Vision Aids')]
    #[RangeAttribute('V2600', 'V2615')]
    #[PublicAttribute(true)]
    case LOW_AND_NEAR_VISION_AIDS = 7;

    #[NameAttribute('Eye Prosthetics and Services')]
    #[RangeAttribute('V2623', 'V2629')]
    #[PublicAttribute(true)]
    case EYE_PROSTHETICS_AND_SERVICES = 8;

    #[NameAttribute('Lenses, Intraocular')]
    #[RangeAttribute('V2630', 'V2632')]
    #[PublicAttribute(true)]
    case LENSES_INTRAOCULAR = 9;

    #[NameAttribute('Vision Services')]
    #[RangeAttribute('V2700', 'V2799')]
    #[PublicAttribute(true)]
    case VISION_SERVICES = 10;
}

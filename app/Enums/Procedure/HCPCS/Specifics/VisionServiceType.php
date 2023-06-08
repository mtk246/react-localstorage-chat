<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum VisionServiceType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Spectacle Frames')]
    #[PublicAttribute(true)]
    case SPECTACLE_FRAMES = 1;

    #[NameAttribute('Lenses, Single Vision')]
    #[PublicAttribute(true)]
    case LENSES_SINGLE_VISION = 2;

    #[NameAttribute('Lenses, Bifocals')]
    #[PublicAttribute(true)]
    case LENSES_BIFOCALS = 3;

    #[NameAttribute('Lenses, Trifocal')]
    #[PublicAttribute(true)]
    case LENSES_TRIFOCAL = 4;

    #[NameAttribute('Lenses, Aspherical and Variable Sphericity')]
    #[PublicAttribute(true)]
    case LENSES_ASPHERICAL_AND_VARIABLE_SPHERICITY = 5;

    #[NameAttribute('Assorted Contact Lenses')]
    #[PublicAttribute(true)]
    case ASSORTED_CONTACT_LENSES = 6;

    #[NameAttribute('Low and Near Vision Aids')]
    #[PublicAttribute(true)]
    case LOW_AND_NEAR_VISION_AIDS = 7;

    #[NameAttribute('Eye Prosthetics and Services')]
    #[PublicAttribute(true)]
    case EYE_PROSTHETICS_AND_SERVICES = 8;

    #[NameAttribute('Lenses, Intraocular')]
    #[PublicAttribute(true)]
    case LENSES_INTRAOCULAR = 9;

    #[NameAttribute('Vision Services')]
    #[PublicAttribute(true)]
    case VISION_SERVICES = 10;
}

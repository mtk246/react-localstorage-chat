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

    // Spectacle Frames
    // Lenses, Single Vision
    // Lenses, Bifocals
    // Lenses, Trifocal
    // Lenses, Aspherical and Variable Sphericity
    // Assorted Contact Lenses
    // Low and Near Vision Aids
    // Eye Prosthetics and Services
    // Lenses, Intraocular
    // Vision Services
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;
}

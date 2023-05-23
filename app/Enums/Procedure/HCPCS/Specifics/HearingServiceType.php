<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum HearingServiceType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    // Hearing Assessments and Evaluations
    // Hearing Aid, Monaural
    // Miscellaneous Hearing Services and Supplies
    // Hearing Aids
    // Assistive Hearing Devices
    // Other and Miscellaneous Hearing Services and Supplies
    // Speech-related Screenings and Communication Device Repair
    //
    // #[NameAttribute(':name:')]
    // #[PublicAttribute(true)]
    // case :capitalize_name: = :id:;

    #[NameAttribute('Anesthesia for Procedures on the Head')]
    #[PublicAttribute(true)]
    case PROCEDURES_ON_HEAD = 1;
}

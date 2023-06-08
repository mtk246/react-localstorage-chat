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

    #[NameAttribute('Hearing Assessments and Evaluations')]
    #[PublicAttribute(true)]
    case HEARING_ASSESSMENTS_EVALUATIONS = 1;

    #[NameAttribute('Hearing Aid, Monaural')]
    #[PublicAttribute(true)]
    case HEARING_AID_MONAURAL = 2;

    #[NameAttribute('Miscellaneous Hearing Services and Supplies')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_HEARING_SERVICES_SUPPLIES = 3;

    #[NameAttribute('Hearing Aids')]
    #[PublicAttribute(true)]
    case HEARING_AIDS = 4;

    #[NameAttribute('Assistive Hearing Devices')]
    #[PublicAttribute(true)]
    case ASSISTIVE_HEARING_DEVICES = 5;

    #[NameAttribute('Other and Miscellaneous Hearing Services and Supplies')]
    #[PublicAttribute(true)]
    case OTHER_MISCELLANEOUS_HEARING_SERVICES_SUPPLIES = 6;

    #[NameAttribute('Speech-related Screenings and Communication Device Repair')]
    #[PublicAttribute(true)]
    case SPEECH_RELATED_SCREENINGS_COMMUNICATION_DEVICE_REPAIR = 7;
}

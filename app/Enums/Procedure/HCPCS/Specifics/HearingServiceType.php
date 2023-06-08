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

enum HearingServiceType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Hearing Assessments and Evaluations')]
    #[RangeAttribute('V5008', 'V5020')]
    #[PublicAttribute(true)]
    case HEARING_ASSESSMENTS_EVALUATIONS = 1;

    #[NameAttribute('Hearing Aid, Monaural')]
    #[RangeAttribute('V5030', 'V5060')]
    #[PublicAttribute(true)]
    case HEARING_AID_MONAURAL = 2;

    #[NameAttribute('Miscellaneous Hearing Services and Supplies')]
    #[RangeAttribute('V5070', 'V5110')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_HEARING_SERVICES_SUPPLIES = 3;

    #[NameAttribute('Hearing Aids')]
    #[RangeAttribute('V5120', 'V5267')]
    #[PublicAttribute(true)]
    case HEARING_AIDS = 4;

    #[NameAttribute('Assistive Hearing Devices')]
    #[RangeAttribute('V5268', 'V5290')]
    #[PublicAttribute(true)]
    case ASSISTIVE_HEARING_DEVICES = 5;

    #[NameAttribute('Other and Miscellaneous Hearing Services and Supplies')]
    #[RangeAttribute('V5298', 'V5299')]
    #[PublicAttribute(true)]
    case OTHER_MISCELLANEOUS_HEARING_SERVICES_SUPPLIES = 6;

    #[NameAttribute('Speech-related Screenings and Communication Device Repair')]
    #[RangeAttribute('V5336', 'V5364')]
    #[PublicAttribute(true)]
    case SPEECH_RELATED_SCREENINGS_COMMUNICATION_DEVICE_REPAIR = 7;
}

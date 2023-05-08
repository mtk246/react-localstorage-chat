<?php

declare(strict_types=1);

namespace App\Enums\Procedure;

use App\Enums\Attributes\ColorAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\ColorTypeInterface;
use App\Enums\Traits\HasColorAttributes;

enum ProcedureType: int implements ColorTypeInterface
{
    use HasColorAttributes;

    #[ColorAttribute('#FF9B95')]
    #[NameAttribute('CPT')]
    #[PublicAttribute(true)]
    case CPT = 1;

    #[ColorAttribute('#FCC084')]
    #[NameAttribute('HCPCS')]
    #[PublicAttribute(true)]
    case HCPCS = 2;

    #[ColorAttribute('#93F9C1')]
    #[NameAttribute('HIPPS')]
    #[PublicAttribute(true)]
    case HIPPS = 3;
}

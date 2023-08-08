<?php

declare(strict_types=1);

namespace App\Enums\Procedure;

use App\Enums\Attributes\ChildAttribute;
use App\Enums\Attributes\ColorAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\ColorTypeInterface;
use App\Enums\Interfaces\HasChildInterface;
use App\Enums\Procedure\CPT\GeneralType as CPTGeneralType;
use App\Enums\Procedure\HCPCS\GeneralType as HCPCSGeneralType;
use App\Enums\Procedure\HIPPS\GeneralType as HIPPSGeneralType;
use App\Enums\Procedure\REVC\GeneralType as REVCGeneralType;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum ProcedureType: int implements ColorTypeInterface, HasChildInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[ColorAttribute('#FF9B95')]
    #[NameAttribute('CPT')]
    #[ChildAttribute(CPTGeneralType::class)]
    #[PublicAttribute(true)]
    case CPT = 1;

    #[ColorAttribute('#FCC084')]
    #[NameAttribute('HCPCS')]
    #[ChildAttribute(HCPCSGeneralType::class)]
    #[PublicAttribute(true)]
    case HCPCS = 2;

    #[ColorAttribute('#93F9C1')]
    #[NameAttribute('HIPPS')]
    #[ChildAttribute(HIPPSGeneralType::class)]
    #[PublicAttribute(true)]
    case HIPPS = 3;

    #[ColorAttribute('#93F9C1')]
    #[NameAttribute('REVENUE')]
    #[ChildAttribute(REVCGeneralType::class)]
    #[PublicAttribute(true)]
    case REVC = 4;
}

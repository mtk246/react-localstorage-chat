<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum DMEMACType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Wheelchairs, Components, and Accessories')]
    #[PublicAttribute(true)]
    case WHEELCHAIR_COMPONENTS_ACCESSORIES = 1;

    #[NameAttribute('INFUSION PUMPS AND SUPPLIES')]
    #[PublicAttribute(true)]
    case INFUSION_PUMPS_SUPPLIES = 2;

    #[NameAttribute('Automated External Defibrillator and Supplies')]
    #[PublicAttribute(true)]
    case AUTOMATED_EXTERNAL_DEFIBRILLATOR_SUPPLIES = 3;

    #[NameAttribute('Miscellaneous DME and Accessories')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DME_ACCESSORIES = 4;

    #[NameAttribute('Power Operated Vehicles')]
    #[PublicAttribute(true)]
    case POWER_OPERATED_VEHICLES = 5;

    #[NameAttribute('Wheelchairs, Power Operated')]
    #[PublicAttribute(true)]
    case WHEELCHAIRS_POWER_OPERATED = 6;

    #[NameAttribute('Customized DME, Other Than Wheelchair')]
    #[PublicAttribute(true)]
    case CUSTOMIZED_DME_OTHER_THAN_WHEELCHAIR = 7;
}

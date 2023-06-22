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

enum DMEMACType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Wheelchairs, Components, and Accessories')]
    #[RangeAttribute('K0001', 'K0195')]
    #[PublicAttribute(true)]
    case WHEELCHAIR_COMPONENTS_ACCESSORIES = 1;

    #[NameAttribute('INFUSION PUMPS AND SUPPLIES')]
    #[RangeAttribute('K0455', 'K0605')]
    #[PublicAttribute(true)]
    case INFUSION_PUMPS_SUPPLIES = 2;

    #[NameAttribute('Automated External Defibrillator and Supplies')]
    #[RangeAttribute('K0606', 'K0609')]
    #[PublicAttribute(true)]
    case AUTOMATED_EXTERNAL_DEFIBRILLATOR_SUPPLIES = 3;

    #[NameAttribute('Miscellaneous DME and Accessories')]
    #[RangeAttribute('K0669', 'K0746')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DME_ACCESSORIES = 4;

    #[NameAttribute('Power Operated Vehicles')]
    #[RangeAttribute('K0800', 'K0812')]
    #[PublicAttribute(true)]
    case POWER_OPERATED_VEHICLES = 5;

    #[NameAttribute('Wheelchairs, Power Operated')]
    #[RangeAttribute('K0813', 'K0899')]
    #[PublicAttribute(true)]
    case WHEELCHAIRS_POWER_OPERATED = 6;

    #[NameAttribute('Customized DME, Other Than Wheelchair')]
    #[RangeAttribute('K0900', 'K0900')]
    #[PublicAttribute(true)]
    case CUSTOMIZED_DME_OTHER_THAN_WHEELCHAIR = 7;
}

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

enum EnteralParenteralTherapyType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Enteral Feeding Supplies and Equipment')]
    #[RangeAttribute('B4034', 'B4088')]
    #[PublicAttribute(true)]
    case ENTERAL_FEEDING_SUPPLIES_EQUIPMENT = 1;

    #[NameAttribute('Enteral Formulas and Additives')]
    #[RangeAttribute('B4100', 'B4162')]
    #[PublicAttribute(true)]
    case ENTERAL_FORMULAS_ADDITIVES = 2;

    #[NameAttribute('Parenteral Solutions and Supplies')]
    #[RangeAttribute('B4164', 'B5200')]
    #[PublicAttribute(true)]
    case PARENTERAL_SOLUTIONS_SUPPLIES = 3;

    #[NameAttribute('Nutrition Infusion Pumps and Supplies Not Otherwise Classified, NOC')]
    #[RangeAttribute('B9002', 'B9999')]
    #[PublicAttribute(true)]
    case NUTRITION_INFUSION_PUMPS_SUPPLIES_NOT_OTHERWISE_CLASSIFIED_NOC = 4;
}

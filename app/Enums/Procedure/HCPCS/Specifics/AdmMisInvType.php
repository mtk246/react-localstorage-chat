<?php

declare(strict_types=1);

namespace App\Enums\Procedure\HCPCS\Specifics;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasColorAttributes;

enum AdmMisInvType: int implements TypeInterface
{
    use HasColorAttributes;
    use HasChildAttribute;

    #[NameAttribute('Miscellaneous Supplies and Equipment')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_SUPPLIES = 1;

    #[NameAttribute('Diagnostic and Therapeutic Radiopharmaceuticals')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC_AND_THERAPEUTIC_RADIOPHARMACEUTICALS = 2;

    #[NameAttribute('Miscellaneous DME Supplies and Services')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DME_SUPPLIES = 3;
}

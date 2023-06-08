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

enum AdmMisInvType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Miscellaneous Supplies and Equipment')]
    #[RangeAttribute('A9150', 'A9300')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_SUPPLIES = 1;

    #[NameAttribute('Diagnostic and Therapeutic Radiopharmaceuticals')]
    #[RangeAttribute('A9500', 'A9800')]
    #[PublicAttribute(true)]
    case DIAGNOSTIC_AND_THERAPEUTIC_RADIOPHARMACEUTICALS = 2;

    #[NameAttribute('Miscellaneous DME Supplies and Services')]
    #[RangeAttribute('A9900', 'A9999')]
    #[PublicAttribute(true)]
    case MISCELLANEOUS_DME_SUPPLIES = 3;
}

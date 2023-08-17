<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT;

use App\Enums\Attributes\ChildAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\RangeAttribute;
use App\Enums\Interfaces\ProcedureClassificationInterface;
use App\Enums\Procedure\CPT\Specifics\CategoryIIIType;
use App\Enums\Procedure\CPT\Specifics\CategoryIIType;
use App\Enums\Procedure\CPT\Specifics\CategoryIType;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasRangeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum GeneralType: int implements ProcedureClassificationInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;
    use HasRangeAttribute;

    #[NameAttribute('Category I Codes')]
    #[ChildAttribute(CategoryIType::class)]
    #[RangeAttribute('00100', '99499')]
    #[PublicAttribute(true)]
    case CATEGORY_I = 1;

    #[NameAttribute('Category II Codes')]
    #[ChildAttribute(CategoryIIType::class)]
    #[RangeAttribute('0001F', '9007F')]
    #[PublicAttribute(true)]
    case CATEGORY_II = 2;

    #[NameAttribute('Category III Codes')]
    #[ChildAttribute(CategoryIIIType::class)]
    #[RangeAttribute('0042T', '0783T')]
    #[PublicAttribute(true)]
    case CATEGORY_III = 3;

    #[NameAttribute('Proprietary Laboratory Analyses')]
    #[RangeAttribute('0001U', '0386U')]
    #[PublicAttribute(true)]
    case PROPRIETARY_LABORATORY_ANALYSES = 4;
}

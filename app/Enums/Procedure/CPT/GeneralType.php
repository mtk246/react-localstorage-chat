<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT;

use App\Enums\Attributes\ChildAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\HasChildInterface;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Procedure\CPT\Specifics\CategoryIIIType;
use App\Enums\Procedure\CPT\Specifics\CategoryIIType;
use App\Enums\Procedure\CPT\Specifics\CategoryIType;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum GeneralType: int implements TypeInterface, HasChildInterface
{
    use HasTypeAttributes;
    use HasChildAttribute;

    #[NameAttribute('Category I Codes')]
    #[ChildAttribute(CategoryIType::class)]
    #[PublicAttribute(true)]
    case CATEGORY_I = 1;

    #[NameAttribute('Category II Codes')]
    #[ChildAttribute(CategoryIIType::class)]
    #[PublicAttribute(true)]
    case CATEGORY_II = 2;

    #[NameAttribute('Category III Codes')]
    #[ChildAttribute(CategoryIIIType::class)]
    #[PublicAttribute(true)]
    case CATEGORY_III = 3;

    #[NameAttribute('Proprietary Laboratory Analyses')]
    #[PublicAttribute(true)]
    case PROPRIETARY_LABORATORY_ANALYSES = 4;
}

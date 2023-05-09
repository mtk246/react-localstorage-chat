<?php

declare(strict_types=1);

namespace App\Enums\Procedure\CPT;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasColorAttributes;

enum GeneralType: int implements TypeInterface
{
    use HasColorAttributes;

    #[NameAttribute('Category I Codes')]
    #[PublicAttribute(true)]
    case CATEGORY_I = 1;

    #[NameAttribute('Category II Codes')]
    #[PublicAttribute(true)]
    case CATEGORY_II = 2;

    #[NameAttribute('Category III Codes')]
    #[PublicAttribute(true)]
    case CATEGORY_III = 3;

    #[NameAttribute('Proprietary Laboratory Analyses')]
    #[PublicAttribute(true)]
    case PROPRIETARY_LABORATORY_ANALYSES = 4;
}

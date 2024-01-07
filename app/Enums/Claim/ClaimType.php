<?php

declare(strict_types=1);

namespace App\Enums\Claim;

use App\Enums\Attributes\CodeAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasCodeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum ClaimType: int implements TypeInterface
{
    use HasTypeAttributes;
    use HasCodeAttribute;
    use EnumToArray;

    #[NameAttribute('professional')]
    #[CodeAttribute('1500')]
    #[PublicAttribute(true)]
    case PROFESSIONAL = 1;

    #[NameAttribute('institutional')]
    #[CodeAttribute('UB04')]
    #[PublicAttribute(true)]
    case INSTITUTIONAL = 2;
}

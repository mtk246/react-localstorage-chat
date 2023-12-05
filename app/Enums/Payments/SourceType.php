<?php

declare(strict_types=1);

namespace App\Enums\Payments;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;
use App\Enums\Traits\HasTypeAttributes;

enum SourceType: int implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasTypeAttributes;

    #[NameAttribute('Patient')]
    #[PublicAttribute(true)]
    case PATIENT = 1;

    #[NameAttribute('Insurance')]
    #[PublicAttribute(true)]
    case INSURANCE = 2;

    #[NameAttribute('Others')]
    #[PublicAttribute(true)]
    case OTHERS = 3;

    #[NameAttribute('Indivisible')]
    #[PublicAttribute(true)]
    case INDIVISIBLE = 4;
}

<?php

declare(strict_types=1);

namespace App\Enums\Payments;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;
use App\Enums\Traits\HasTypeAttributes;

enum RefileType: int implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasTypeAttributes;

    #[NameAttribute('Submit to secondary insurance')]
    #[PublicAttribute(true)]
    case SECONDARY = 1;

    #[NameAttribute('Corrected claims')]
    #[PublicAttribute(true)]
    case CORRECTED = 2;

    #[NameAttribute('Refile for another reason')]
    #[PublicAttribute(true)]
    case OTHER = 3;
}

<?php

declare(strict_types=1);

namespace App\Enums\Payments;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;
use App\Enums\Traits\HasTypeAttributes;

enum MethodType: int implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasTypeAttributes;

    #[NameAttribute('Credit Card')]
    #[PublicAttribute(true)]
    case CREDIT_CARD = 1;

    #[NameAttribute('CASH')]
    #[PublicAttribute(true)]
    case CASH = 2;

    #[NameAttribute('Check')]
    #[PublicAttribute(true)]
    case CHECK = 3;

    #[NameAttribute('Other')]
    #[PublicAttribute(true)]
    case OTHER = 4;
}

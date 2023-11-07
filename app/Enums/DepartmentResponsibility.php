<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasTypeAttributes;

enum DepartmentResponsibility: int implements TypeInterface
{
    use HasTypeAttributes;

    #[NameAttribute('Billing')]
    #[PublicAttribute(true)]
    case BILLING = 1;

    #[NameAttribute('Payment Posting')]
    #[PublicAttribute(true)]
    case PAYMENT = 2;

    #[NameAttribute('Collector')]
    #[PublicAttribute(true)]
    case COLLECTOR = 3;
}

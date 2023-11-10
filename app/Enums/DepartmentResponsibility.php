<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasTypeAttributes;

enum DepartmentResponsibility: string implements TypeInterface
{
    use HasTypeAttributes;

    #[NameAttribute('Billing')]
    #[PublicAttribute(true)]
    case BILLING = 'Billing';

    #[NameAttribute('Payment Posting')]
    #[PublicAttribute(true)]
    case PAYMENT = 'Payment Posting';

    #[NameAttribute('Collector')]
    #[PublicAttribute(true)]
    case COLLECTOR = 'Collector';
}

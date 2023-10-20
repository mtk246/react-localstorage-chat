<?php

declare(strict_types=1);

namespace App\Enums\User;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasTypeAttributes;

enum RoleType: int implements TypeInterface
{
    use HasTypeAttributes;

    #[NameAttribute('SYSTEM')]
    #[PublicAttribute(true)]
    case SYSTEM = 1;

    #[NameAttribute('BILLING COMPANY')]
    #[PublicAttribute(true)]
    case BILLING_COMPANY = 2;

    #[NameAttribute('Patient')]
    #[PublicAttribute(true)]
    case PATIENT = 3;

    #[NameAttribute('Health Professional')]
    #[PublicAttribute(true)]
    case DOCTOR = 4;
}

<?php

declare(strict_types=1);

namespace App\Enums\User;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasChildAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum UserType: int implements TypeInterface
{
    use HasChildAttribute;
    use HasTypeAttributes;

    #[NameAttribute('Super User')]
    #[PublicAttribute(true)]
    case ADMIN = 1;

    #[NameAttribute('Billing User')]
    #[PublicAttribute(true)]
    case BILLING = 2;

    #[NameAttribute('Patient')]
    #[PublicAttribute(false)]
    case PATIENT = 3;

    #[NameAttribute('Health professional')]
    #[PublicAttribute(false)]
    case DOCTOR = 4;
}

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

    #[NameAttribute('User')]
    #[PublicAttribute(true)]
    case USER = 2;
}

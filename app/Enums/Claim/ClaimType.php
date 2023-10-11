<?php

declare(strict_types=1);

namespace App\Enums\Claim;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasTypeAttributes;

enum ClaimType: int implements TypeInterface
{
    use HasTypeAttributes;

    #[NameAttribute('professional')]
    #[PublicAttribute(true)]
    case PROFESSIONAL = 1;

    #[NameAttribute('institutional')]
    #[PublicAttribute(true)]
    case INSTITUTIONAL = 2;
}

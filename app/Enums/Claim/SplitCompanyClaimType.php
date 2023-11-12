<?php

declare(strict_types=1);

namespace App\Enums\Claim;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\HasTypeAttributes;

enum SplitCompanyClaimType: int implements TypeInterface
{
    use HasTypeAttributes;

    #[NameAttribute('Physician')]
    #[PublicAttribute(true)]
    case PHYSICIAN = 1;

    #[NameAttribute('Hospital')]
    #[PublicAttribute(true)]
    case HOSPITAL = 2;
}

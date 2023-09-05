<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Attributes\CodeAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\PublicInterface;
use App\Enums\Traits\HasCodeAttribute;
use App\Enums\Traits\HasTypeAttributes;

enum ClearingHouse: int implements PublicInterface
{
    use HasTypeAttributes;
    use HasCodeAttribute;

    #[NameAttribute('Change Health Care')]
    #[CodeAttribute('ChangeHC')]
    #[PublicAttribute(true)]
    case CHANGE = 0; /* @todo Identificar del clearing house en base de datos */
}

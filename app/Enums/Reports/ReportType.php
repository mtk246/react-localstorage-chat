<?php

declare(strict_types=1);

namespace App\Enums\Reports;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;
use App\Enums\Traits\HasTypeAttributes;

enum ReportType: int implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasTypeAttributes;

    #[NameAttribute('General')]
    #[PublicAttribute(true)]
    case GENERAL = 1;

    #[NameAttribute('Custom')]
    #[PublicAttribute(true)]
    case CUSTOM = 2;
}

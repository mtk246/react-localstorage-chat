<?php

declare(strict_types=1);

namespace App\Enums\Payments;

use App\Enums\Attributes\BackgroundColorAttribute;
use App\Enums\Attributes\DescriptionAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\TextColorAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;
use App\Enums\Traits\HasColorsAttributes;

enum BatchStateType: int implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;
    use HasColorsAttributes;

    #[NameAttribute('In Progress')]
    #[DescriptionAttribute('In Progress')]
    #[BackgroundColorAttribute('#FFFAE6')]
    #[TextColorAttribute('#B04D12')]
    #[PublicAttribute(true)]
    case PROGRESS = 1;

    #[NameAttribute('Completed')]
    #[DescriptionAttribute('Completed')]
    #[BackgroundColorAttribute('#E9FDF2')]
    #[TextColorAttribute('#1B6D49')]
    #[PublicAttribute(true)]
    case COMPLETED = 2;

    #[NameAttribute('In Review')]
    #[DescriptionAttribute('In Review')]
    #[BackgroundColorAttribute('#E3F8FF')]
    #[TextColorAttribute('#018ECC')]
    #[PublicAttribute(true)]
    case REVIEW = 3;
}

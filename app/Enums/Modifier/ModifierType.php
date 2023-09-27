<?php

declare(strict_types=1);

namespace App\Enums\Modifier;

use App\Enums\Attributes\BackgroundColorAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\TextColorAttribute;
use App\Enums\Interfaces\ColorsTypeInterface;
use App\Enums\Traits\HasColorsAttributes;

enum ModifierType: int implements ColorsTypeInterface
{
    use HasColorsAttributes;

    #[TextColorAttribute('#804D12')]
    #[BackgroundColorAttribute('#FFFAEC')]
    #[NameAttribute('Informative')]
    #[PublicAttribute(true)]
    case Informative = 1;

    #[TextColorAttribute('#1B6D49')]
    #[BackgroundColorAttribute('#E9FDF2')]
    #[NameAttribute('Price')]
    #[PublicAttribute(true)]
    case PPRICE = 2;
}

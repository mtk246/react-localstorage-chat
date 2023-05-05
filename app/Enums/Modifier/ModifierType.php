<?php

declare(strict_types=1);

namespace App\Enums\Modifier;

use App\Enums\Attributes\ColorAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Traits\HasColorAttributes;

enum ModifierType: int
{
    use HasColorAttributes;

    #[ColorAttribute('#FFFAEC')]
    #[NameAttribute('Informative')]
    #[PublicAttribute(true)]
    case Informative = 1;

    #[ColorAttribute('#E9FDF2')]
    #[NameAttribute('Price')]
    #[PublicAttribute(true)]
    case PPRICE = 2;
}

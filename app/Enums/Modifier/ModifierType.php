<?php

declare(strict_types=1);

namespace App\Enums\Modifier;

use App\Enums\Attributes\ColorAttribute as BackgroundCollorAttribute;
use App\Enums\Attributes\ColorAttribute as TextCollorAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\ColorsTypeInterface;
use App\Enums\Traits\HasColorsAttributes;

enum ModifierType: int implements ColorsTypeInterface
{
    use HasColorsAttributes;

    #[TextCollorAttribute('#FFFAEC')]
    #[BackgroundCollorAttribute('#804D12')]
    #[NameAttribute('Informative')]
    #[PublicAttribute(true)]
    case Informative = 1;

    #[TextCollorAttribute('#E9FDF2')]
    #[BackgroundCollorAttribute('#1B6D49')]
    #[NameAttribute('Price')]
    #[PublicAttribute(true)]
    case PPRICE = 2;
}

<?php

declare(strict_types=1);

namespace App\Enums\Modifier;

use App\Enums\Attributes\BackgroundCollorAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Attributes\TextCollorAttribute;
use App\Enums\Interfaces\ColorsTypeInterface;
use App\Enums\Traits\HasColorsAttributes;

enum ModifierType: int implements ColorsTypeInterface
{
    use HasColorsAttributes;

    #[TextCollorAttribute('#804D12')]
    #[BackgroundCollorAttribute('#FFFAEC')]
    #[NameAttribute('Informative')]
    #[PublicAttribute(true)]
    case Informative = 1;

    #[TextCollorAttribute('#1B6D49')]
    #[BackgroundCollorAttribute('#E9FDF2')]
    #[NameAttribute('Price')]
    #[PublicAttribute(true)]
    case PPRICE = 2;
}

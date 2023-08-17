<?php

declare(strict_types=1);

namespace App\Enums\Company;

use App\Enums\Attributes\CodeAttribute;
use App\Enums\Attributes\DescriptionAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\CatalogInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;

enum ApplyToType: int implements CatalogInterface
{
    use EnumToArray;
    use HasAttributes;

    #[CodeAttribute('1')]
    #[DescriptionAttribute('Apply to 1')]
    #[PublicAttribute(true)]
    case APPLY_1 = 1;

    #[CodeAttribute('2')]
    #[DescriptionAttribute('Apply to 2')]
    #[PublicAttribute(true)]
    case APPLY_2 = 2;

    public function getCode(): string
    {
        return $this->getAttribute(CodeAttribute::class);
    }

    public function getDescription(): string
    {
        return $this->getAttribute(DescriptionAttribute::class);
    }

    public function getPublic(): bool
    {
        return $this->getAttribute(PublicAttribute::class);
    }
}

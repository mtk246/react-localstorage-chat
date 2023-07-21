<?php

declare(strict_types=1);

namespace App\Enums\Company;

use App\Enums\Attributes\CodeAttribute;
use App\Enums\Attributes\DescriptionAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\CatalogInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;

enum MeasurementUnit: int implements CatalogInterface
{
    use EnumToArray;
    use HasAttributes;

    #[CodeAttribute('F2')]
    #[DescriptionAttribute('International Unit')]
    #[PublicAttribute(true)]
    case F2 = 1;

    #[CodeAttribute('GR')]
    #[DescriptionAttribute('Gram')]
    #[PublicAttribute(true)]
    case GR = 2;

    #[CodeAttribute('ME')]
    #[DescriptionAttribute('Milligram')]
    #[PublicAttribute(true)]
    case ME = 3;

    #[CodeAttribute('ML')]
    #[DescriptionAttribute('Milliliter')]
    #[PublicAttribute(true)]
    case ML = 4;

    #[CodeAttribute('UN')]
    #[DescriptionAttribute('Unit')]
    #[PublicAttribute(true)]
    case UN = 5;

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

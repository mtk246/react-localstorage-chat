<?php

declare(strict_types=1);

namespace App\Enums\Reports;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\TypeInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;

enum TagType: int implements TypeInterface
{
    use EnumToArray;
    use HasAttributes;

    #[NameAttribute('tag one')]
    #[PublicAttribute(true)]
    case TAG_1 = 1;

    #[NameAttribute('tag two')]
    #[PublicAttribute(true)]
    case TAG_2 = 2;

    public function getName(): string
    {
        return $this->getAttribute(NameAttribute::class);
    }

    public function getPublic(): bool
    {
        return $this->getAttribute(PublicAttribute::class);
    }
}

<?php

declare(strict_types=1);

namespace App\Enums\Reports;

use App\Enums\Attributes\CodeAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;

enum TagType: int
{
    use EnumToArray;
    use HasAttributes;

    #[CodeAttribute('tag one')]
    #[PublicAttribute(true)]
    case TAG_1 = 1;

    #[CodeAttribute('tag two')]
    #[PublicAttribute(true)]
    case TAG_2 = 2;

    public function getCode(): string
    {
        return $this->getAttribute(CodeAttribute::class);
    }

    public function getPublic(): bool
    {
        return $this->getAttribute(PublicAttribute::class);
    }
}

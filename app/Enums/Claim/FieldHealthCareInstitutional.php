<?php

declare(strict_types=1);

namespace App\Enums\Claim;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\PublicInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;

enum FieldHealthCareInstitutional: int implements PublicInterface
{
    use EnumToArray;
    use HasAttributes;

    #[NameAttribute('76. Attending*')]
    #[PublicAttribute(true)]
    case FIELD_76 = 1;

    #[NameAttribute('77. Open Attending')]
    #[PublicAttribute(true)]
    case FIELD_77 = 2;

    #[NameAttribute('78. Other')]
    #[PublicAttribute(true)]
    case FIELD_78 = 3;

    #[NameAttribute('79. Other')]
    #[PublicAttribute(true)]
    case FIELD_79 = 4;

    public function getName(): string
    {
        return $this->getAttribute(NameAttribute::class);
    }

    public function getPublic(): bool
    {
        return $this->getAttribute(PublicAttribute::class);
    }
}

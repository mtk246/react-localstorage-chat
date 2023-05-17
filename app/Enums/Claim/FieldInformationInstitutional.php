<?php

declare(strict_types=1);

namespace App\Enums\Claim;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\PublicInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;

enum FieldInformationInstitutional: int implements PublicInterface
{
    use EnumToArray;
    use HasAttributes;

    #[NameAttribute('31. Ocurrence')]
    #[PublicAttribute(true)]
    case FIELD_31 = 1;

    #[NameAttribute('32. Ocurrence')]
    #[PublicAttribute(true)]
    case FIELD_32 = 2;

    #[NameAttribute('33. Ocurrence')]
    #[PublicAttribute(true)]
    case FIELD_33 = 3;

    #[NameAttribute('34. Ocurrence')]
    #[PublicAttribute(true)]
    case FIELD_34 = 4;

    #[NameAttribute('35. Ocurrence')]
    #[PublicAttribute(true)]
    case FIELD_35 = 5;

    #[NameAttribute('36. Ocurrence')]
    #[PublicAttribute(true)]
    case FIELD_36 = 6;

    public function getName(): string
    {
        return $this->getAttribute(NameAttribute::class);
    }

    public function getPublic(): bool
    {
        return $this->getAttribute(PublicAttribute::class);
    }
}

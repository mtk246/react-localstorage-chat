<?php

declare(strict_types=1);

namespace App\Enums\Claim;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\PublicInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;

enum FieldInformationProfessional: int implements PublicInterface
{
    use EnumToArray;
    use HasAttributes;

    #[NameAttribute('14. Date of current illnes, injury or pregnancy (LMP)')]
    #[PublicAttribute(true)]
    case FIELD_14 = 1;

    #[NameAttribute('15. Other date')]
    #[PublicAttribute(true)]
    case FIELD_15 = 2;

    #[NameAttribute('16. Dates patient unable to work in current occupation')]
    #[PublicAttribute(true)]
    case FIELD_16 = 3;

    #[NameAttribute('18. Hospitalization dates related to current services')]
    #[PublicAttribute(true)]
    case FIELD_18 = 4;

    #[NameAttribute('19. Additional claim information (Designated by NUCC)')]
    #[PublicAttribute(true)]
    case FIELD_19 = 5;

    public function getName(): string
    {
        return $this->getAttribute(NameAttribute::class);
    }

    public function getPublic(): bool
    {
        return $this->getAttribute(PublicAttribute::class);
    }
}

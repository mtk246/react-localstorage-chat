<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\PublicInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;

enum AddressType: int implements PublicInterface
{
    use EnumToArray;
    use HasAttributes;

    #[NameAttribute('Work')]
    #[PublicAttribute(true)]
    case WORK = 1;

    #[NameAttribute('House / Residence')]
    #[PublicAttribute(true)]
    case RESIDENCE = 2;

    #[NameAttribute('Payment')]
    #[PublicAttribute(false)]
    case PAYMENT = 4;

    #[NameAttribute('Other')]
    #[PublicAttribute(true)]
    case OTHER = 3;

    public function getName(): string
    {
        return $this->getAttribute(NameAttribute::class);
    }

    public function getPublic(): bool
    {
        return $this->getAttribute(PublicAttribute::class);
    }
}

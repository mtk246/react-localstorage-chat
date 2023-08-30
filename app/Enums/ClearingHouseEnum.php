<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Attributes\FileAttribute;
use App\Enums\Attributes\NameAttribute;
use App\Enums\Attributes\PublicAttribute;
use App\Enums\Interfaces\PublicInterface;
use App\Enums\Traits\EnumToArray;
use App\Enums\Traits\HasAttributes;

enum ClearingHouse: int implements PublicInterface
{
    use EnumToArray;
    use HasAttributes;

    #[NameAttribute('Change Health Care')]
    #[FileAttribute('ChangeHC-Payers.json')]
    #[PublicAttribute(true)]
    case CHANGE = 1; /** @todo Cambiar por el identificar del clearing house */

    public function getName(): string
    {
        return $this->getAttribute(NameAttribute::class);
    }

    public function getFile(): string
    {
        return $this->getAttribute(FileAttribute::class);
    }

    public function getPublic(): bool
    {
        return $this->getAttribute(PublicAttribute::class);
    }
}

<?php

declare(strict_types=1);

namespace App\Enums\Interfaces;

interface HasChildInterface extends PublicInterface
{
    /** @return RelatedEnumsInterface */
    public function getChild(): string;
}

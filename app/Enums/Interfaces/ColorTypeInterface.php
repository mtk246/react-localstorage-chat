<?php

declare(strict_types=1);

namespace App\Enums\Interfaces;

interface ColorTypeInterface extends PublicInterface
{
    public function getColor(): string;

    public function getName(): string;
}

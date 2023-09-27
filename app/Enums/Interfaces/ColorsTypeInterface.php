<?php

declare(strict_types=1);

namespace App\Enums\Interfaces;

interface ColorsTypeInterface extends PublicInterface
{
    public function getBackgroundColor(): string;

    public function getTextColor(): string;

    public function getName(): string;
}

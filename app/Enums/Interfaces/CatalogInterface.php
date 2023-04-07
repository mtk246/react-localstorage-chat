<?php

declare(strict_types=1);

namespace App\Enums\Interfaces;

interface CatalogInterface extends PublicInterface
{
    public function getCode(): string;

    public function getDescription(): string;
}

<?php

declare(strict_types=1);

namespace App\Enums\Interfaces;

interface ColorsTypeInterface extends PublicInterface
{
    public function getBackgroundCollor(): string;

    public function getTextCollor(): string;

    public function getName(): string;
}

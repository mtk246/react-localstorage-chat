<?php

declare(strict_types=1);

namespace App\Services\Claim;

interface DictionaryInterface
{
    public function translate(string $key): array|string|bool;

    public function toArray(): array;
}

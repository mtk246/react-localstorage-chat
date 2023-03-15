<?php

declare(strict_types=1);

namespace App\Http\Casts;

use App\Models\User;

abstract class CastsRequest
{
    /**
     * @param array<key, string|null> $inputs
     * @param array<key, string|null> $querys
     */
    public function __construct(
        protected array $inputs,
        protected array $querys,
        protected ?User $user,
    ) {
    }
}

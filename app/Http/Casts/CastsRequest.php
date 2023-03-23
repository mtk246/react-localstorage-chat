<?php

declare(strict_types=1);

namespace App\Http\Casts;

use App\Models\User;
use Illuminate\Support\Collection;

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

    protected function cast(string $input, string $class): ?object
    {
        return $this->inputs[$input]
            ? new $class($this->inputs[$input], $this->querys, $this->user)
            : null;
    }

    protected function castMany(string $input, string $class): ?Collection
    {
        return $this->inputs[$input]
            ? collect($this->inputs[$input])
                ->map(fn (array $input) => new $class($input, $this->querys, $this->user))
            : null;
    }
}

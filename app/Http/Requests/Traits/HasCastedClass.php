<?php

declare(strict_types=1);

namespace App\Http\Requests\Traits;

use Illuminate\Support\Collection;

trait HasCastedClass
{
    public function castedCollect(string $input): Collection
    {
        return collect($this->get($input))
            ->map(fn (mixed $item) => new $this->castedClass($item, $this->query(), $this->user()));
    }

    public function casted(): mixed
    {
        return new $this->castedClass($this->all(), $this->query(), $this->user());
    }
}

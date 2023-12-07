<?php

declare(strict_types=1);

namespace App\Http\Casts;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

abstract class CastsRequest
{
    protected Collection $inputs;

    public function __construct(
        Collection|array $inputs,
        protected ?Request $request = null,
        protected ?User $user = null,
    ) {
        $this->inputs = collect($inputs);
    }

    protected function has(string $input): bool
    {
        return $this->inputs->has($input);
    }

    /**
     * Get an item from the collection by key.
     *
     * @template TGetDefault
     *
     * @param TGetDefault|(\Closure(): TGetDefault) $default
     *
     * @return TValue|TGetDefault
     */
    protected function get(string $input, mixed $default = null): mixed
    {
        return $this->inputs->get($input, $default);
    }

    protected function getArray(string $input, mixed $default = null): array
    {
        $value = $this->get($input, $default);

        return $value ? (array) $value : [];
    }

    protected function getBool(string $input, mixed $default = null): bool
    {
        $value = $this->get($input, $default);

        return $value ? (bool) $value : false;
    }

    protected function getInt(string $input, mixed $default = null): ?int
    {
        $value = $this->get($input, $default);

        return $value ? (int) $value : $value;
    }

    protected function getCollect(string $input): Collection
    {
        return collect($this->getArray($input));
    }

    protected function getFileByName(string $input, string $name, array $allowedfileExtension): ?UploadedFile
    {
        if (!$this->request->hasFile($input)) {
            return null;
        }

        /** @var UploadedFile[] $files */
        $files = $this->request->file($input);

        foreach ($files as $file) {
            if ($name !== $file->getClientOriginalName()) {
                continue;
            }

            $extension = $file->getClientOriginalExtension();

            if (!in_array($extension, $allowedfileExtension)) {
                throw new \Exception('Invalid file type');
            }

            return $file;
        }

        return null;
    }

    protected function cast(string $input, string $class): ?object
    {
        return $this->has($input)
            ? new $class($this->inputs->get($input), $this->request, $this->user)
            : null;
    }

    protected function castMany(string $input, string $class): ?Collection
    {
        return $this->get($input)
            ? $this->getCollect($input)
                ->map(fn (array $input) => new $class(collect($input), $this->request, $this->user))
            : null;
    }
}

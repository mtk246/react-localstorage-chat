<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

final class IntegerOrArrayKeyExists implements Rule
{
    /** @param class-string $model */
    public function __construct(private string $model, private string $modelKey = 'id')
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     *
     * @param string $attribute
     * @param mixed $value
     */
    public function passes($attribute, $value): bool
    {
        if (is_array($value)) {
            $results = array_map(fn ($arrayKey) => $this->isValidKey($arrayKey), $value);

            return !in_array(false, $results, true);
        }

        return $this->isValidKey($value);
    }

    public function message(): string
    {
        return __('the value must be a valid key or a array of valid keys');
    }

    private function isValidKey(mixed $key): bool
    {
        return is_integer($key) && $this->model::where($this->modelKey, $key)->exists();
    }
}

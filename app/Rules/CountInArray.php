<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

final class CountInArray implements Rule
{
    public function __construct(private string $column, private mixed $value, private int $count)
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
        $valueFilter = array_filter($value, fn ($value) => $value[$this->column] && $value[$this->column] === $value);

        return count($valueFilter) === $this->count;
    }

    public function message(): string
    {
        return 'The validation error message.';
    }
}

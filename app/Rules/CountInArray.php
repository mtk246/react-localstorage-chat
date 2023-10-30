<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

final class CountInArray implements Rule
{
    private string $attribute;

    public function __construct(
        private readonly string $column,
        private readonly mixed $value,
        private readonly int $count,
    ) {
    }

    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     *
     * @param string $attribute
     */
    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;
        $valueFilter = array_filter($value, fn ($value) => $value[$this->column] && $value[$this->column] === $this->value);

        return count($valueFilter) === $this->count;
    }

    public function message(): string
    {
        return "the {$this->column} parameter must be {$this->value} only {$this->count} times in {$this->attribute}";
    }
}

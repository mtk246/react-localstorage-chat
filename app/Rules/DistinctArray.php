<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

final class DistinctArray implements Rule
{
    private string $attribute;

    /**
     * @param string $attribute
     * @param mixed $value
     */
    public function passes($attribute, $value): bool
    {
        $this->attribute = $attribute;

        return count($value) === count(array_unique($value));
    }

    public function message(): string
    {
        return "The {$this->attribute} field has a duplicate value.";
    }
}

<?php

declare(strict_types=1);

namespace App\Rules\Claim;

use Illuminate\Contracts\Validation\Rule;

final class RuleFormatRule implements Rule
{
    public function __construct(
        private readonly string $format
    ) {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

final class AddressValidationRule implements Rule
{
    private $expressions = [
        'Post Office Box', 'P.O. Box', 'PO Box', 'P O Box', 'P. O. BOX',
        'PO  BOX', 'Lock Box', 'Lock Bin', 'LOCKBOX', 'DRAWER', 'P O. Box',
        'PO. Box', 'P. O Box', 'PO   BOX', 'P.O.  Box', 'P O  Box',
        'PO BX', 'PO B OX', 'POB', 'P.O.', 'PO B', 'pob',
    ];

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($this->expressions as $expression) {
            if (false !== stripos($value, $expression)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El campo :attribute no debe contener ninguna de las expresiones prohibidas.';
    }
}

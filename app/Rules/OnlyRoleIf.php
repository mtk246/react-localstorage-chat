<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OnlyRoleIf implements Rule
{
    protected $exceptRole;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($exceptRole = [0])
    {
        $this->exceptRole = $exceptRole;
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
        if (count($value) > 1) {
            return !in_array_any($this->exceptRole, $value);
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('No more roles can be assigned to a super user');
    }
}

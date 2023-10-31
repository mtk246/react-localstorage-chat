<?php

declare(strict_types=1);

namespace App\Rules;

use App\Enums\User\RoleType;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Gate;

final class RoleTypeRule implements Rule
{
    /**
     * @param string $attribute
     * @param int|string $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $rulesTypes = collect(RoleType::cases())->when(
            Gate::denies('is-admin'),
            fn ($rules) => $rules->filter(fn ($rule) => RoleType::SYSTEM->value !== $rule->value),
        );

        return $rulesTypes->contains(fn ($rule) => $rule->value === (int) $value);
    }

    /** @return string */
    public function message()
    {
        return 'the role type is invalid.';
    }
}

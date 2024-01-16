<?php

declare(strict_types=1);

namespace App\Rules\Company;

use Illuminate\Contracts\Validation\Rule;

final class ExistModifierRevenueValidation implements Rule
{
    public function passes($attribute, $value)
    {
        $services = collect($value)->filter(
            fn ($item) => isset($item['procedure_id']) && isset($item['revenue_code_id']) && isset($item['modifier_id'])
        );

        if (!$services->isEmpty()) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'Either revenue_code_id or modifier_id must be null.';
    }
}

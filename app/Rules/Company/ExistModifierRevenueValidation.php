<?php

declare(strict_types=1);

namespace App\Rules\Company;

use Illuminate\Contracts\Validation\Rule;

final class ExistModifierRevenueValidation implements Rule
{
    public function passes($attribute, $value)
    {
        foreach ($value as $item) {
            $modifierId = $item['modifier_id'] ?? null;
            $revenueCodeId = $item['revenue_code_id'] ?? null;

            if ((!is_null($modifierId) && !is_null($revenueCodeId)) || (is_null($modifierId) && is_null($revenueCodeId))) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'Either revenue_code_id or modifier_id must be null.';
    }
}

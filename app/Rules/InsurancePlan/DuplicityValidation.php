<?php

declare(strict_types=1);

namespace App\Rules\InsurancePlan;

use Illuminate\Contracts\Validation\Rule;

final class DuplicityValidation implements Rule
{
    public function passes($attribute, $value): bool
    {
        $collection = collect($value)->map(
            fn ($service) => ($service['procedure_id'] ?? null).'-'.($service['revenue_code_id'] ?? null).'-'.($service['modifier_id'] ?? null)
        );

        return $collection->duplicates()->count() <= 0 ?? false;
    }

    public function message(): string
    {
        return 'There cannot be equal services, verify the information';
    }
}

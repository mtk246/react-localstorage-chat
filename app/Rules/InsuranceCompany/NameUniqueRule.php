<?php

declare(strict_types=1);

namespace App\Rules\InsuranceCompany;

use App\Models\InsuranceCompany;
use Illuminate\Contracts\Validation\Rule;

final class NameUniqueRule implements Rule
{
    public function __construct(
        private readonly string $payerID,
        private readonly ?int $excludedInsuranceCompanyId = null,
    ) {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !InsuranceCompany::query()
                ->whereRaw('LOWER(name) LIKE (?)', [strtolower("$value")])
                ->where('payer_id', '<>', $this->payerID)
                ->whereNot('id', $this->excludedInsuranceCompanyId)
                ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The insurance company name is already registered.';
    }
}

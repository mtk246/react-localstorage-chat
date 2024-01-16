<?php

declare(strict_types=1);

namespace App\Rules\InsurancePlan;

use App\Models\InsurancePlan;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

final class NameUniqueRule implements Rule
{
    public function __construct(
        private readonly string $payerID,
        private readonly ?int $billingCompanyId = null,
        private readonly ?int $excludedInsurancePlanId = null,
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
        if (Gate::check('is-admin')) {
            $billingCompany = $this->billingCompanyId;
        } else {
            $billingCompany = auth()->user()->billing_company_id;
        }

        return !InsurancePlan::query()
            ->whereRaw('UPPER(payer_id) = ?', [Str::upper($this->payerID)])
            ->whereRaw('UPPER(name) = ?', [Str::upper($value)])
            ->whereHas('billingCompanies', function ($query) use ($billingCompany) {
                $query->where('billing_company_id', $billingCompany);
            })
            ->whereNot('id', $this->excludedInsurancePlanId)
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The plan is already registered for the billing company, please verify it.';
    }
}

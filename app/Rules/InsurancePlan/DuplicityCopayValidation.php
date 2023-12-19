<?php

declare(strict_types=1);

namespace App\Rules\InsurancePlan;

use Illuminate\Contracts\Validation\Rule;

final class DuplicityCopayValidation implements Rule
{
    public function passes($attribute, $value): bool
    {
        $filterInsurancePlanIds = $this->hasDuplicateArrayIds($value, 'insurance_plan_ids');
        $filterProcedureIds = $this->hasDuplicateArrayIds($value, 'procedure_ids');
        $filterBillingCompanyIds = collect($value)->pluck('billing_company_id')->duplicates()->count() <= 0 ?? false;

        if ($filterInsurancePlanIds && $filterProcedureIds && $filterBillingCompanyIds) {
            return false;
        }

        return true;
    }

    public function message(): string
    {
        return 'There cannot be equal services, verify the information';
    }

    private function hasDuplicateArrayIds(array $contractFees, string $attribute): bool
    {
        $allElementsIds = collect($contractFees)->pluck($attribute);

        foreach ($allElementsIds as $key => $currentElementsIds) {
            $otherElementsIds = $allElementsIds->except($key)->flatten()->unique();

            if (empty($currentElementsIds) && $otherElementsIds->isEmpty()) {
                return true;
            }

            if ($otherElementsIds->intersect($currentElementsIds)->isNotEmpty()) {
                return true;
            }
        }

        return false;
    }
}

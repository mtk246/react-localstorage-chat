<?php

declare(strict_types=1);

namespace App\Rules\Company;

use Illuminate\Contracts\Validation\Rule;

final class DuplicityValidationRule implements Rule
{
    public function passes($attribute, $value)
    {
        $filterInsurancePlanIds = $this->hasDuplicateArrayIds($value, "insurance_plan_ids");
        $filterModifierIds = $this->hasDuplicateArrayIds($value, "procedure_ids");
        $filterProcedureIds = $this->hasDuplicateArrayIds($value, "modifier_ids");

        //search duplicity in billing_company_id and type_id
        $duplicateFound = $this->hasDuplicateBillingAndTypeIds($value);

        //search overlapping dates
        $overlappingDates = $this->hasOverlappingDates($value);

        //if no duplicity found, go to validate overlapping dates
        if ( $filterInsurancePlanIds && $filterModifierIds && $filterProcedureIds && $duplicateFound ) {
            if ($overlappingDates) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'There cannot be equal contracts, verify the information';
    }


    private function hasDuplicateArrayIds(array $contractFees, string $attribute): bool
    {
        $allElementsIds = collect($contractFees)->pluck($attribute);

        foreach ($allElementsIds as $key => $currentElementsIds) {
            $otherElementsIds = $allElementsIds->except($key)->flatten()->unique();

            if ($otherElementsIds->intersect($currentElementsIds)->isNotEmpty()) {
                return true;
            }
        }

        return false;
    }

    private function hasDuplicateBillingAndTypeIds(array $contractFees): bool
    {
        $contractFeesCollection = collect($contractFees);

        $duplicates = $contractFeesCollection->groupBy(function ($item) {
            return $item['billing_company_id'] . '-' . $item['type_id'];
        })->filter(function ($group) {
            return $group->count() > 1;
        });

        return $duplicates->isNotEmpty();
    }

    public function hasOverlappingDates(array $contractFees): bool
    {
        $contractFeesCollection = collect($contractFees);

        $overlapping = false;

        $contractFeesCollection->each(function ($contractFee, $index) use ($contractFeesCollection, &$overlapping) {
            $currentStartDate = $contractFee['start_date'];
            $currentEndDate = $contractFee['end_date'];

            $otherFees = $contractFeesCollection->except($index);

            $overlapping = $otherFees->contains(function ($otherContractFee) use ($currentStartDate, $currentEndDate) {
                $otherStartDate = $otherContractFee['start_date'];
                $otherEndDate = $otherContractFee['end_date'];

                return ($currentStartDate <= $otherEndDate) && ($currentEndDate >= $otherStartDate);
            });

            return !$overlapping; // Stop iteration if overlapping found
        });

        return $overlapping;
    }
}

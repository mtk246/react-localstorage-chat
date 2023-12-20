<?php

declare(strict_types=1);

namespace App\Rules\Company;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

final class DuplicityContractValidation implements Rule
{
    public function passes($attribute, $value): bool
    {
        $filterInsurancePlanIds = $this->hasDuplicateArrayIds($value, 'insurance_plan_ids');
        $filterModifierIds = $this->hasDuplicateArrayIds($value, 'modifier_ids');
        $filterProcedureIds = $this->hasDuplicateArrayIds($value, 'procedure_ids');

        // search duplicity in billing_company_id and type_id
        $duplicateFound = $this->hasDuplicateBillingAndTypeIds($value);

        // if no duplicity found, go to validate overlapping dates
        if ($filterInsurancePlanIds && $filterModifierIds && $filterProcedureIds && $duplicateFound) {
            if ($this->hasOverlappingDates($value)) {
                return false;
            }
        }

        return true;
    }

    public function message(): string
    {
        return 'There cannot be equal contracts, verify the information';
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

    private function hasDuplicateBillingAndTypeIds(array $contractFees): bool
    {
        $contractFeesCollection = collect($contractFees);

        $duplicates = $contractFeesCollection->groupBy(function ($item) {
            return $item['billing_company_id'].'-'.$item['type_id'];
        })->filter(function ($group) {
            return $group->count() > 1;
        });

        return $duplicates->isNotEmpty();
    }

    public function hasOverlappingDates(array $contractFees)
    {
        $contractFeesCollection = collect($contractFees);

        return $contractFeesCollection->search(function ($contractFee, $index) use ($contractFeesCollection) {
            $currentStartDate = isset($contractFee['start_date'])
                ? Carbon::createFromDate($contractFee['start_date'])->format('Y-m-d')
                : null;
            $currentEndDate = isset($contractFee['end_date'])
                ? Carbon::createFromDate($contractFee['end_date'])->format('Y-m-d')
                : null;

            $otherFees = $contractFeesCollection->except($index);

            return 0 == $otherFees->search(function ($otherContractFee) use ($currentStartDate, $currentEndDate) {
                $otherStartDate = isset($otherContractFee['start_date'])
                    ? Carbon::createFromDate($otherContractFee['start_date'])->format('Y-m-d')
                    : null;
                $otherEndDate = isset($otherContractFee['end_date'])
                    ? Carbon::createFromDate($otherContractFee['end_date'])->format('Y-m-d')
                    : null;

                if (null !== $currentStartDate || null !== $currentEndDate || null !== $otherStartDate || null !== $otherEndDate) {
                    if (
                        ($currentStartDate <= $otherStartDate && $currentEndDate <= $otherEndDate)
                        || (isset($currentStartDate) && $currentStartDate <= ($otherEndDate ?? $otherStartDate))
                        || (isset($currentStartDate) && $currentStartDate <= ($otherEndDate ?? $otherStartDate))
                    ) {
                        return true;
                    }
                }
            });
        });
    }
}

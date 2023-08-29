<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ClearingHouse;
use App\Models\InsurancePlan;
use App\Services\Claim\InsurancePlanDictionary;
use App\Services\Claim\InsurancePlanDictionaryInterface;

final class InsurancePlanService
{
    public function invoke(InsurancePlan $insurancePlan, ?string $type, ?ClearingHouse $clearingHouse): InsurancePlanDictionaryInterface
    {
        return new InsurancePlanDictionary($insurancePlan, $type, $clearingHouse);
    }
}

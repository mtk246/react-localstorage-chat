<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ClearingHouse;
use App\Models\InsurancePlan;
use App\Services\ClearingHouse\ClearingHouseAPI;
use App\Services\ClearingHouse\ClearingHouseAPIInterface;

final class ClearingHouseService
{
    public function create(InsurancePlan $insurancePlan, ?string $type, ?ClearingHouse $clearingHouse): ClearingHouseAPIInterface
    {
        return new ClearingHouseAPI($insurancePlan, $type);
    }
}

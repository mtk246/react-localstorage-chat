<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\ClearingHouse as ClearingHouseEnum;
use App\Models\ClearingHouse;
use App\Models\InsurancePlan;
use App\Services\ClearingHouse\ChangeHCAPI;
use App\Services\ClearingHouse\ClearingHouseAPI;
use App\Services\ClearingHouse\ClearingHouseAPIInterface;

final class ClearingHouseService
{
    public function create(InsurancePlan $insurancePlan, ?string $type, ?ClearingHouse $clearingHouse): ClearingHouseAPIInterface
    {
        /** @todo Falta agregar en el campo clearing house en la insuance company */
        return match($insurancePlan?->insuranceComapany?->clearing_house_id) {
             ClearingHouseEnum::CHANGE->value => new ChangeHCAPI($insurancePlan, $type),
             default => new ClearingHouseAPI($insurancePlan, $type),
        };
    }
}
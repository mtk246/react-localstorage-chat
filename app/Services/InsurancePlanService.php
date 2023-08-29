<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Resources\InsurancePlan\InsurancePlanResource;
use App\Models\ClearingHouse;
use App\Models\InsurancePlan;
use App\Services\ClearingHouse\ClearingHouseAPI;
use App\Services\ClearingHouse\ClearingHouseAPIInterface;

final class InsurancePlanService
{
    public function invoke(InsurancePlan $insurancePlan, ?string $type, ?ClearingHouse $clearingHouse): ClearingHouseAPIInterface
    {
        return match ($clearingHouse?->name ?? 'Change Health Care') {
            'Change Health Care' => new ClearingHouseAPI($insurancePlan, $type, 'ChangeHC'),
            default => throw new \InvalidArgumentException('Invalid format key'),
        }
    }

    public function search(string $payerID): InsurancePlanResource
    {
        return match ($clearingHouse?->name ?? 'Change Health Care') {
            'Change Health Care' => new ClearingHouseAPI($insurancePlan, $type, 'ChangeHC'),
            default => throw new \InvalidArgumentException('Invalid format key'),
        }
    }
}

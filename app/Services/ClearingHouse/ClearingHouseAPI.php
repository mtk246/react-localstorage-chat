<?php

declare(strict_types=1);

namespace App\Services\ClearingHouse;

use App\Models\ClearingHouse\AvailablePayer;
use App\Models\InsurancePlan;

abstract class ClearingHouseAPI implements ClearingHouseAPIInterface
{
    public function __construct(
        protected readonly ?InsurancePlan $insurance,
        protected readonly ?string $type,
    ) {
    }

    public function getCPIDByPayerID(string $payerID, string $payerName, int $type, bool $fakeTransmission = false): ?string
    {
        $availablePayer = AvailablePayer::query()
            ->where(
                [
                    'payer_id' => $payerID,
                    'name' => $payerName,
                ]
            )
            ->first();

        if (!$availablePayer) {
            throw new \Exception('Payer not found');
        }

        return ($fakeTransmission)
            ? $availablePayer->payerInformation
                ->where('type', $type)
                ?->first()
                ?->paper_cpid ?? ''
            : $availablePayer->payerInformation
                ->where('type', $type)
                ?->first()
                ?->cpid ?? '';
    }
}

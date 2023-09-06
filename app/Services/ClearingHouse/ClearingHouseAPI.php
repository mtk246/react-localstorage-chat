<?php

declare(strict_types=1);

namespace App\Services\ClearingHouse;

use App\Models\ClearingHouse\AvailablePayer;
use App\Models\InsurancePlan;

class ClearingHouseAPI implements ClearingHouseAPIInterface
{
    public function __construct(
        protected readonly ?InsurancePlan $insurance = null,
        protected readonly ?string $type = null,
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

    public function getByPayerID(string $payerID)
    {
        return AvailablePayer::query()
            ->with('payerInformation')
            ->where(
                [
                    'payer_id' => $payerID,
                ]
            )
            ->get()
            ->map(fn ($payer) => [
                'id' => $payer->name,
                'name' => $payer->name,
                'public_note' => $payer->payerInformation?->first()?->portal ?? '',
                'ins_type' => explode('/', $payer->payerInformation?->first()?->claim_insurance_type ?? '')[0] ?? '',
                'plan_type' => explode('/', $payer->payerInformation?->first()?->claim_insurance_type ?? '')[1] ?? '',
            ])->toArray();
    }
}

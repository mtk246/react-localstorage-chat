<?php

declare(strict_types=1);

namespace App\Services\Claim;

interface InsurancePlanDictionaryInterface
{
    public function getCPIDByPayerID(string $payerID, string $type): ?string;
}

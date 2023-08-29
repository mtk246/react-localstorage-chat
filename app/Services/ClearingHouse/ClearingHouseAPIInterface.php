<?php

declare(strict_types=1);

namespace App\Services\ClearingHouse;

interface ClearingHouseAPIInterface
{
    public function getCPIDByPayerID(string $payerID, string $type): ?string;
}

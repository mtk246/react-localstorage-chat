<?php

declare(strict_types=1);

namespace App\Services\ClearingHouse;

use App\Models\User;

interface ClearingHouseAPIInterface
{
    public function getDataByPayerID(
        string $payerID,
        string $payerName,
        int $type,
        bool $fakeTransmission,
        string $key
    ): ?string;

    public function getByPayerID(
        string $payerID,
        array $request,
        User $user
    ): ?array;
}

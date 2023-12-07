<?php

declare(strict_types=1);

namespace App\Http\Casts\Payments;

use App\Http\Casts\CastsRequest;

final class AddClaimsToBachWrapper extends CastsRequest
{
    public function getPaymentId(): int
    {
        return $this->getInt('id');
    }

    public function getClaimsIds(): array
    {
        return $this->getArray('claims');
    }
}

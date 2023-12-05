<?php

declare(strict_types=1);

namespace App\Http\Casts\Payments;

use App\Http\Casts\CastsRequest;

final class AdjustmentWrapper extends CastsRequest
{
    public function getAdjustmentId(): int
    {
        return $this->getInt('id', 0);
    }

    public function getData(string $currency): array
    {
        return [
            'currency' => $currency,
            'amount' => $this->getInt('amount'),
            'adj_reason' => $this->get('adj_reason'),
        ];
    }
}

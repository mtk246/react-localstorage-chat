<?php

declare(strict_types=1);

namespace App\Http\Casts\Payments;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;

final class ServiceWrapper extends CastsRequest
{
    public function getServiceId(): int
    {
        return $this->getInt('service_id');
    }

    public function getServiceData(string $currency): array
    {
        return [
            'claim_id' => $this->getInt('claim_id'),
            'currency' => $currency,
            'payment' => $this->getInt('payment'),
            'exp_adj' => $this->getInt('exp_adj'),
            'remain' => $this->getInt('remain'),
            'ins_amount' => $this->getInt('ins_amount'),
            'resp_insurance' => $this->get('resp_insurance'),
            'pt_resp' => $this->getInt('pt_resp'),
            'reason' => $this->get('reason'),
            'denial_reason' => $this->get('denial_reason'),
            'note' => $this->get('note'),
        ];
    }

    public function getAdjustments(): ?Collection
    {
        return $this->castMany('adjust', AdjustmentWrapper::class);
    }
}

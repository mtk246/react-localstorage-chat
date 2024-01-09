<?php

declare(strict_types=1);

namespace App\Http\Casts\Payments;

use App\Enums\Payments\MethodType;
use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;

final class PaymentWrapper extends CastsRequest
{
    public function getId(): int
    {
        return $this->getInt('id', 0);
    }

    public function getPaymentdata(int $paymentBatchId, int $order): array
    {
        return [
            'source' => $this->get('source_id'),
            'payment_date' => $this->get('payment_date'),
            'total_amount' => $this->get('amount'),
            'payment_method' => $this->get('method'),
            'reference' => $this->get('reference'),
            'statement' => $this->get('statement'),
            'note' => $this->get('note'),
            'insurance_plan_id' => $this->get('insurance_plan_id'),
            'payment_batch_id' => $paymentBatchId,
            'order' => $this->get('order', $order),
        ];
    }

    public function getMethod(): MethodType
    {
        return MethodType::from($this->getInt('method'));
    }

    public function getCardData(): array
    {
        return [
            'card_num' => $this->getInt('card_num'),
            'card_date' => $this->getInt('card_date'),
        ];
    }

    public function hasEob(): bool
    {
        return $this->hasArray('eobs');
    }

    public function getEobs(): ?Collection
    {
        return $this->castMany('eobs', EobWrapper::class);
    }
}
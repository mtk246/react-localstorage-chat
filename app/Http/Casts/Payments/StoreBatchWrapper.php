<?php

declare(strict_types=1);

namespace App\Http\Casts\Payments;

use App\Enums\Payments\BatchStateType;
use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

final class StoreBatchWrapper extends CastsRequest
{
    public function getBatchData(): array
    {
        return [
            'code' => Str::ulid(),
            'name' => $this->get('name'),
            'posting_date' => $this->get('posting_date'),
            'currency' => $this->get('currency'),
            'amount' => $this->get('amount'),
            'status' => BatchStateType::PROGRESS->value,
            'company_id' => $this->get('company_id'),
            'billing_company_id' => $this->get('billing_company_id'),
        ];
    }

    public function getUpdateBatchData(): array
    {
        return [
            'name' => $this->get('name'),
            'posting_date' => $this->get('posting_date'),
            'currency' => $this->get('currency'),
            'amount' => $this->get('amount'),
            'status' => BatchStateType::PROGRESS->value,
            'company_id' => $this->get('company_id'),
            'billing_company_id' => $this->get('billing_company_id'),
        ];
    }

    public function getPaymentsData(): Collection
    {
        return $this->castMany('payments', PaymentWrapper::class);
    }
}

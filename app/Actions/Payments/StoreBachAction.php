<?php

declare(strict_types=1);

namespace App\Actions\Payments;

use App\Enums\Payments\MethodType;
use App\Http\Casts\Payments\EobWrapper;
use App\Http\Casts\Payments\PaymentWrapper;
use App\Http\Casts\Payments\StoreBatchWrapper;
use App\Http\Resources\Payments\BatchResource;
use App\Models\Payments\Batch;
use App\Models\Payments\Payment;
use Illuminate\Support\Facades\DB;

final class StoreBachAction
{
    public function invoke(StoreBatchWrapper $request): BatchResource
    {
        return DB::transaction(function () use ($request): BatchResource {
            return new BatchResource(tap(Batch::query()->create($request->getBatchData()), function (Batch $batch) use ($request): void {
                $request->getPaymentsData()->each(function (PaymentWrapper $paymentRequest) use ($batch): void {
                    $paymentData = array_merge($paymentRequest->getPaymentdata(), [
                        'payment_batch_id' => $batch->id,
                    ]);
                    $payment = Payment::query()->create($paymentData);

                    if (MethodType::CREDIT_CARD === $paymentRequest->getMethod()) {
                        $payment->card()->create($paymentRequest->getCardData());
                    }

                    if ($paymentRequest->hasEob()) {
                        $paymentRequest->getEobs()->each(function (EobWrapper $eobRequest) use ($payment) {
                            $payment->eobs()->create($eobRequest->getEobData());
                        });
                    }
                });
            }));
        });
    }
}

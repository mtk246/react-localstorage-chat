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

final class UpdateBachAction
{
    public function invoke(Batch $batch, StoreBatchWrapper $request): BatchResource
    {
        return DB::transaction(function () use ($batch, $request): BatchResource {
            $batch->update($request->getBatchData());

            $batch->payments()->whereNotIn('id', $request->getPaymentsData()->map(
                fn (PaymentWrapper $paymentRequest) => $paymentRequest->getId()
            ))->delete();

            $request->getPaymentsData()->each(function (PaymentWrapper $paymentRequest) use ($batch): void {
                $payment = Payment::query()->updateOrCreate([
                    'id' => $paymentRequest->getId(),
                    'payment_batch_id' => $batch->id,
                ], $paymentRequest->getPaymentdata());

                if (MethodType::CREDIT_CARD === $paymentRequest->getMethod()) {
                    $payment->card()->updateOrCreate([
                        'payment_id' => $payment->id,
                    ], $paymentRequest->getCardData());
                }

                if ($paymentRequest->hasEob()) {
                    $paymentRequest->getEobs()->each(function (EobWrapper $eobRequest) use ($payment) {
                        $payment->eobs()->updateOrCreate([
                            'id' => $eobRequest->getId(),
                            'payment_id' => $payment->id,
                        ], $eobRequest->getEobData());
                    });
                }
            });

            return new BatchResource($batch->refresh());
        });
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Payments;

use App\Http\Casts\Payments\AddClaimsToBachWrapper;
use App\Http\Resources\Payments\BatchResource;
use App\Models\Payments\Batch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class AddClaimsToBachAction
{
    public function invoke(Batch $batch, Collection $request): BatchResource
    {
        return DB::transaction(function () use ($batch, $request): BatchResource {
            $request->each(function (AddClaimsToBachWrapper $paymentRequest) use ($batch): void {
                $payment = $batch->payments->where('id', $paymentRequest->getPaymentId())->first();
                $payment->claims()->sync($paymentRequest->getClaimsIds());
            });

            return new BatchResource($batch->refresh());
        });
    }
}

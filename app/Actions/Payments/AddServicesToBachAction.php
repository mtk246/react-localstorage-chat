<?php

declare(strict_types=1);

namespace App\Actions\Payments;

use App\Http\Casts\Payments\AddServicesToBachWrapper;
use App\Http\Casts\Payments\AdjustmentWrapper;
use App\Http\Casts\Payments\ServiceWrapper;
use App\Http\Resources\Payments\BatchResource;
use App\Models\Claims\Claim;
use App\Models\Claims\Services;
use App\Models\Payments\Batch;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class AddServicesToBachAction
{
    public function invoke(Batch $batch, Collection $request): BatchResource
    {
        return DB::transaction(function () use ($batch, $request): BatchResource {
            $request->each(function (AddServicesToBachWrapper $paymentRequest) use ($batch): void {
                $payment = $batch->payments->where('id', $paymentRequest->getPaymentId())->first();
                $claimsId = $paymentRequest->getClaimsIds();

                if ($claimsId->isNotEmpty()) {
                    $payment->claims()->sync($claimsId);
                }

                $payment->claims->each(function (Claim $claim) use ($paymentRequest, $batch) {
                    $syncServices = $paymentRequest->getServicesSyncData($batch->currency)->toArray();

                    $claim->payment->services()->sync($syncServices);

                    $servicesData = $paymentRequest->getServices();
                    $claim->payment->services->each(function (Services $service) use ($servicesData, $batch) {
                        /* @var ServiceWrapper $adjustments */
                        $adjustments = $servicesData->filter(fn (ServiceWrapper $serviceData) => $serviceData->getServiceId() === $service->id)
                            ->first();

                        $adjustments?->getAdjustments()->each(fn (AdjustmentWrapper $serviceData) => $service->pivot->adjustments()->updateOrCreate(
                            ['payment_service_id' => $service->pivot->id, 'id' => $serviceData->getAdjustmentId()],
                            $serviceData->getData($batch->currency)
                        ));
                    });
                });
            });

            return new BatchResource($batch->refresh());
        });
    }
}

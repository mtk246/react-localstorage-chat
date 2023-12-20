<?php

declare(strict_types=1);

namespace App\Actions\Payments;

use App\Facades\Pagination;
use App\Http\Casts\Payments\EobWrapper;
use App\Http\Resources\Payments\EobResource;
use App\Models\Payments\Payment;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

final class StorePaymentEobAction
{
    public function invoke(EobWrapper $request, Payment $payment): AnonymousResourceCollection
    {
        return DB::transaction(function () use ($request, $payment): AnonymousResourceCollection {
            $payment->eobs()->create($request->getEobData());

            return EobResource::collection(
                $payment->eobs()->orderBy(Pagination::sortBy(), Pagination::sortDesc())->paginate(Pagination::itemsPerPage())
            );
        });
    }
}

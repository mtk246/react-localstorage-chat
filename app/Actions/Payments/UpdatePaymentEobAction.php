<?php

declare(strict_types=1);

namespace App\Actions\Payments;

use App\Facades\Pagination;
use App\Http\Casts\Payments\EobWrapper;
use App\Http\Resources\Payments\EobResource;
use App\Models\Payments\Eob;
use App\Models\Payments\Payment;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

final class UpdatePaymentEobAction
{
    public function invoke(EobWrapper $request, Payment $payment, Eob $eob): AnonymousResourceCollection
    {
        return DB::transaction(function () use ($request, $payment, $eob): AnonymousResourceCollection {
            $eob->update($request->getUpdateData($payment->id));

            return EobResource::collection(
                $payment->eobs()->orderBy(Pagination::sortBy(), Pagination::sortDesc())->paginate(Pagination::itemsPerPage())
            );
        });
    }
}

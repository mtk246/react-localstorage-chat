<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payments;

use App\Facades\Pagination;
use App\Http\Resources\Payments\EobResource as EobApiResource;
use App\Actions\Payments\StorePaymentEobAction;
use App\Actions\Payments\UpdatePaymentEobAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\StorePaymentEob;
use App\Models\Payments\Batch;
use App\Models\Payments\Eob;
use App\Models\Payments\Payment;
use Illuminate\Http\JsonResponse;

final class EobResource extends Controller
{
    public function index(Batch $batch, Payment $payment): JsonResponse
    {
        $this->authorize('view', $batch);

        return response()->json(EobApiResource::collection(
            $payment->eobs()->orderBy(Pagination::sortBy(), Pagination::sortDesc())->paginate(Pagination::itemsPerPage())
        ));
    }

    public function store(StorePaymentEob $request, Batch $batch, Payment $payment, StorePaymentEobAction $store): JsonResponse
    {
        $this->authorize('update', $batch);

        return response()->json($store->invoke($request->casted(), $payment));
    }

    public function show(Batch $batch, Payment $payment, Eob $eob): JsonResponse
    {
        $this->authorize('view', $batch);

        return response()->json(new EobApiResource($eob));
    }

    public function update(StorePaymentEob $request, Batch $batch, Payment $payment, Eob $eob, UpdatePaymentEobAction $update): JsonResponse
    {
        $this->authorize('update', $batch);

        return response()->json($update->invoke($request->casted(), $payment, $eob));
    }

    public function destroy(Batch $batch, Payment $payment, Eob $eob): JsonResponse
    {
        $this->authorize('update', $batch);

        $eob->delete();

        return response()->json(EobApiResource::collection(
            $payment->eobs()->orderBy(Pagination::sortBy(), Pagination::sortDesc())->paginate(Pagination::itemsPerPage())
        ));
    }
}

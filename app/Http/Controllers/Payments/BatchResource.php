<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payments;

use App\Http\Resources\Payments\EobPaymentResource;
use App\Actions\Payments\GetBatchAction;
use App\Actions\Payments\StoreBachAction;
use App\Actions\Payments\UpdateBachAction;
use App\Enums\Payments\MethodType;
use App\Enums\Payments\SourceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\StoreBatchRequest;
use App\Actions\Payments\AddClaimsToBachAction;
use App\Actions\Payments\AddServicesToBachAction;
use App\Enums\Payments\BatchStateType;
use App\Facades\Pagination;
use App\Http\Requests\Payments\AddClaimToBatchRequest;
use App\Http\Requests\Payments\AddServicesToBatchRequest;
use App\Http\Resources\Enums\ColorsTypeResource;
use App\Http\Resources\Enums\EnumResource;
use App\Http\Resources\Enums\TypeResource;
use App\Http\Resources\Payments\BatchResource as BatchApiResource;
use App\Models\Payments\Batch;
use App\Models\Payments\Eob;
use App\Models\TypeCatalog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class BatchResource extends Controller
{
    public function index(Request $request, GetBatchAction $get): JsonResponse
    {
        return response()->json($get->all($request));
    }

    public function store(StoreBatchRequest $request, StoreBachAction $store): JsonResponse
    {
        return response()->json($store->invoke($request->casted()));
    }

    public function show(Batch $batch): JsonResponse
    {
        return response()->json(new BatchApiResource($batch));
    }

    public function update(StoreBatchRequest $request, Batch $batch, UpdateBachAction $update): JsonResponse
    {
        return response()->json($update->invoke($batch, $request->casted()));
    }

    public function destroy(Batch $batch): JsonResponse
    {
        return response()->json($batch->delete());
    }

    public function getStates(): JsonResponse
    {
        return response()->json(
            new EnumResource(collect(BatchStateType::cases()), ColorsTypeResource::class),
        );
    }

    public function getSources(): JsonResponse
    {
        return response()->json(
            new EnumResource(collect(SourceType::cases()), TypeResource::class),
        );
    }

    public function getMethods(): JsonResponse
    {
        return response()->json(
            new EnumResource(collect(MethodType::cases()), TypeResource::class),
        );
    }

    public function getCodes(): JsonResponse
    {
        return response()->json(TypeCatalog::query()->whereHas('type', function ($q) {
            $q->where('description', 'Claim adjustment reason code');
        })->get(['id', 'code', 'description']));
    }

    public function getEobs(Batch $batch): JsonResponse
    {
        $this->authorize('view', $batch);

        return response()->json(EobPaymentResource::collection(
            $batch->eobs()->orderBy(Pagination::sortBy(), Pagination::sortDesc())->paginate(Pagination::itemsPerPage())
        ));
    }

    public function showEob(Eob $eobFile)
    {
        return response()->file(storage_path('app/eobs/'.$eobFile->file_name))->setAutoEtag();
    }

    public function close(Batch $batch): JsonResponse
    {
        return response()->json(new BatchApiResource($batch->close()));
    }

    public function storeClaims(AddClaimToBatchRequest $request, AddClaimsToBachAction $add, Batch $batch): JsonResponse
    {
        return response()->json($add->invoke($batch, $request->castedCollect('payments')));
    }

    public function storeServices(AddServicesToBatchRequest $request, AddServicesToBachAction $add, Batch $batch): JsonResponse
    {
        return response()->json($add->invoke($batch, $request->castedCollect('payments')));
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payments;

use App\Actions\Payments\GetBatchAction;
use App\Actions\Payments\StoreBachAction;
use App\Actions\Payments\UpdateBachAction;
use App\Enums\Payments\MethodType;
use App\Enums\Payments\SourceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\storeBatchRequest;
use App\Http\Resources\Enums\ColorTypeResource;
use App\Http\Resources\Enums\EnumResource;
use App\Http\Resources\Enums\TypeResource;
use App\Http\Resources\Payments\BatchResource as BatchApiResource;
use App\Models\Payments\Batch;
use App\Models\Payments\Eob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class BatchResource extends Controller
{
    public function index(Request $request, GetBatchAction $get): JsonResponse
    {
        return response()->json($get->all($request));
    }

    public function store(storeBatchRequest $request, StoreBachAction $store): JsonResponse
    {
        return response()->json($store->invoke($request->casted()));
    }

    public function show(Batch $batch): JsonResponse
    {
        return response()->json(new BatchApiResource($batch));
    }

    public function update(Request $request, Batch $batch, UpdateBachAction $update): JsonResponse
    {
        return response()->json($update->invoke($batch, $request->casted()));
    }

    public function destroy(Request $request): JsonResponse
    {
        return response()->json();
    }

    public function getStates(): JsonResponse
    {
        return response()->json(
            new EnumResource(collect(MethodType::cases()), ColorTypeResource::class),
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

    public function showEob(Eob $eobFile)
    {
        return response()->file($eobFile->file_name);
    }
}

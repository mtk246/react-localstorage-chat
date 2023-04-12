<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Actions\Reports\GetReport;
use App\Actions\Reports\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\GetAllRequest;
use App\Http\Requests\Reports\StoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ReportReSource extends Controller
{
    public function index(GetAllRequest $request, GetReport $getReport): JsonResponse
    {
        return response()->json(
            $getReport->all($request->casted()),
        );
    }

    public function store(StoreRequest $request, StoreAction $store): JsonResponse
    {
        return response()->json(
            $store->invoke($request->casted())
        );
    }

    public function show(string $id, Request $request, GetReport $getReport): JsonResponse
    {
        return response()->json(
            $getReport->single($id, $request->user()),
        );
    }

    public function update(Request $request, $id): JsonResponse
    {
        return response()->json();
    }

    public function destroy($id): JsonResponse
    {
        return response()->json();
    }
}

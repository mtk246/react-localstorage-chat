<?php

namespace App\Http\Controllers\Reports;

use App\Actions\Reports\GetAllRecordsAction;
use App\Actions\Reports\GetReportAction;
use App\Actions\Reports\StoreReportAction;
use App\Actions\Reports\UpdateReportAction;
use App\Enums\Reports\ClassificationType;
use App\Enums\Reports\ColumnsAdminDetailPatinetType;
use App\Enums\Reports\ReportType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\GetAllRequest;
use App\Http\Requests\Reports\StoreRequest;
use App\Http\Requests\Reports\UpdateRequest;
use App\Http\Resources\Enums\EnumResource;
use App\Http\Resources\Enums\TypeResource;
use App\Http\Resources\Reports\ClassificationTypeResource;
use App\Http\Resources\Reports\ColumnsAdminDetailPatinetResource;
use App\Models\Reports\Report;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ReportReSource extends Controller
{
    public function index(GetAllRequest $request, GetReportAction $get): JsonResponse
    {
        return response()->json(
            $get->all($request->casted()),
        );
    }

    public function store(StoreRequest $request, StoreReportAction $store): JsonResponse
    {
        return response()->json(
            $store->invoke($request->casted())
        );
    }

    public function show(string $id, Request $request, GetReportAction $get): JsonResponse
    {
        return response()->json(
            $get->single($id, $request->user()),
        );
    }

    public function update(UpdateRequest $request, UpdateReportAction $update, Report $report): JsonResponse
    {
        if (!$this->authorize('update', $report)) {
            abort(403);
        }

        return response()->json(
            $update->invoke($request->casted(), $report)
        );
    }

    public function destroy(Report $report): JsonResponse
    {
        if (!$this->authorize('destroy', $report)) {
            abort(403);
        }

        $report->delete();

        return response(status: 200)->json(['message' => 'Report deleted successfully.']);
    }

    public function classifications(): JsonResponse
    {
        return response()->json(
            new EnumResource(collect(ClassificationType::cases()), ClassificationTypeResource::class),
        );
    }

    public function types(): JsonResponse
    {
        return response()->json(
            new EnumResource(collect(ReportType::cases()), TypeResource::class),
        );
    }

    public function allRecords(Request $request, GetAllRecordsAction $get): JsonResponse {
        return response()->json(
            $get->getAllPatient($request->module, Auth::user())
        );
    }
}

<?php

namespace App\Http\Controllers\Reports;

use App\Actions\Reports\GetAllRecordsAction;
use App\Actions\Reports\GetReportAction;
use App\Actions\Reports\StoreReportAction;
use App\Actions\Reports\UpdateReportAction;
use App\Enums\Reports\ClassificationType;
use App\Enums\Reports\ColumnsAdminDetailPatinetType;
use App\Enums\Reports\ColumnsAdminPayerMixType;
use App\Enums\Reports\ColumnsAdminProfessionalProductivityType;
use App\Enums\Reports\ColumnsAdminViewBaddebtCost;
use App\Enums\Reports\ColumnsBillingDetailPatinetType;
use App\Enums\Reports\ColumnsBillingGeneralFacilityType;
use App\Enums\Reports\ColumnsBillingGeneralHealthcareProfessionalType;
use App\Enums\Reports\ColumnsBillingGeneralPatinetType;
use App\Enums\Reports\ColumnsGeneralFacilityType;
use App\Enums\Reports\ColumnsGeneralHealthcareProfessionalType;
use App\Enums\Reports\ColumnsGeneralPatinetType;
use App\Enums\Reports\ColumnsPayerMixType;
use App\Enums\Reports\ColumnsProfessionalProductivityType;
use App\Enums\Reports\ColumnsviewBaddebtCost;
use App\Enums\Reports\ColumnsViewChangeModule;
use App\Enums\Reports\ColumnsViewDailyInsuranceResponsibilityAging;
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
use Gate;
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

    public function records(Request $request, GetAllRecordsAction $get): JsonResponse
    {
        return response()->json(
            $get->getAllPatient($request, Auth::user())
        );
    }

    public function columnsReports(): JsonResponse
    {
        $rs = Gate::check('is-admin')
            ? [
                'PGFOODVKOC' => new EnumResource(collect(ColumnsAdminDetailPatinetType::cases()), ColumnsAdminDetailPatinetResource::class),
                'JBEPEUZRBK' => new EnumResource(collect(ColumnsGeneralPatinetType::cases()), ColumnsAdminDetailPatinetResource::class),
                'QVHZFWCVGJ' => new EnumResource(collect(ColumnsGeneralFacilityType::cases()), ColumnsAdminDetailPatinetResource::class),
                'HHSUUILJFV' => new EnumResource(collect(ColumnsAdminPayerMixType::cases()), ColumnsAdminDetailPatinetResource::class),
                'TPEMOBKSKL' => new EnumResource(collect(ColumnsAdminProfessionalProductivityType::cases()), ColumnsAdminDetailPatinetResource::class),
                'QNSJADXODC' =>
                new EnumResource(collect(ColumnsGeneralHealthcareProfessionalType::cases()), ColumnsAdminDetailPatinetResource::class),
                'WSTRTDBWPZ' => new EnumResource(collect(ColumnsAdminViewBaddebtCost::cases()), ColumnsAdminDetailPatinetResource::class),
                'ZHJZLMVKWP' => new EnumResource(collect(ColumnsViewChangeModule::cases()), ColumnsAdminDetailPatinetResource::class),
                'GTGFOJQBHQ' => new EnumResource(collect(ColumnsViewDailyInsuranceResponsibilityAging::cases()), ColumnsAdminDetailPatinetResource::class),
            ]
            : [
                'PGFOODVKOC' => new EnumResource(collect(ColumnsBillingDetailPatinetType::cases()), ColumnsAdminDetailPatinetResource::class),
                'JBEPEUZRBK' => new EnumResource(collect(ColumnsBillingGeneralPatinetType::cases()), ColumnsAdminDetailPatinetResource::class),
                'QVHZFWCVGJ' => new EnumResource(collect(ColumnsBillingGeneralFacilityType::cases()), ColumnsAdminDetailPatinetResource::class),
                'QNSJADXODC' => new EnumResource(collect(ColumnsBillingGeneralHealthcareProfessionalType::cases()), ColumnsAdminDetailPatinetResource::class),
                'HHSUUILJFV' => new EnumResource(collect(ColumnsPayerMixType::cases()), ColumnsAdminDetailPatinetResource::class),
                'TPEMOBKSKL' => new EnumResource(collect(ColumnsProfessionalProductivityType::cases()), ColumnsAdminDetailPatinetResource::class),
                'WSTRTDBWPZ' => new EnumResource(collect(ColumnsviewBaddebtCost::cases()), ColumnsAdminDetailPatinetResource::class),
                'ZHJZLMVKWP' => new EnumResource(collect(ColumnsViewChangeModule::cases()), ColumnsAdminDetailPatinetResource::class),
                'GTGFOJQBHQ' => new EnumResource(collect(ColumnsViewDailyInsuranceResponsibilityAging::cases()), ColumnsAdminDetailPatinetResource::class),
            ];

        if (!$rs) return response()->json(__('Columns list not available'), 400);

        return response()->json(['success' => true, "message" => "Columns list successfully.", 'data' => $rs]);
    }
}

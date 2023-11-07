<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Repositories\FacilityReportRepository;
use App\Repositories\PatientReportRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class HomeController extends Controller
{
    public function __construct(
        private PatientReportRepository $patientReportRepository,
        private FacilityReportRepository $facilityReportRepository
    ) {
    }

    public function existingReports(): JsonResponse
    {
        try {
            $rs = [
                'detailed patient' => $this->patientReportRepository->getAllNamesClounms(),
                'general patient' => $this->patientReportRepository->getAllNamesClounms(),
                'facility' => $this->facilityReportRepository->getAllNamesClounms(),
            ];

            if (!$rs) return response()->json(__('Columns list not available'), 400);

            return response()->json(['success' => true, "message" => "Columns list successfully.", 'data' => $rs]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function report(Request $request)
    {
        switch ($request->module) {
            case 'detailed patient':
                return $this->patientReportRepository->getAllPatient();
                break;

            case 'general patient':
                return $this->patientReportRepository->getAllGeneralPatient();
                break;

            case 'facility':
                return $this->facilityReportRepository->getAllFacility();
                break;

            default:
                return response()->json(__('Module not available'), 400);
                break;
        }
    }
}

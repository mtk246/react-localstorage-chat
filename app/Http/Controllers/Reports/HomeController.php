<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Repositories\FacilityReportRepository;
use App\Repositories\HealthcareProfessionalRepository;
use App\Repositories\PatientReportRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class HomeController extends Controller
{
    public function __construct(
        private PatientReportRepository $patientReportRepository,
        private FacilityReportRepository $facilityReportRepository,
        private HealthcareProfessionalRepository $healthcareProfessionalRepository,
    ) {
    }

    public function existingReports(): JsonResponse
    {
        try {
            $rs = [
                'detailed patient' => $this->patientReportRepository->getAllNamesClounms(),
                'general patient' => $this->patientReportRepository->getGeneralNamesClounms(),
                'facility' => $this->facilityReportRepository->getAllNamesClounms(),
                'general healthcare' => $this->healthcareProfessionalRepository->getAllNamesClounms(),
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
                return [
                    "result" => $this->patientReportRepository->getAllPatient(),
                    "headers" => $this->patientReportRepository->getAllNamesClounms()
                ];
                break;

            case 'general patient':
                return [
                    "result" => $this->patientReportRepository->getAllGeneralPatient(),
                    "headers" => $this->patientReportRepository->getGeneralNamesClounms()
                ];
                break;

            case 'general facility':
                return [
                    "result" => $this->facilityReportRepository->getAllFacility(),
                    "headers" => $this->facilityReportRepository->getAllNamesClounms()
                ];
                break;
            case 'general healthcare':
                return [
                    "result" => $this->healthcareProfessionalRepository->getHealthcareProfessional(),
                    "headers" => $this->healthcareProfessionalRepository->getAllNamesClounms()
                ];
                break;

            default:
                return response()->json(__('Module not available'), 400);
                break;
        }
    }
}

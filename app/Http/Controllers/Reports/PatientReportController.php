<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Repositories\PatientReportRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PatientReportController extends Controller
{
    public function __construct(private PatientReportRepository $patientReportRepository){}

    public function detailedPatientSuperUser()
    {
        try {
            $rs = $this->patientReportRepository->getAllPatient();
            return $rs ? response()->json($rs) : response()->json(__('Data not available'), 400);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function detailedPatientBillingManager()
    {
        try {
            $billingCompanyId = \Auth::user()->billing_company_id;
            $rs = $this->patientReportRepository->getAllPatientBillingManager($billingCompanyId);
            return $rs ? response()->json($rs) : response()->json(__('Data not available'), 400);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function generalPatient()
    {
        try {
            $rs = $this->patientReportRepository->getAllGeneralPatient();
            return $rs ? response()->json($rs) : response()->json(__('Data not available'), 400);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function generalPatientBillingManager()
    {
        try {
            $billingCompanyId = \Auth::user()->billing_company_id;
            $rs = $this->patientReportRepository->getAllGeneralPatientBillingManager($billingCompanyId);
            return $rs ? response()->json($rs) : response()->json(__('Data not available'), 400);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}

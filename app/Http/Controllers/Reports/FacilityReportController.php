<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Repositories\FacilityReportRepository;
use Illuminate\Http\JsonResponse;

final class FacilityReportController extends Controller
{
    public function __construct(private FacilityReportRepository $facilityReportRepository){}

    public function allFacility(): JsonResponse
    {
        try {
            $rs = $this->facilityReportRepository->getAllFacility();
            return $rs ? response()->json($rs) : response()->json(__('Data not available'), 400);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function facilityByBillingCompany(): JsonResponse
    {
        try {
            $billingCompanyId = \Auth::user()->billing_company_id;
            $rs = $this->facilityReportRepository->getFacilityByBillingCompany($billingCompanyId);
            return $rs ? response()->json($rs) : response()->json(__('Data not available'), 400);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}

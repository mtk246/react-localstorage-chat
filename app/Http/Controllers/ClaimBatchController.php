<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\Http\Requests\Claim\ClaimBatchRequest;
use App\Repositories\ClaimBatchRepository;
use App\Repositories\ReportRepository;
use App\Models\ClaimBatch;

class ClaimBatchController extends Controller
{
    private $claimBatchRepository;

    public function __construct()
    {
        $this->claimBatchRepository = new ClaimBatchRepository();
    }

    /**
     * @param ClaimBatchRequest $request
     * @return JsonResponse
     */
    public function createBatch(ClaimBatchRequest $request)
    {
        $rs = $this->claimBatchRepository->createBatch($request->validated());

        return $rs ? response()->json($rs) : response()->json(__("Error creating claim batch"), 400);
    }

    /**
     * @param ClaimBatchRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function updateBatch(ClaimBatchRequest $request, $id)
    {
        $rs = $this->claimBatchRepository->updateBatch($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__("Error updating claim batch"), 400);
    }

    public function getServerAll(Request $request)
    {
        return $this->claimBatchRepository->getServerAll($request);
    }

    public function getServerClaims(Request $request)
    {
        return $this->claimBatchRepository->getServerAllClaims($request);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneClaimBatch(int $id)
    {
        $rs = $this->claimBatchRepository->getOneBatch($id);

        return $rs ? response()->json($rs) : response()->json(__("Error, claim batch not found"), 404);
    }

    /**
     * @param integer $id
     * @return JsonResponse
     */
    public function deleteBatch(int $id)
    {
        $rs = $this->claimBatchRepository->deleteBatch($id);

        return $rs ? response()->json($rs) : response()->json(__("Error erasing claim batch"), 400);
    }

    /**
     * @param integer $id
     * @return JsonResponse
     */
    public function submitToClearingHouse($id)
    {
        $rs = $this->claimBatchRepository->submitToClearingHouse($id);

        return $rs ? response()->json($rs) : response()->json(__("Error submitting claim batch"), 400);
    }

    public function showReport($id) {
        $pdf = new ReportRepository();
        $batch = ClaimBatch::with([
            'claims' => function ($query) {
                $query->with('claimFormattable', 'insurancePolicies', 'claimFormattable');
            }
        ])->find($id);

        $claim = $batch->claims->first();

        if (isset($claim)) {
            $insurancePolicies = [];

            foreach ($claim->insurancePolicies ?? [] as $insurancePolicy) {
                array_push($insurancePolicies, $insurancePolicy->id);
            }
            $pdf->setConfig([
                'urlVerify' => 'www.google.com.ve',
                'typeFormat' => $claim->format ?? null,
                'patient_id' => $claim->patient_id ?? null,
                'billing_company_id' => $claim->claimFormattable->billing_company_id ?? null,
                'insurance_policies' => $insurancePolicies ?? [],
            ]);

        } else {
            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $request->billing_company_id;
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }
            $pdf->setConfig([
                'urlVerify' => 'www.google.com.ve',
                'typeFormat' => ($request->format != '') ? $request->format : null,
                'patient_id' => ($request->patient_id != '') ? $request->patient_id : null,
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
                'insurance_policies' => $request->insurance_policies ?? [],
            ]);

        }
        $pdf->setHeader('');
        //$pdf->setFooter();
        return explode("\n\r\n", $pdf->setBody('pdf.837P', true, [
            'pdf'      => $pdf
        ]))[1];
        /**$pdf->setBody('pdf.837P', true, ['pdf' => $pdf]);*/
    }
}

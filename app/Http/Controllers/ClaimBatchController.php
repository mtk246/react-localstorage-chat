<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\Http\Requests\Claim\ClaimBatchRequest;
use App\Repositories\ClaimBatchRepository;
use App\Repositories\ClaimRepository;
use App\Repositories\ReportRepository;
use App\Models\ClaimBatch;

class ClaimBatchController extends Controller
{
    private $claimBatchRepository;
    private $claimRepository;

    public function __construct()
    {
        $this->claimBatchRepository = new ClaimBatchRepository();
        $this->claimRepository = new ClaimRepository();
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
        $token = $this->claimRepository->getSecurityAuthorizationAccessToken();

        if (!isset($token)) return response()->json(__("Error get security authorization access token"), 400);

        $rs = $this->claimBatchRepository->submitToClearingHouse($token->access_token ?? '', $id);

        return $rs ? response()->json($rs) : response()->json(__("Error submitting claim batch"), 400);
    }

    public function showReport(Request $request, int $id) {
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
                'print' => $request->print ?? false,
                'typeFormat' => $claim->format ?? null,
                'patient_id' => $claim->patient_id ?? null,
                'claim_form_services' => $claim->claimFormattable->claimFormServices ?? [],
                'patient_or_insured_information' => $claim->claimFormattable->patientOrInsuredInformation ?? null,
                'physician_or_supplier_information' => $claim->claimFormattable->physicianOrSupplierInformation ?? null,
                'billing_company_id' => $claim->claimFormattable->billing_company_id ?? null,
                'billing_provider_id' => $claim->billing_provider_id ?? null,
                'service_provider_id' => $claim->service_provider_id ?? null,
                'referred_id' => $claim->referred_id ?? null,
                'company_id' => $claim->company_id ?? null,
                'facility_id' => $claim->facility_id ?? null,
                'insurance_policies' => $insurancePolicies ?? [],
                'diagnoses' => $claim->diagnoses ?? [],
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

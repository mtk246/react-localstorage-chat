<?php

namespace App\Http\Controllers;

use App\Http\Requests\Claim\ClaimCreateRequest;
use App\Http\Requests\Claim\ClaimDraftRequest;
use App\Http\Requests\Claim\ClaimVerifyRequest;
use App\Http\Requests\Claim\ClaimChangeStatusRequest;
use App\Repositories\ClaimRepository;
use App\Repositories\ReportRepository;
use App\Models\Claim;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    private $claimRepository;

    public function __construct()
    {
        $this->claimRepository = new ClaimRepository();
    }

    /**
     * @param claimCreateRequest $request
     * @return JsonResponse
     */
    public function saveAsDraft(ClaimDraftRequest $request)
    {
        $rs = $this->claimRepository->createClaim($request->validated());

        return $rs ? response()->json($rs) : response()->json(__("Error creating claim"), 400);
    }

    /**
     * @param claimCreateRequest $request
     * @return JsonResponse
     */
    public function updateAsDraft(ClaimDraftRequest $request, $id)
    {
        $rs = $this->claimRepository->updateClaim($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__("Error updating claim"), 400);
    }

    /**
     * @param claimCreateRequest $request
     * @return JsonResponse
     */
    public function createClaim(ClaimCreateRequest $request)
    {
        $rs = $this->claimRepository->createClaim($request->validated());

        return $rs ? response()->json($rs) : response()->json(__("Error creating claim"), 400);
    }

    /**
     * @param claimCreateRequest $request
     * @return JsonResponse
     */
    public function updateClaim(ClaimCreateRequest $request, $id)
    {
        $rs = $this->claimRepository->updateClaim($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__("Error updating claim"), 400);
    }

    public function getAllClaims(Request $request)
    {
        $status = (is_array($request->status)) ? $request->status : json_decode($request->status);
        $subStatus = (is_array($request->subStatus)) ? $request->subStatus : json_decode($request->subStatus);
        return response()->json(
            $this->claimRepository->getAllClaims($status ?? [], $subStatus ?? [])
        );
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneClaim(int $id): JsonResponse
    {
        $rs = $this->claimRepository->getOneClaim($id);

        return $rs ? response()->json($rs) : response()->json(__("Error, claim not found"), 404);
    }

    public function getListClaimServices(Request $request)
    {
        $rs = $this->claimRepository->getListClaimServices($request);
        //$rs = $this->claimRepository->getListTypeOfServices();

        return response()->json($rs);
    }

    public function getListTypeOfServices()
    {
        $rs = $this->claimRepository->getListTypeOfServices();

        return $rs ? response()->json($rs) : response()->json(__("Error get all service type of service"), 400);
    }

    public function getListPlaceOfServices()
    {
        $rs = $this->claimRepository->getListPlaceOfServices();

        return $rs ? response()->json($rs) : response()->json(__("Error get all service place of service"), 400);
    }

    public function getListRevCenters()
    {
        $rs = $this->claimRepository->getListRevCenters();

        return $rs ? response()->json($rs) : response()->json(__("Error get all service rev. Centers"), 400);
    }

    public function getListTypeFormats()
    {
        $rs = $this->claimRepository->getListTypeFormats();

        return $rs ? response()->json($rs) : response()->json(__("Error get all type formats"), 400);
    }

    public function getListClaimFieldInformations()
    {
        $rs = $this->claimRepository->getListClaimFieldInformations();

        return response()->json($rs);
    }

    public function getListFieldQualifiers(int $id)
    {
        $rs = $this->claimRepository->getListFieldQualifiers($id);

        return response()->json($rs);
    }

    public function getListTypeDiags()
    {
        $rs = $this->claimRepository->getListTypeDiags();

        return $rs ? response()->json($rs) : response()->json(__("Error get all type diags"), 400);
    }

    public function getListStatus()
    {
        $rs = $this->claimRepository->getListStatus();

        return $rs ? response()->json($rs) : response()->json(__("Error get all status claim"), 400);
    }

    /**
     * Security Authorization Access Token
     *
     * @method getSecurityAuthorizationAccessToken
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function getSecurityAuthorizationAccessToken(): JsonResponse
    {
        $rs = $this->claimRepository->getSecurityAuthorizationAccessToken();

        return $rs ? response()->json($rs) : response()->json(__("Error get security authorization access token"), 400);
    }

    /**
     * Eligibility
     *
     * @method checkEligibility
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function checkEligibility(int $id): JsonResponse
    {
        $token = $this->claimRepository->getSecurityAuthorizationAccessToken();

        if (!isset($token)) return response()->json(__("Error get security authorization access token"), 400);
        
        $rs = $this->claimRepository->checkEligibility($token->access_token ?? '', $id);

        return response()->json($rs);
    }

    /**
     * Validation
     *
     * @method claimValidation
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function claimValidation(int $id): JsonResponse
    {
        $token = $this->claimRepository->getSecurityAuthorizationAccessToken();

        if (!isset($token)) return response()->json(__("Error get security authorization access token"), 400);
        
        $rs = $this->claimRepository->claimValidation($token->access_token ?? '', $id);

        return $rs ? response()->json($rs) : response()->json(__("Error get claim validation"), 400);
    }


    /**
     * @param claimCreateRequest $request
     * @return JsonResponse
     */
    public function saveAsDraftAndEligibility(ClaimDraftRequest $request)
    {
        $claim = $this->claimRepository->createClaim($request->validated());

        if (!isset($claim)) return response()->json(__("Error save claim"), 400);

        return $this->checkEligibility($claim->id);
    }

    /**
     * @param claimCreateRequest $request
     * @return JsonResponse
     */
    public function verifyAndRegister(ClaimVerifyRequest $request, int $id)
    {
        $rs = Claim::find($id);
        if (isset($request->insurance_policies)) {
            $claim->insurancePolicies()->sync($request->insurance_policies);
        }
        return $rs ? response()->json($rs) : response()->json(__("Error verify claim"), 400);
    }

    public function showReport(Request $request) {
        $pdf = new ReportRepository();
        $id = $request->id ?? null;
        
        $claim = Claim::with([
            "claimFormattable"
        ])->whereId($id)->first();

        $claim = Claim::with(["insurancePolicies", "claimFormattable"])->find($id);

        if (isset($claim)) {
            $insurancePolicies = [];

            foreach ($claim->insurancePolicies ?? [] as $insurancePolicy) {
                array_push($insurancePolicy, $insurancePolicies);
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

    /**
     * changeStatus
     *
     * @method changeStatus
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function changeStatus(ClaimChangeStatusRequest $request, int $id): JsonResponse
    {
        $rs = $this->claimRepository->changeStatus($request->validated(), $id);
        return $rs ? response()->json($rs) : response()->json(__("Error, change claim status"), 400);
    }

    /**
     * updateNoteCurrentStatus
     *
     * @method updateNoteCurrentStatus
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function updateNoteCurrentStatus(Request $request, int $id): JsonResponse
    {
        $rs = $this->claimRepository->updateNoteCurrentStatus($request, $id);
        return $rs ? response()->json($rs) : response()->json(__("Error, change claim status"), 400);
    }

    /**
     * addNoteCurrentStatus
     *
     * @method addNoteCurrentStatus
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function addNoteCurrentStatus(Request $request, int $id): JsonResponse
    {
        $rs = $this->claimRepository->addNoteCurrentStatus($request, $id);
        return $rs ? response()->json($rs) : response()->json(__("Error, change claim status"), 400);
    }
}

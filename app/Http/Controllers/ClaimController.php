<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Claim\GetFieldAction;
use App\Actions\Claim\GetFieldQualifierAction;
use App\Http\Requests\Claim\ClaimChangeStatusRequest;
use App\Http\Requests\Claim\ClaimCheckStatusRequest;
use App\Http\Requests\Claim\ClaimCreateRequest;
use App\Http\Requests\Claim\ClaimDraftRequest;
use App\Http\Requests\Claim\ClaimEligibilityRequest;
use App\Http\Requests\Claim\ClaimVerifyRequest;
use App\Http\Resources\Claim\PreviewResource;
use App\Models\Claim;
use App\Models\ClaimStatus;
use App\Repositories\ClaimRepository;
use App\Repositories\ProcedureRepository;
use App\Repositories\ReportRepository;
use App\Services\Claim\ClaimPreviewService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function __construct(
        private ClaimRepository $claimRepository,
        private ProcedureRepository $procedureRepository,
    ) {
    }

    /**
     * @param claimCreateRequest $request
     *
     * @return JsonResponse
     */
    public function saveAsDraft(ClaimDraftRequest $request)
    {
        $rs = $this->claimRepository->createClaim($request->validated());

        return $rs ? response()->json($rs) : response()->json(__('Error creating claim'), 400);
    }

    /**
     * @param claimCreateRequest $request
     *
     * @return JsonResponse
     */
    public function updateAsDraft(ClaimDraftRequest $request, $id)
    {
        $rs = $this->claimRepository->updateClaim($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error updating claim'), 400);
    }

    /**
     * @return JsonResponse
     */
    public function createClaim(ClaimCreateRequest $request)
    {
        $rs = $this->claimRepository->createClaim($request->validated());

        return $rs ? response()->json($rs) : response()->json(__('Error creating claim'), 400);
    }

    /**
     * @return JsonResponse
     */
    public function updateClaim(ClaimCreateRequest $request, $id)
    {
        $rs = $this->claimRepository->updateClaim($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error updating claim'), 400);
    }

    public function getAllClaims(Request $request)
    {
        $status = (is_array($request->status)) ? $request->status : json_decode($request->status);
        $subStatus = (is_array($request->subStatus)) ? $request->subStatus : json_decode($request->subStatus);

        return response()->json(
            $this->claimRepository->getAllClaims($status ?? [], $subStatus ?? [])
        );
    }

    public function getServerAll(Request $request)
    {
        return $this->claimRepository->getServerAll($request);
    }

    public function getOneClaim(int $id): JsonResponse
    {
        $rs = $this->claimRepository->getOneClaim($id);

        return $rs ? response()->json($rs) : response()->json(__('Error, claim not found'), 404);
    }

    public function getListClaimServices(Request $request)
    {
        $rs = $this->claimRepository->getListClaimServices($request);

        return response()->json($rs);
    }

    public function getListTypeOfServices()
    {
        $rs = $this->claimRepository->getListTypeOfServices();

        return $rs ? response()->json($rs) : response()->json(__('Error get all service type of service'), 400);
    }

    public function getListPlaceOfServices()
    {
        $rs = $this->claimRepository->getListPlaceOfServices();

        return $rs ? response()->json($rs) : response()->json(__('Error get all service place of service'), 400);
    }

    public function getListRevenueCodes(Request $request, int $company_id = null): JsonResponse
    {
        /**@todo Consultar clasificacion de procedures by revenue codes */
        $search = $request->search ?? '';

        return response()->json(
            $this->procedureRepository->getList($company_id, $search)
        );
    }

    public function getListAdmissionTypes(): JsonResponse
    {
        return response()->json(
            $this->claimRepository->getListAdmissionTypes()
        );
    }

    public function getListAdmissionSources(): JsonResponse
    {
        return response()->json(
            $this->claimRepository->getListAdmissionSources()
        );
    }

    public function getListBillClassifications(): JsonResponse
    {
        /** @todo Confirmar listado con monser */
        $rs = [
            [
                'id' => '1',
                'code' => '0',
                'name' => 'Non-payment/Zero Claim',
            ],
            [
                'id' => '2',
                'code' => '1',
                'name' => 'Admit Through Discharge',
            ],
            [
                'id' => '3',
                'code' => '2',
                'name' => 'Interim - First Claim',
            ],
            [
                'id' => '4',
                'code' => '3',
                'name' => 'Interim-Continuing Claims',
            ],
            [
                'id' => '5',
                'code' => '4',
                'name' => 'Interim - Last Claim',
            ],
            [
                'id' => '6',
                'code' => '5',
                'name' => 'Late Charge Only',
            ],
            [
                'id' => '7',
                'code' => '7',
                'name' => 'Replacement of Prior Claim (See adjustment third digit)',
            ],
            [
                'id' => '8',
                'code' => '8',
                'name' => 'Void/Cancel of Prior Claim (See adjustment third digit)',
            ],
            [
                'id' => '9',
                'code' => '9',
                'name' => 'Final claim for a Home Health PPS Period',
            ],
        ];

        return $rs ? response()->json($rs) : response()->json(__('Error get all bill classifications'), 400);
    }

    public function getListTypeFormats()
    {
        $rs = $this->claimRepository->getListTypeFormats();

        return $rs ? response()->json($rs) : response()->json(__('Error get all type formats'), 400);
    }

    public function getListClaimFieldInformations(Request $request, GetFieldAction $field): JsonResponse
    {
        $rs = $field->all($request->type);

        return response()->json($rs);
    }

    public function getListFieldQualifiers(Request $request, GetFieldQualifierAction $qualifier): JsonResponse
    {
        $rs = $qualifier->all($request->input());

        return response()->json($rs);
    }

    public function getListTypeDiags()
    {
        $rs = $this->claimRepository->getListTypeDiags();

        return $rs ? response()->json($rs) : response()->json(__('Error get all type diags'), 400);
    }

    public function getListStatus()
    {
        $rs = $this->claimRepository->getListStatus();

        return $rs ? response()->json($rs) : response()->json(__('Error get all status claim'), 400);
    }

    /**
     * Security Authorization Access Token.
     *
     * @method getSecurityAuthorizationAccessToken
     *
     * @param \Illuminate\Http\Request $request
     */
    public function getSecurityAuthorizationAccessToken(): JsonResponse
    {
        $rs = $this->claimRepository->getSecurityAuthorizationAccessToken();

        return $rs ? response()->json($rs) : response()->json(__('Error get security authorization access token'), 400);
    }

    /**
     * Eligibility.
     *
     * @method checkEligibility
     *
     * @param \Illuminate\Http\Request $request
     */
    public function checkEligibility(int $id): JsonResponse
    {
        $token = $this->claimRepository->getSecurityAuthorizationAccessToken();

        if (!isset($token)) {
            return response()->json(__('Error get security authorization access token'), 400);
        }

        $rs = $this->claimRepository->checkEligibility($token->access_token ?? '', $id);

        return $rs ? response()->json($rs) : response()->json(__('Error claim eligibility'), 400);
    }

    public function storeCheckEligibility(ClaimEligibilityRequest $request)
    {
        $token = $this->claimRepository->getSecurityAuthorizationAccessToken();

        if (!isset($token)) {
            return response()->json(__('Error get security authorization access token'), 400);
        }

        $rs = $this->claimRepository->storeCheckEligibility($token->access_token ?? '', $request->validated());

        return $rs ? response()->json($rs) : response()->json(__('Error claim eligibility'), 400);
    }

    /**
     * Validation.
     *
     * @method claimValidation
     *
     * @param \Illuminate\Http\Request $request
     */
    public function claimValidation(int $id): JsonResponse
    {
        $token = $this->claimRepository->getSecurityAuthorizationAccessToken();

        if (!isset($token)) {
            return response()->json(__('Error get security authorization access token'), 400);
        }

        $rs = $this->claimRepository->claimValidation($token->access_token ?? '', $id);

        return $rs ? response()->json($rs) : response()->json(__('Error claim validation'), 400);
    }

    /**
     * @param claimCreateRequest $request
     *
     * @return JsonResponse
     */
    public function saveAsDraftAndEligibility(ClaimDraftRequest $request)
    {
        if (isset($request->claim_id)) {
            $claim = Claim::find($request->claim_id);
        } else {
            $claim = $this->claimRepository->createClaim($request->validated());
            if (!isset($claim)) {
                return response()->json(__('Error save claim'), 400);
            }
        }

        return $this->checkEligibility($claim->id);
    }

    /**
     * @param claimCreateRequest $request
     *
     * @return JsonResponse
     */
    public function verifyAndRegister(ClaimVerifyRequest $request, int $id)
    {
        $claim = Claim::find($id);
        $statusVerify = ClaimStatus::whereStatus('Verified - Not submitted')->first();
        if (($request->validate ?? false) == true) {
            if (isset($request->insurance_policies)) {
                $claim->insurancePolicies()->sync($request->insurance_policies);
            }

            $rs = $this->claimValidation($claim->id);
            $this->claimRepository->changeStatus([
                'status_id' => $statusVerify->id,
                'private_note' => 'API verification',
            ], $claim->id);
        } else {
            if (isset($request->insurance_policies)) {
                $claim->insurancePolicies()->sync($request->insurance_policies);
            }

            $this->claimRepository->changeStatus([
                'status_id' => $statusVerify->id,
                'private_note' => 'Manual verification',
            ], $claim->id);
        }

        return $claim ? response()->json($claim) : response()->json(__('Error save claim'), 400);
    }

    public function storeVerifyAndRegister(ClaimVerifyRequest $request)
    {
        $claim = $this->claimRepository->createClaim($request->validated());
        $statusVerify = ClaimStatus::whereStatus('Verified - Not submitted')->first();
        if (($request->validate ?? false) == true) {
            if (isset($request->insurance_policies)) {
                $claim->insurancePolicies()->sync($request->insurance_policies);
            }

            $rs = $this->claimValidation($claim->id);
            $this->claimRepository->changeStatus([
                'status_id' => $statusVerify->id,
                'private_note' => 'API verification',
            ], $claim->id);
        } else {
            if (isset($request->insurance_policies)) {
                $claim->insurancePolicies()->sync($request->insurance_policies);
            }

            $this->claimRepository->changeStatus([
                'status_id' => $statusVerify->id,
                'private_note' => 'Manual verification',
            ], $claim->id);
        }

        return $claim ? response()->json($claim) : response()->json(__('Error save claim'), 400);
    }

    public function showPreview(Request $request, ClaimPreviewService $preview)
    {
        $id = $request->id ?? null;
        $claim = Claim::with(['claimFormattable', 'insurancePolicies', 'claimFormattable'])->find($id);
        $data = new PreviewResource($claim);
        $preview->setConfig([
            'urlVerify' => 'www.google.com.ve',
            'print' => $request->print ?? false,
            'typeFormat' => $claim->format ?? null,
            'data' => $data->toArray($request),
        ]);
        $preview->setHeader('');

        return explode("\n\r\n", $preview->setBody('pdf.837P', true, [
            'pdf' => $preview,
        ]))[1];
    }

    public function showReport(Request $request)
    {
        $pdf = new ReportRepository();
        $id = $request->id ?? null;

        $claim = Claim::with(['claimFormattable', 'insurancePolicies', 'claimFormattable'])->find($id);

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
        } else {
            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $request->billing_company_id;
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }
            $pdf->setConfig([
                'urlVerify' => 'www.google.com.ve',
                'print' => $request->print ?? false,
                'typeFormat' => ('' != $request->format) ? $request->format : null,
                'patient_id' => ('' != $request->patient_id) ? $request->patient_id : null,
                'claim_form_services' => $request->claim_services ?? [],
                'patient_or_insured_information' => $request->patient_or_insured_information ?? null,
                'physician_or_supplier_information' => $request->physician_or_supplier_information ?? null,
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
                'billing_provider_id' => $request->billing_provider_id ?? null,
                'service_provider_id' => $request->service_provider_id ?? null,
                'referred_id' => $request->referred_id ?? null,
                'company_id' => $request->company_id ?? null,
                'facility_id' => $request->facility_id ?? null,
                'insurance_policies' => $request->insurance_policies ?? [],
                'diagnoses' => $request->diagnoses ?? [],
            ]);
        }
        $pdf->setHeader('');

        return explode("\n\r\n", $pdf->setBody('pdf.837P', true, [
            'pdf' => $pdf,
        ]))[1];
    }

    /**
     * changeStatus.
     *
     * @method changeStatus
     *
     * @param \Illuminate\Http\Request $request
     */
    public function changeStatus(ClaimChangeStatusRequest $request, int $id): JsonResponse
    {
        $rs = $this->claimRepository->changeStatus($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error, change claim status'), 400);
    }

    /**
     * updateNoteCurrentStatus.
     *
     * @method updateNoteCurrentStatus
     */
    public function updateNoteCurrentStatus(Request $request, int $id): JsonResponse
    {
        $rs = $this->claimRepository->updateNoteCurrentStatus($request, $id);

        return $rs ? response()->json($rs) : response()->json(__('Error, change claim status'), 400);
    }

    /**
     * addNoteCurrentStatus.
     *
     * @method addNoteCurrentStatus
     */
    public function addNoteCurrentStatus(Request $request, int $id): JsonResponse
    {
        $rs = $this->claimRepository->addNoteCurrentStatus($request, $id);

        return $rs ? response()->json($rs) : response()->json(__('Error, change claim status'), 400);
    }

    /**
     * addCheckStatus.
     *
     * @method addCheckStatus
     *
     * @param \Illuminate\Http\Request $request
     */
    public function addCheckStatus(ClaimCheckStatusRequest $request, int $id): JsonResponse
    {
        $rs = $this->claimRepository->addCheckStatus($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error, check status claim'), 400);
    }

    public function getCheckStatus(int $id): JsonResponse
    {
        $token = $this->claimRepository->getSecurityAuthorizationAccessToken();

        if (!isset($token)) {
            return response()->json(__('Error get security authorization access token'), 400);
        }

        $rs = $this->claimRepository->getCheckStatus($token->access_token ?? '', $id);

        return $rs ? response()->json($rs) : response()->json(__('Error, get check status'), 400);
    }
}

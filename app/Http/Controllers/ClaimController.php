<?php

// declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Claim\ChangeStatusAction;
use App\Actions\Claim\CreateAction;
use App\Actions\Claim\CreateCheckEligibilityAction;
use App\Actions\Claim\CreateDenialTrackingAction;
use App\Actions\Claim\CreateNoteAction;
use App\Actions\Claim\GetBillClassificationAction;
use App\Actions\Claim\GetCheckStatusAction;
use App\Actions\Claim\GetClaimAction;
use App\Actions\Claim\GetConditionCodeAction;
use App\Actions\Claim\GetDiagnosisRelatedGroupAction;
use App\Actions\Claim\GetFieldAction;
use App\Actions\Claim\GetFieldQualifierAction;
use App\Actions\Claim\GetPatientStatusesAction;
use App\Actions\Claim\GetSecurityAuthorizationAction;
use App\Actions\Claim\UpdateClaimAction;
use App\Enums\Claim\CodeValueFields;
use App\Enums\DepartmentResponsibility;
use App\Http\Requests\Claim\ClaimChangeStatusRequest;
use App\Http\Requests\Claim\ClaimCreateRequest;
use App\Http\Requests\Claim\ClaimEligibilityRequest;
use App\Http\Requests\Claim\ClaimVerifyRequest;
use App\Http\Requests\Claim\CreateNoteRequest;
use App\Http\Requests\Claim\DenialTrackingRequest;
use App\Http\Requests\Claim\StoreRequest;
use App\Http\Requests\Claim\UpdateRequest;
use App\Http\Resources\Claim\Fields\CodeValueResource;
use App\Http\Resources\Enums\EnumResource;
use App\Http\Resources\Enums\TypeResource;
use App\Models\BillClassification;
use App\Models\Claims\Claim;
use App\Models\ClaimStatus;
use App\Models\Facility;
use App\Models\FacilityType;
use App\Repositories\ClaimRepository;
use App\Repositories\ProcedureRepository;
use Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{
    public function __construct(
        private ClaimRepository $claimRepository,
        private ProcedureRepository $procedureRepository,
    ) {
    }

    /**
     * @return JsonResponse
     */
    public function createClaim(StoreRequest $request, CreateAction $createClaim)
    {
        $rs = $createClaim->invoke($request->casted());

        return $rs ? response()->json($rs) : response()->json(__('Error creating claim'), 400);
    }

    /**
     * @return JsonResponse
     */
    public function updateClaim(UpdateRequest $request, UpdateClaimAction $update, Claim $claim)
    {
        return response()->json($update->invoke($claim, $request->casted()));
    }

    public function getAllClaims(Request $request)
    {
        $status = (is_array($request->status)) ? $request->status : json_decode($request->status);
        $subStatus = (is_array($request->subStatus)) ? $request->subStatus : json_decode($request->subStatus);

        return response()->json(
            $this->claimRepository->getAllClaims($status ?? [], $subStatus ?? [])
        );
    }

    public function getServerAll(
        Request $request,
        Claim $claim,
        GetClaimAction $getClaim
    ): JsonResponse {
        return response()->json($getClaim->all($claim, $request));
    }

    public function getOneClaim(
        Claim $claim,
        GetClaimAction $getClaim
    ): JsonResponse {
        return response()->json($getClaim->single($claim));
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

    public function getListPlaceOfServices(Request $request)
    {
        $rs = $this->claimRepository->getListPlaceOfServices($request);

        return response()->json($rs);
    }

    public function getListRevenueCodes(Request $request): JsonResponse
    {
        /**@todo Consultar clasificacion de procedures by revenue codes */
        $search = $request->search ?? '';
        $companyId = str_contains($request->company_id ?? '', '-')
            ? explode('-', $request->company_id ?? '')[0]
            : $request->company_id ?? null;

        return response()->json(
            $this->claimRepository->getListRev($companyId, $search)
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

    public function getBillClassifications(Request $request, string $facilityId): JsonResponse
    {
        return response()->json(
            Facility::query()
                ->where('id', $facilityId)
                ->whereHas('billingCompanies', function ($query) use($request) {
                    $query->where('billing_company_id', Gate::check('is-admin')
                        ? $request->billing_company_id ?? 0
                        : Auth::user()->billing_company_id
                    );
                })
                ->first()
                ?->facilityTypes
                ->reduce(function (array $response, FacilityType $facilityType) {
                    BillClassification::query()
                        ->whereIn('id', json_decode($facilityType->pivot->bill_classifications))
                        ->get()
                        ->each(function (BillClassification $billClassification) use (&$response, $facilityType){
                            $response[] = [
                                'id' => $facilityType->code.$billClassification->code,
                                'name' => $facilityType->code
                                    .$billClassification->code
                                    .' - '
                                    .$facilityType->type
                                    .' / '
                                    .$billClassification->name,
                            ];
                        });

                    return $response;
                }, []),
        );
    }

    public function getListBillClassifications(GetBillClassificationAction $classification): JsonResponse
    {
        $rs = $classification->all();

        return response()->json($rs);
    }

    public function getListPatientStatuses(GetPatientStatusesAction $patientStatuses): JsonResponse
    {
        $rs = $patientStatuses->all();

        return response()->json($rs);
    }

    public function getListConditionCodes(Request $request, GetConditionCodeAction $conditionCode): JsonResponse
    {
        $rs = $conditionCode->all($request->search ?? null);

        return response()->json($rs);
    }

    public function getListDiagnosisRelatedGroups(Request $request, GetDiagnosisRelatedGroupAction $drg): JsonResponse
    {
        $rs = $drg->all($request->input());

        return response()->json($rs);
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

    public function storeCheckEligibility(
        ClaimEligibilityRequest $request,
        GetSecurityAuthorizationAction $getAccessToken,
        CreateCheckEligibilityAction $createEligibility
    ) {
        $token = $getAccessToken->invoke();

        if (empty($token) && true === $request->demographic_information['automatic_eligibility']) {
            return response()->json(__('Error get security authorization access token'), 400);
        }

        $rs = $createEligibility->invoke($token ?? '', $request->validated());

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
    public function verifyAndRegister(ClaimVerifyRequest $request, int $id)
    {
        $claim = Claim::find($id);
        $statusVerify = ClaimStatus::whereStatus('Not submitted')->first();
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
        if (is_null($claim)) {
            return response()->json(__('Error save claim'), 400);
        }

        $statusVerify = ClaimStatus::whereStatus('Not submitted')->first();
        if (($request->validate ?? false) == true) {
            $rs = $this->claimValidation($claim->id);
            $this->claimRepository->changeStatus([
                'status_id' => $statusVerify->id,
                'private_note' => 'API verification',
            ], $claim->id);
        } else {
            $this->claimRepository->changeStatus([
                'status_id' => $statusVerify->id,
                'private_note' => 'Manual verification',
            ], $claim->id);
        }

        return $claim ? response()->json($claim) : response()->json(__('Error save claim'), 400);
    }

    /**
     * changeStatus.
     *
     * @method changeStatus
     *
     * @param \Illuminate\Http\Request $request
     */
    public function changeStatus(
        ClaimChangeStatusRequest $request,
        ChangeStatusAction $change,
        Claim $claim
    ): JsonResponse {
        $rs = $change->invoke($claim, $request->casted());

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
    public function addNoteCurrentStatus(
        CreateNoteRequest $request,
        CreateNoteAction $create,
        Claim $claim
    ): JsonResponse {
        $rs = $create->invoke($claim, $request->casted());

        return $rs ? response()->json($rs) : response()->json(__('Error, create note in status claim'), 400);
    }

    /**
     * addCheckStatus.
     *
     * @method addCheckStatus
     *
     * @param \Illuminate\Http\Request $request
     */
    public function addTrackingClaim(
        DenialTrackingRequest $request,
        CreateDenialTrackingAction $create,
        Claim $claim
    ): JsonResponse
    {
        $rs = $create->invoke($claim, $request->casted());

        return $rs ? response()->json($rs) : response()->json(__('Error, create tracking claim'), 400);
    }

    public function getCheckStatus(
        Claim $claim,
        GetSecurityAuthorizationAction $getAccessToken,
        GetCheckStatusAction $getCheckStatus,
    ) {
        $token = $getAccessToken->invoke();

        if (empty($token)) {
            return response()->json(__('Error get security authorization access token'), 400);
        }

        $rs = $getCheckStatus->single($token ?? '', $claim);

        return $rs ? response()->json($rs) : response()->json(__('Error, get check status'), 400);
    }

    public function getListCodeValues(): JsonResponse
    {
        return response()->json(
            new EnumResource(collect(CodeValueFields::cases()), CodeValueResource::class),
        );
    }

    public function getListDepartmentResponsibilities(): JsonResponse
    {
        return response()->json(
            new EnumResource(collect(DepartmentResponsibility::cases()), TypeResource::class),
        );
    }

    public function getListInsurancePolicies(Claim $claim): JsonResponse
    {
        return response()->json(
            $claim->insurancePolicies()?->get()?->map(fn ($item) => [
                'id' => $item->typeresponsibility->code . ' - ' . $item->policy_number,
                'name' => $item->typeresponsibility->code . ' - ' . $item->policy_number,
                'default' => ('P' == $item->typeresponsibility->code)
            ])
            ?->toArray() ?? [],
        );
    }
}

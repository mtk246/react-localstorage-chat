<?php

namespace App\Http\Controllers;

use App\Actions\Claim\ConfirmShippingAction;
use App\Actions\Claim\GetSecurityAuthorizationAction;
use App\Actions\Claim\SubmitToClearingHouseAction;
use App\Http\Requests\Claim\ClaimBatchRequest;
use App\Models\Claims\ClaimBatch;
use App\Repositories\ClaimBatchRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClaimBatchController extends Controller
{
    private $claimBatchRepository;

    public function __construct()
    {
        $this->claimBatchRepository = new ClaimBatchRepository();
    }

    /**
     * @return JsonResponse
     */
    public function createBatch(ClaimBatchRequest $request)
    {
        $rs = $this->claimBatchRepository->createBatch($request->validated());

        return $rs ? response()->json($rs) : response()->json(__('Error creating claim batch'), 400);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function updateBatch(ClaimBatchRequest $request, $id)
    {
        $rs = $this->claimBatchRepository->updateBatch($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error updating claim batch'), 400);
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
     * @return JsonResponse
     */
    public function getOneClaimBatch(int $id)
    {
        $rs = $this->claimBatchRepository->getOneBatch($id);

        return $rs ? response()->json($rs) : response()->json(__('Error, claim batch not found'), 404);
    }

    /**
     * @return JsonResponse
     */
    public function deleteBatch(int $id)
    {
        $rs = $this->claimBatchRepository->deleteBatch($id);

        return $rs ? response()->json($rs) : response()->json(__('Error erasing claim batch'), 400);
    }

    /**
     * @param int $id
     *
     * @return JsonResponse
     */
    public function submitToClearingHouse(
        ClaimBatch $batch,
        GetSecurityAuthorizationAction $getAccessToken,
        SubmitToClearingHouseAction $submitAction,
    ) {
        $token = $getAccessToken->invoke();

        if (empty($token)) {
            return response()->json(__('Error get security authorization access token'), 400);
        }

        $rs = $submitAction->invoke($token ?? '', $batch);

        return $rs ? response()->json($rs) : response()->json(__('Error submitting claim batch'), 400);
    }

    public function confirmShipping(
        ClaimBatch $batch,
        ConfirmShippingAction $confirmAction,
    ) {
        $rs = $confirmAction->invoke($batch);

        return $rs ? response()->json($rs) : response()->json(__('Error confirm shipping claim batch'), 400);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Claim\ClaimBatchRequest;
use App\Repositories\ClaimBatchRepository;
use App\Models\ClaimBatch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

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
}

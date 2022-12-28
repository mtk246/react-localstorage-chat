<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClaimSubStatus\ClaimSubStatusRequest;
use App\Http\Requests\ChangeStatusRequest;
use App\Repositories\ClaimSubStatusRepository;
use App\Models\ClaimSubStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ClaimSubStatusController extends Controller
{
    private $claimSubStatusRepository;

    public function __construct()
    {
        $this->claimSubStatusRepository = new ClaimSubStatusRepository();
    }

    /**
     * @param ClaimSubStatusRequest $request
     * @return JsonResponse
     */
    public function createClaimSubStatus(ClaimSubStatusRequest $request): JsonResponse
    {
        $rs = $this->claimSubStatusRepository->createClaimSubStatus($request->validated());

        return $rs ? response()->json($rs,201) : response()->json(__("Error creating claim sub-status"), 400);
    }

    /**
     *
     * @param Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function getServerAll(Request $request): JsonResponse
    {
        return $this->claimSubStatusRepository->getServerAll($request);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneClaimSubStatus(int $id): JsonResponse
    {
        $rs = $this->claimSubStatusRepository->getOneClaimSubStatus($id);

        return $rs ? response()->json($rs) : response()->json(__("Error, claim sub-status not found"), 404);
    }

    /**
     * @param ClaimSubStatusRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateClaimSubStatus(ClaimSubStatusRequest $request,int $id): JsonResponse
    {
        $rs = $this->claimSubStatusRepository->updateClaimSubStatus($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__("Error updating claim sub-status"), 400);
    }

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function getByName(string $name): JsonResponse
    {
        $rs = $this->claimSubStatusRepository->getByName($name);

        return $rs ? response()->json($rs) : response()->json(__("Error, claim sub-status not found"), 404);
    }

    /**
     * @param ChangeStatusRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusRequest $request, int $id): JsonResponse
    {
        $rs = $this->claimSubStatusRepository->changeStatus($request->input("status"), $id);

        return $rs ? response()->json([], 204) : response()->json(__("Error updating status"), 400);
    }

    public function getList()
    {
        $rs = $this->claimSubStatusRepository->getList();

        return $rs ? response()->json($rs) : response()->json(__("Error get list all claim substatus"), 400);
    }

    public function getListStatus()
    {
        $rs = $this->claimSubStatusRepository->getListStatus();

        return $rs ? response()->json($rs) : response()->json(__("Error get list all base status"), 400);
    }
}

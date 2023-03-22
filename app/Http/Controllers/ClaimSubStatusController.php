<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClaimSubStatus\ClaimSubStatusCreateRequest;
use App\Http\Requests\ClaimSubStatus\ClaimSubStatusUpdateRequest;
use App\Http\Requests\ChangeStatusRequest;
use App\Models\Claim;
use App\Repositories\ClaimSubStatusRepository;
use App\Models\ClaimSubStatus;
use App\Models\ClaimStatus;
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
    public function createClaimSubStatus(ClaimSubStatusCreateRequest $request): JsonResponse
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
    public function updateClaimSubStatus(ClaimSubStatusUpdateRequest $request,int $id): JsonResponse
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

    public function getList(Request $request)
    {
        $status_id = ((is_array($request->status_id)) ? $request->status_id : json_decode($request->status_id)) ?? [];
        $status_name = $request->status ?? null;
        $billing_company_id = $request->billing_company_id ?? null;
        if (is_array($status_id)) {
            $records = [];
            foreach($status_id as $id) {
                $status = ClaimStatus::find($id);
                if ($status) {
                    $statusRecords = getList(ClaimSubStatus::class, 'name', ['relationship' => 'claimStatuses', 'where' => ['claim_status_id' => $id]]);
                    if (count($statusRecords) > 0) {
                        array_push($records, ['header' => $status->status]);
                    }
                    foreach ($statusRecords as $value) {
                        $value['group'] = $status->status;
                        array_push($records, $value);
                    }
                }
            }
            return response()->json($records ?? []);
        } else {
            $status = ClaimStatus::where('id', $status_id)
                ->orWhereRaw('LOWER(status) LIKE (?)', [strtolower("$status_name")])
                ->first();
            $current_id = $request->current_id ?? null;
            return response()->json(
                $this->claimSubStatusRepository->getList($status->id ?? null, $billing_company_id, $current_id)
            );
        }
    }

    public function getListByBilling(int $status_id, $id = null)
    {
        return response()->json(
            $this->claimSubStatusRepository->getList($status_id, $id)
        );
    }

    public function getListStatus(Request $request)
    {
        return response()->json(
            $this->claimSubStatusRepository->getListStatus($request->input())
        );
    }
}

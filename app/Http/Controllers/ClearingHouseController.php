<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeStatusClearingHouseRequest;
use App\Http\Requests\ClearinCreateRequest;
use App\Http\Requests\UpdateClearingHouse;
use App\Repositories\ClearingHouseRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClearingHouseController extends Controller
{
    private $clearingRepository;

    public function __construct()
    {
        $this->clearingRepository = new ClearingHouseRepository();
    }

    /**
     * @param ClearinCreateRequest $request
     * @return JsonResponse
     */
    public function createClearingHouse(ClearinCreateRequest $request): JsonResponse
    {
        $rs = $this->clearingRepository->create($request->validated());

        return $rs ? response()->json($rs,201) : response()->json(__("Error creating clearing house"), 400);
    }

    /**
     * @return JsonResponse
     */
    public function getAllClearingHouse(): JsonResponse
    {
        return response()->json(
            $this->clearingRepository->getAllClearingHouse()
        );
    }

    /**
     *
     * @param Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function getServerAll(Request $request): JsonResponse
    {
        return $this->clearingRepository->getServerAllClearingHouse($request);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneClearingHouse(int $id): JsonResponse
    {
        $rs = $this->clearingRepository->getOneClearingHouse($id);

        return is_null($rs) ? response()->json(__("Error, clearing house not found"), 404) : response()->json($rs);
    }

    /**
     * @param UpdateClearingHouse $request
     * @param int $clearing_id
     * @return JsonResponse
     */
    public function updateClearingHouse(UpdateClearingHouse $request,int $clearing_id): JsonResponse
    {
        $rs = $this->clearingRepository->updateClearingHouse($request->validated(),$clearing_id);

        return $rs ? response()->json($rs) : response()->json(__("Error updating clearing house"), 400);
    }

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function getByName(string $name): JsonResponse
    {
        $rs = $this->clearingRepository->getByName($name);

        return $rs ? response()->json($rs) : response()->json(__("Error, clearing house not found"), 404);
    }

    /**
     * @param ChangeStatusClearingHouseRequest $request
     * @param int $clearing_id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusClearingHouseRequest $request,int $clearing_id): JsonResponse
    {
        $rs = $this->clearingRepository->changeStatus($request->input("status"),$clearing_id);

        return $rs ? response()->json([], 204) : response()->json(__("Error updating status"), 400);
    }

    /**
     * @param  int $id
     * @return JsonResponse
     */
    public function addToBillingCompany(int $id): JsonResponse
    {
        $rs = $this->clearingRepository->addToBillingCompany($id);

        return $rs ? response()->json($rs) : response()->json(__("Error add clearing house to billing company"), 404);
    }
}

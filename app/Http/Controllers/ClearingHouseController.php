<?php

namespace App\Http\Controllers;

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

    public function createClearingHouse(ClearinCreateRequest $request): JsonResponse
    {
        $rs = $this->clearingRepository->create($request->validated());

        return $rs ? response()->json($rs, 201) : response()->json(__('Error creating clearing house'), 400);
    }

    public function getAllClearingHouse(): JsonResponse
    {
        return response()->json(
            $this->clearingRepository->getAllClearingHouse()
        );
    }

    public function getServerAll(Request $request): JsonResponse
    {
        return $this->clearingRepository->getServerAllClearingHouse($request);
    }

    public function getOneClearingHouse(int $id): JsonResponse
    {
        $rs = $this->clearingRepository->getOneClearingHouse($id);

        return is_null($rs) ? response()->json(__('Error, clearing house not found'), 404) : response()->json($rs);
    }

    public function updateClearingHouse(UpdateClearingHouse $request, int $clearing_id): JsonResponse
    {
        $rs = $this->clearingRepository->updateClearingHouse($request->validated(), $clearing_id);

        return $rs ? response()->json($rs) : response()->json(__('Error updating clearing house'), 400);
    }

    public function getByName(string $name): JsonResponse
    {
        $rs = $this->clearingRepository->getByName($name);

        return $rs ? response()->json($rs) : response()->json(__('Error, clearing house not found'), 404);
    }

    public function changeStatus(ChangeStatusClearingHouseRequest $request, int $clearing_id): JsonResponse
    {
        $rs = $this->clearingRepository->changeStatus($request->input('status'), $clearing_id);

        return $rs ? response()->json([], 204) : response()->json(__('Error updating status'), 400);
    }

    public function addToBillingCompany(int $id): JsonResponse
    {
        $rs = $this->clearingRepository->addToBillingCompany($id);

        return $rs ? response()->json($rs) : response()->json(__('Error add clearing house to billing company'), 404);
    }

    public function getListTransmissionFormats(): JsonResponse
    {
        return response()->json(
            $this->clearingRepository->getListTransmissionFormats()
        );
    }

    public function getListOrgTypes(): JsonResponse
    {
        return response()->json(
            $this->clearingRepository->getListOrgTypes()
        );
    }
}

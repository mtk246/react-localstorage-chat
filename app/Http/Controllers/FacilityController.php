<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusFacilityRequest;
use App\Http\Requests\FacilityCreateRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Repositories\FacilityRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    private $facilityRepository;

    public function __construct()
    {
        $this->facilityRepository = new FacilityRepository();
    }

    public function create(FacilityCreateRequest $request): JsonResponse
    {
        $rs = $this->facilityRepository->create($request->validated());

        return $rs ? response()->json($rs) : response()->json(__('Error creating facility'), 400);
    }

    public function getListFacilityTypes(): JsonResponse
    {
        return response()->json(
            $this->facilityRepository->getListFacilityTypes()
        );
    }

    public function getList(Request $request): JsonResponse
    {
        return response()->json(
            $this->facilityRepository->getList($request)
        );
    }

    public function getAllFacilities(): JsonResponse
    {
        return response()->json(
            $this->facilityRepository->getAllFacilities()
        );
    }

    /**
     * @param Illuminate\Http\Request $request
     */
    public function getServerAll(Request $request): JsonResponse
    {
        return $this->facilityRepository->getServerAllFacilities($request);
    }

    public function getAllByCompany($company_id): JsonResponse
    {
        return response()->json(
            $this->facilityRepository->getAllByCompany($company_id)
        );
    }

    public function getOneFacility(int $id): JsonResponse
    {
        $rs = $this->facilityRepository->getOneFacility($id);

        return $rs ? response()->json($rs) : response()->json(__('Error, facility not found'), 404);
    }

    public function updateFacility(UpdateFacilityRequest $request, int $id): JsonResponse
    {
        $rs = $this->facilityRepository->updateFacility($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error updating facility'), 400);
    }

    public function getByName(string $name): JsonResponse
    {
        $rs = $this->facilityRepository->getByName($name);

        return $rs ? response()->json($rs) : response()->json(__('Error, facility not found'), 404);
    }

    public function getOneByNpi(string $npi): JsonResponse
    {
        $rs = $this->facilityRepository->getOneByNpi($npi);

        return $rs ? response()->json($rs) : response()->json(__('Error, facility not found'), 404);
    }

    public function getListBillingCompanies(Request $request)
    {
        $rs = $this->facilityRepository->getListBillingCompanies($request);

        return !is_null($rs) ? response()->json($rs) : response()->json([], 404);
    }

    public function changeStatus(ChangeStatusFacilityRequest $request, int $id): JsonResponse
    {
        $rs = $this->facilityRepository->changeStatus($request->input('status'), $id);

        return $rs ? response()->json([], 204) : response()->json(__('Error updating status'), 404);
    }

    public function addToBillingCompany(int $id): JsonResponse
    {
        $rs = $this->facilityRepository->addToBillingCompany($id);

        return $rs ? response()->json($rs) : response()->json(__('Error add facility to billing company'), 404);
    }

    /**
     * @param int $id
     */
    public function addToCompany(int $facilityId, int $companyId): JsonResponse
    {
        $rs = $this->facilityRepository->addToCompany($facilityId, $companyId);

        return $rs ? response()->json($rs) : response()->json(__('Error add facility to company'), 404);
    }

    /**
     * @param int $id
     */
    public function removeToCompany(int $facilityId, int $companyId): JsonResponse
    {
        $rs = $this->facilityRepository->removeToCompany($facilityId, $companyId);

        return $rs ? response()->json($rs) : response()->json(__('Error remove facility to company'), 404);
    }
}

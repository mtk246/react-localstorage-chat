<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusFacilityRequest;
use App\Http\Requests\FacilityCreateRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Repositories\FacilityRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class FacilityController extends Controller
{
    private $facilityRepository;

    public function __construct()
    {
        $this->facilityRepository = new FacilityRepository();
    }

    /**
     * @param FacilityCreateRequest $request
     * @return JsonResponse
     */
    public function create(FacilityCreateRequest $request): JsonResponse
    {
        $rs = $this->facilityRepository->create($request->validated());

        return $rs ? response()->json($rs) : response()->json(__("Error creating facility"), 400);
    }

    /**
     * @return JsonResponse
     */
    public function getListFacilityTypes(): JsonResponse
    {
        return response()->json(
            $this->facilityRepository->getListFacilityTypes()
        );
    }

    /**
     * @return JsonResponse
     */
    public function getList(Request $request): JsonResponse
    {
        return response()->json(
            $this->facilityRepository->getList($request)
        );
    }

    /**
     * @return JsonResponse
     */
    public function getAllFacilities(): JsonResponse
    {
        return response()->json(
            $this->facilityRepository->getAllFacilities()
        );
    }

    /**
     *
     * @param Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function getServerAll(Request $request): JsonResponse
    {
        return $this->facilityRepository->getServerAllFacilities($request);
    }

    /**
     * @return JsonResponse
     */
    public function getAllByCompany($company_id): JsonResponse
    {
        return response()->json(
            $this->facilityRepository->getAllByCompany($company_id)
        );
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneFacility(int $id): JsonResponse
    {
        $rs = $this->facilityRepository->getOneFacility($id);

        return $rs ? response()->json($rs) : response()->json(__("Error, facility not found"), 404);
    }

    /**
     * @param UpdateFacilityRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateFacility(UpdateFacilityRequest $request,int $id): JsonResponse
    {
        $rs = $this->facilityRepository->updateFacility($request->validated(),$id);

        return $rs ? response()->json($rs) : response()->json(__("Error updating facility"), 400);
    }

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function getByName(string $name): JsonResponse
    {
        $rs = $this->facilityRepository->getByName($name);

        return $rs ? response()->json($rs) : response()->json(__("Error, facility not found"), 404);
    }

    /**
     * @param string $npi
     * @return JsonResponse
     */
    public function getOneByNpi(string $npi): JsonResponse
    {
        $rs = $this->facilityRepository->getOneByNpi($npi);

        return $rs ? response()->json($rs) : response()->json(__("Error, facility not found"), 404);
    }

    public function getListBillingCompanies(Request $request) {
        $rs = $this->facilityRepository->getListBillingCompanies($request);

        return !is_null($rs) ? response()->json($rs) : response()->json([], 404);
    }

    /**
     * @param ChangeStatusFacilityRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusFacilityRequest $request,int $id): JsonResponse
    {
        $rs = $this->facilityRepository->changeStatus($request->input("status"),$id);

        return $rs ? response()->json([],204) : response()->json(__("Error updating status"), 404);
    }

    /**
     * @param  int $id
     * @return JsonResponse
     */
    public function addToBillingCompany(int $id): JsonResponse
    {
        $rs = $this->facilityRepository->addToBillingCompany($id);

        return $rs ? response()->json($rs) : response()->json(__("Error add facility to billing company"), 404);
    }

    /**
     * @param  int $id
     * @return JsonResponse
     */
    public function addToCompany(int $facilityId, int $companyId): JsonResponse
    {
        $rs = $this->facilityRepository->addToCompany($facilityId, $companyId);

        return $rs ? response()->json($rs) : response()->json(__("Error add facility to company"), 404);
    }

    /**
     * @param  int $id
     * @return JsonResponse
     */
    public function removeToCompany(int $facilityId, int $companyId): JsonResponse
    {
        $rs = $this->facilityRepository->removeToCompany($facilityId, $companyId);

        return $rs ? response()->json($rs) : response()->json(__("Error remove facility to company"), 404);
    }
}

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

        return $rs ? response()->json($rs) : response()->json("Error creating facility",400);
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
     * @param int $id
     * @return JsonResponse
     */
    public function getOneFacility(int $id): JsonResponse
    {
        $rs = $this->facilityRepository->getOneFacility($id);

        return $rs ? response()->json($rs) : response()->json("facility not found",404);
    }

    /**
     * @param UpdateFacilityRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateFacility(UpdateFacilityRequest $request,int $id): JsonResponse
    {
        $rs = $this->facilityRepository->updateCompany($request->validated(),$id);

        return $rs ? response()->json($rs) : response()->json("Error updating facility",400);
    }

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function getByName(string $name): JsonResponse
    {
        $rs = $this->facilityRepository->getByName($name);

        return $rs ? response()->json($rs) : response()->json("facility not found",404);
    }

    /**
     * @param ChangeStatusFacilityRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusFacilityRequest $request,int $id): JsonResponse
    {
        $rs = $this->facilityRepository->changeStatus($request->input("status"),$id);

        return $rs ? response()->json([],204) : response()->json("Error, facility not found",404);
    }

    /**
     * @param  int $id
     * @return JsonResponse
     */
    public function addToBillingCompany(int $id): JsonResponse
    {
        $rs = $this->facilityRepository->addToBillingCompany($id);

        return $rs ? response()->json($rs) : response()->json("error add facility to billing company", 404);
    }
}

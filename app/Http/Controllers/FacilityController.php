<?php

namespace App\Http\Controllers;

use App\Http\Requests\FacilityCreateRequest;
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
}

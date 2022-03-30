<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\IpRestrictionRepository;
use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\IpRestrictionRequest;

class IpRestrictionController extends Controller
{
    private $ipRestrictionRepository;

    public function __construct()
    {
        $this->ipRestrictionRepository = new IpRestrictionRepository();
    }

    /**
     * @param IpRestrictionRequest $request
     * @return JsonResponse
     */
    public function store(IpRestrictionRequest $request)
    {
        $rs = $this->ipRestrictionRepository->create($request->validated(), $id);
        return $rs ? response()->json($rs) : response()->json("Error creating restriction", 400);

    }

    /**
     * @param IpRestrictionRequest $request
     * @param  $id
     * @return JsonResponse
     */
    public function update(IpRestrictionRequest $request, $id)
    {
        $rs = $this->ipRestrictionRepository->update($request->validated(), $id);
        return $rs ? response()->json($rs) : response()->json("Error updating restriction", 400);
    }

    /**
     * @return JsonResponse
     */
    public function getAllRestrictions()
    {
        return response()->json($this->ipRestrictionRepository->getAllRestrictions());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneRestriction(int $id)
    {
        $rs = $this->ipRestrictionRepository->getOneRestriction($id);
        return $rs ? response()->json($rs) : response()->json("Restriction not found", 404);
    }

    /**
     * @param DoctorChangeStatusRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusRequest $request,int $id): JsonResponse
    {
        $rs = $this->doctorRepository->changeStatus($request->input("status"),$id);

        return $rs ? response()->json([],204) : response()->json("Error! Health professional not found", 404);
    }
}

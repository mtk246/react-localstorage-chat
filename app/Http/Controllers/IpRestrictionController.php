<?php

namespace App\Http\Controllers;

use App\Http\Requests\IpRestrictionRequest;
use App\Repositories\IpRestrictionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IpRestrictionController extends Controller
{
    private $ipRestrictionRepository;

    public function __construct()
    {
        $this->ipRestrictionRepository = new IpRestrictionRepository();
    }

    /**
     * @return JsonResponse
     */
    public function store(IpRestrictionRequest $request)
    {
        $rs = $this->ipRestrictionRepository->create($request->validated());

        return $rs ? response()->json($rs) : response()->json(__('Error creating restriction'), 400);
    }

    /**
     * @return JsonResponse
     */
    public function update(IpRestrictionRequest $request, $id)
    {
        $rs = $this->ipRestrictionRepository->update($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error updating restriction'), 400);
    }

    /**
     * @return JsonResponse
     */
    public function getAllRestrictions()
    {
        return response()->json($this->ipRestrictionRepository->getAllRestrictions());
    }

    public function getServerAll(Request $request): JsonResponse
    {
        return $this->ipRestrictionRepository->getServerAllRestrictions($request);
    }

    /**
     * @return JsonResponse
     */
    public function getOneRestriction(int $id)
    {
        $rs = $this->ipRestrictionRepository->getOneRestriction($id);

        return $rs ? response()->json($rs) : response()->json(__('Error, restriction not found'), 404);
    }

    /**
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $rs = $this->ipRestrictionRepository->destroy($id);

        return $rs ? response()->json([], 204) : response()->json(__('Error, restriction not found'), 404);
    }
}

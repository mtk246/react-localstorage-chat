<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClearinCreateRequest;
use App\Repositories\ClearingHouseRepository;
use Illuminate\Http\JsonResponse;
#use Illuminate\Http\Request;

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

        return $rs ? response()->json($rs,201) : response()->json("error creating clearing house",400);
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
     * @param int $id
     * @return JsonResponse
     */
    public function getOneClearingHouse(int $id): JsonResponse
    {
        $rs = $this->clearingRepository->getOneClearingHouse($id);

        return is_null($rs) ? response()->json("clearing house not found",404) : response()->json($rs);
    }
}

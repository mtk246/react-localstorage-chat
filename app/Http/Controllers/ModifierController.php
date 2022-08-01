<?php

namespace App\Http\Controllers;

use App\Http\Requests\Modifier\ModifierCreateRequest;
use App\Http\Requests\Modifier\ModifierUpdateRequest;
use App\Http\Requests\ChangeStatusRequest;
use App\Repositories\ModifierRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModifierController extends Controller
{
    private $modifierRepository;

    public function __construct()
    {
        $this->modifierRepository = new ModifierRepository();
    }
    
    /**
     * @param ModifierCreateRequest $request
     * @return JsonResponse
     */
    public function createModifier(ModifierCreateRequest $request): JsonResponse
    {
        $rs = $this->modifierRepository->createModifier($request->validated());

        return $rs ? response()->json($rs,201) : response()->json(__("Error creating modifier"), 400);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneModifier(int $id): JsonResponse
    {
        $rs = $this->modifierRepository->getOneModifier($id);

        return $rs ? response()->json($rs) : response()->json(__("Error, modifier not found"), 404);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getByCode(string $code): JsonResponse
    {
        $rs = $this->modifierRepository->getByCode($code);

        return $rs ? response()->json($rs) : response()->json(__("Error, modifier not found"), 404);
    }

    /**
     * @return JsonResponse
     */
    public function getAllModifiers(): JsonResponse
    {
        return response()->json(
            $this->modifierRepository->getAllModifiers()
        );
    }

    /**
     * @param ModifierUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateModifier(ModifierUpdateRequest $request, int $id): JsonResponse
    {
        $rs = $this->modifierRepository->updateModifier($request->validated(),$id);

        return $rs ? response()->json($rs) : response()->json(__("Error updating modifier"), 400);
    }

    /**
     * @param ChangeStatusRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusRequest $request, int $id): JsonResponse
    {
        $rs = $this->modifierRepository->changeStatus($request->input("status"), $id);

        return $rs ? response()->json([],204) : response()->json(__("Error updating status"), 400);
    }

    /**
     * @return JsonResponse
     */
    public function getList(): JsonResponse
    {
        return response()->json(
            $this->modifierRepository->getListModifiers()
        );
    }
}

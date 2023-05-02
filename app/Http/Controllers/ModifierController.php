<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\Modifier\ModifierCreateRequest;
use App\Http\Requests\Modifier\ModifierUpdateRequest;
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

    public function createModifier(ModifierCreateRequest $request): JsonResponse
    {
        $rs = $this->modifierRepository->createModifier($request->validated());

        return $rs ? response()->json($rs, 201) : response()->json(__('Error creating modifier'), 400);
    }

    public function getOneModifier(int $id): JsonResponse
    {
        $rs = $this->modifierRepository->getOneModifier($id);

        return $rs ? response()->json($rs) : response()->json(__('Error, modifier not found'), 404);
    }

    /**
     * @param int $id
     */
    public function getByCode(string $code): JsonResponse
    {
        $rs = $this->modifierRepository->getByCode($code);

        return $rs ? response()->json($rs) : response()->json(__('Error, modifier not found'), 404);
    }

    public function getAllModifiers(): JsonResponse
    {
        return response()->json(
            $this->modifierRepository->getAllModifiers()
        );
    }

    /**
     * @param Illuminate\Http\Request $request
     */
    public function getServerAll(Request $request): JsonResponse
    {
        return $this->modifierRepository->getServerAllModifiers($request);
    }

    public function updateModifier(ModifierUpdateRequest $request, int $id): JsonResponse
    {
        $rs = $this->modifierRepository->updateModifier($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error updating modifier'), 400);
    }

    public function changeStatus(ChangeStatusRequest $request, int $id): JsonResponse
    {
        $rs = $this->modifierRepository->changeStatus($request->input('status'), $id);

        return $rs ? response()->json([], 204) : response()->json(__('Error updating status'), 400);
    }

    public function getList(): JsonResponse
    {
        return response()->json(
            $this->modifierRepository->getListModifiers()
        );
    }
}

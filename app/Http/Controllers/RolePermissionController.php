<?php

namespace App\Http\Controllers;

use App\Repositories\RolePermissionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Response;

class RolePermissionController extends Controller
{
    private $RolePermissionRepository;

    public function __construct()
    {
        $this->RolePermissionRepository = new RolePermissionRepository();
    }

    /**
     * @return JsonResponse
     */
    public function getRoles(): JsonResponse
    {
        return response()->json($this->RolePermissionRepository->getAllRoles());
    }

    /**
     * @return JsonResponse
     */
    public function getPermissions(): JsonResponse
    {
        return response()->json($this->RolePermissionRepository->getAllPermission());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneRole(int $id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->getOneRole($id);

        return $rs ? response()->json($rs) : response()->json("role not found",404);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOnePermission(int $id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->getOnePermission($id);

        return $rs ? response()->json($rs) : response()->json("permission not found",404);
    }
}

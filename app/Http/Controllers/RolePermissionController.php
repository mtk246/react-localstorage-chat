<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\CreateRoleRequest;
use App\Repositories\RolePermissionRepository;
use Illuminate\Http\JsonResponse;
//use Illuminate\Http\Request;

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

    /**
     * @param CreateRoleRequest $request
     * @return JsonResponse
     */
    public function createRole(CreateRoleRequest $request): JsonResponse
    {
        $data = $request->validated();

        $rs = $this->RolePermissionRepository->createRole($data['name']);

        return $rs ? response()->json($rs,201) : response()->json("Error creating role",400);
    }

    /**
     * @param CreatePermissionRequest $request
     * @return JsonResponse
     */
    public function createPermission(CreatePermissionRequest $request): JsonResponse
    {
        $data = $request->validated();

        $rs = $this->RolePermissionRepository->createPermission($data['name']);

        return $rs ? response()->json($rs,201) : response()->json("Error creating permission",400);
    }

    /**
     * @param int $role_id
     * @param int $permission_id
     * @return JsonResponse
     */
    public function assignPermissionsRole(int $role_id,int $permission_id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->assignPermissionRole($role_id,$permission_id);

        return $rs ? response()->json($rs) : response()->json("error assign permissions to role (role or permission not found)",400);
    }

    /**
     * @param int $user_id
     * @param int $role_id
     * @return JsonResponse
     */
    public function assignRoleUser(int $user_id,int $role_id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->assignRoleUser($role_id,$user_id);

        return $rs ? response()->json($rs) : response()->json("error assign role to user (user or role not found)",400);
    }

    /**
     * @param int $user_id
     * @param int $permission_id
     * @return JsonResponse
     */
    public function assignPermissionUser(int $user_id,int $permission_id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->assignPermissionUser($permission_id,$user_id);

        return $rs ? response()->json($rs) : response()->json("error assign permission to user (user or permission not found)",400);
    }
}

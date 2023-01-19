<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\CreateRoleRequest;
use App\Repositories\RolePermissionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    public function getRolesWithPermissions(): JsonResponse
    {
        return response()->json($this->RolePermissionRepository->getAllRolesWithPermissions());
    }

    /**
     * @return JsonResponse
     */
    public function getPermissions(Request $request): JsonResponse
    {
        return response()->json($this->RolePermissionRepository->getAllPermission($request));
    }

    /**
     * @return JsonResponse
     */
    public function getPermissionsByRole(string $role): JsonResponse
    {
        $rs = $this->RolePermissionRepository->getAllPermissionsByRole($role);

        return $rs ? response()->json($rs) : response()->json(__("Error, role not found"), 404);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneRole(int $id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->getOneRole($id);

        return $rs ? response()->json($rs) : response()->json(__("Error, role not found"), 404);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOnePermission(int $id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->getOnePermission($id);

        return !is_null($rs) ? response()->json($rs) : response()->json(__("Error, permission not found"), 404);
    }

    /**
     * @param CreateRoleRequest $request
     * @return JsonResponse
     */
    public function createRole(CreateRoleRequest $request): JsonResponse
    {
        $rs = $this->RolePermissionRepository->createRole($request->validated());

        return $rs ? response()->json($rs,201) : response()->json(__("Error creating role"), 400);
    }

    /**
     * @param CreatePermissionRequest $request
     * @return JsonResponse
     */
    public function createPermission(CreatePermissionRequest $request): JsonResponse
    {
        $rs = $this->RolePermissionRepository->createPermission($request->validated());

        return $rs ? response()->json($rs,201) : response()->json(__("Error creating permission"), 400);
    }

    /**
     * @param int $role_id
     * @param int $permission_id
     * @return JsonResponse
     */
    public function assignPermissionRole(int $role_id, int $permission_id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->assignPermissionRole($role_id,$permission_id);

        return $rs ? response()->json($rs) : response()->json(__("Error assign permissions to role (role or permission not found)"), 404);
    }

    /**
     * @param int $role_id
     * @param int $permission_id
     * @return JsonResponse
     */
    public function assignPermissionsRole(Request $request, int $role_id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->assignPermissionsRole($request, $role_id);

        return $rs ? response()->json($rs) : response()->json(__("Error assign permissions to role (role or permission not found)"), 404);
    }

    /**
     * @param int $user_id
     * @param int $role_id
     * @return JsonResponse
     */
    public function assignRoleUser(int $user_id,int $role_id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->assignRoleUser($role_id,$user_id);

        return $rs ? response()->json($rs) : response()->json(__("Error assign role to user (user or role not found)"), 404);
    }

    /**
     * @param int $user_id
     * @param int $permission_id
     * @return JsonResponse
     */
    public function assignPermissionUser(int $user_id,int $permission_id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->assignPermissionUser($permission_id,$user_id);

        return $rs ? response()->json($rs) : response()->json(__("Error assign permission to user (user or permission not found)"), 404);
    }

    /**
     * @param int $user_id
     * @param int $permission_id
     * @return JsonResponse
     */
    public function assignPermissionsUser(Request $request, int $user_id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->assignPermissionsUser($request, $user_id);

        return $rs ? response()->json($rs) : response()->json(__("Error assign permission to user (user or permission not found)"), 404);
    }

    /**
     * @param int $user_id
     * @param int $role_id
     * @return JsonResponse
     */
    public function revokeRoleUser(int $user_id,int $role_id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->revokeRoleUser($role_id,$user_id);

        return $rs ? response()->json($rs) : response()->json(__("Error revoking role user (role or user not found)"), 404);
    }

    /**
     * @param int $role_id
     * @param int $permission_id
     * @return JsonResponse
     */
    public function revokePermissionRole(int $role_id,int $permission_id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->revokePermissionRole($role_id,$permission_id);

        return $rs ? response()->json($rs) : response()->json(__("Error revoking permission role (role or permision not found)"), 404);
    }

    public function revokePermissionsRole(Request $request, int $role_id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->revokePermissionsRole($request, $role_id);

        return $rs ? response()->json($rs) : response()->json(__("Error revoking permission role (role or permision not found)"), 404);
    }

    /**
     * @param int $user_id
     * @param int $permission_id
     * @return JsonResponse
     */
    public function revokePermissionUser(int $user_id,int $permission_id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->revokePermissionUser($user_id,$permission_id);

        return $rs ? response()->json($rs) : response()->json(__("Error revoking permission user (user or permission not found)"), 404);
    }

    public function revokePermissionsUser(Request $request, int $user_id): JsonResponse
    {
        $rs = $this->RolePermissionRepository->revokePermissionsUser($request, $user_id);

        return $rs ? response()->json($rs) : response()->json(__("Error revoking permission user (user or permission not found)"), 404);
    }
}

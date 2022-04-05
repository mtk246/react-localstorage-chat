<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionRepository
{
    /**
     * @return Collection|Role[]
     */
    public function getAllRoles(){
        return Role::all();
    }

    /**
     * @return Collection|Permission[]
     */
    public function getAllPermission(){
        return Permission::with('roles')->get();
    }

    /**
     * @return Collection|Permission[]
     */
    public function getAllPermissionsByRole(string $role) {
        try {
            return Role::whereName($role)->with('permissions')->first()->permissions;
        } catch (RoleDoesNotExist | \Exception $e){
            return null;
        }
    }

    /**
     * @param int $id
     * @return \Spatie\Permission\Contracts\Role
     */
    public function getOneRole(int $id): ?\Spatie\Permission\Contracts\Role
    {
        try {
            return Role::findById($id);
        }catch (RoleDoesNotExist | \Exception $e){
            return null;
        }
    }

    /**
     * @param int $id
     * @return \Spatie\Permission\Contracts\Permission
     */
    public function getOnePermission(int $id): ?\Spatie\Permission\Contracts\Permission
    {
        try {
            return Permission::findById($id);
        }catch (PermissionDoesNotExist | \Exception $e){
            return null;
        }
    }

    /**
     * @param string $name
     * @return Builder|Model
     */
    public function createRole(string $name){
        return Role::create(["name" => $name]);
    }

    /**
     * @param string $name
     * @return Builder|Model
     */
    public function createPermission(string $name){
        return Permission::create(["name" => $name]);
    }

    /**
     * @param int $role_id
     * @param int $permission_id
     * @return JsonResponse|\Spatie\Permission\Contracts\Role
     */
    public function assignPermissionRole(int $role_id,int $permission_id)
    {
        try {
            $role = Role::findById($role_id);
            $permission = Permission::findById($permission_id);

            return $role->givePermissionTo($permission->name);
        }catch (RoleDoesNotExist | PermissionDoesNotExist | \Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    /**
     * @param int $role_id
     * @param int $user_id
     * @return User|Builder|Model|JsonResponse|object|null
     */
    public function assignRoleUser(int $role_id,int $user_id){
        try{
            $role = Role::findById($role_id);
            $user = User::whereId($user_id)->first();

            if( is_null($user) ) return null;

            return $user->assignRole($role);
        }catch(RoleDoesNotExist | \Exception $exception){
            return response()->json($exception->getMessage(),500);
        }
    }

    /**
     * @param int $permission_id
     * @param int $user_id
     * @return User|Builder|Model|JsonResponse|object|null
     */
    public function assignPermissionUser(int $permission_id,int $user_id){
        try{
            $permission = Permission::findById($permission_id);
            $user = User::whereId($user_id)->first();

            if( is_null($user) ) return null;

            return $user->givePermissionTo($permission);
        }catch(PermissionDoesNotExist | \Exception $exception){
            return response()->json($exception->getMessage(),500);
        }
    }

    /**
     * @param int $role_id
     * @param int $user_id
     * @return User|Builder|Model|JsonResponse|object|null
     */
    public function revokeRoleUser(int $role_id,int $user_id){
        try{
            $role = Role::findById($role_id);
            $user = User::whereId($user_id)->first();

            if( is_null($user) ) return null;

            return $user->removeRole($role);
        }catch (RoleDoesNotExist | \Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    /**
     * @param int $user_id
     * @param int $permission_id
     * @return User|Builder|Model|JsonResponse|object|null
     */
    public function revokePermissionUser(int $user_id,int $permission_id){
        try{
            $permission = Permission::findById($permission_id);
            $user = User::whereId($user_id)->first();

            if( is_null($user) ) return null;

            return $user->revokePermissionTo($permission);
        }catch (PermissionDoesNotExist | \Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    /**
     * @param int $role_id
     * @param int $permission_id
     * @return JsonResponse|\Spatie\Permission\Contracts\Role
     */
    public function revokePermissionRole(int $role_id,int $permission_id)
    {
        try{
            $role = Role::findById($role_id);
            $permission = Permission::findById($permission_id);

            return $role->revokePermissionTo($permission);
        }catch (RoleDoesNotExist | PermissionDoesNotExist | \Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}

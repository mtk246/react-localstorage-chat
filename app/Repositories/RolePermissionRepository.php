<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Roles\Models\Permission;
use App\Roles\Models\Role;

class RolePermissionRepository
{
    /**
     * @return Collection|Role[]
     */
    public function getAllRoles(){
        return Role::all();
    }

    /**
     * @return Collection|Role[]
     */
    public function getAllRolesWithPermissions() {
        $permissions = Permission::all()->groupBy([
                'module'
            ]);
        $roles = Role::all();
        return [
            'roles'=> $roles,
            'permissions'=> $permissions,
        ];
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
     */
    public function getOneRole(int $id)
    {
        try {
            return Role::find($id);
        }catch (RoleDoesNotExist | \Exception $e){
            return null;
        }
    }

    /**
     * @param int $id
     */
    public function getOnePermission(int $id)
    {
        try {
            return Permission::find($id);
        }catch (PermissionDoesNotExist | \Exception $e){
            return null;
        }
    }

    /**
     * @param string $name
     * @return Builder|Model
     */
    public function createRole(array $data)
    {
        return Role::create([
            'name'        => $data['name'],
            'slug'        => $data['slug'],
            'description' => $data['description'],
            'level'       => $data['level']
        ]);
    }

    /**
     * @param string $name
     * @return Builder|Model
     */
    public function createPermission(array $data)
    {
        return Permission::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description']
        ]);
    }

    /**
     * @param int $role_id
     * @param int $permission_id
     */
    public function assignPermissionRole(int $role_id, int $permission_id)
    {
        try {
            $role = Role::find($role_id);
            $permission = Permission::find($permission_id);

            $role->attachPermission($permission);

            /** Attach permisions to users by rol */
            $users = User::with('roles')->whereHas('roles', function ($query) use ($role_id) {
                $query->where('role_id', $role_id);
            })->get();
            foreach ($users as $user) {
                if (is_null($user->permissions()->find($permission_id))) {
                    $user->permissions()->attach($permission_id);
                }
            }
            return $role->load('permissions');
        }catch (RoleDoesNotExist | PermissionDoesNotExist | \Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    /**
     * @param int $role_id
     * @param int $user_id
     * @return User|Builder|Model|JsonResponse|object|null
     */
    public function assignRoleUser(int $role_id, int $user_id)
    {
        try {
            $role = Role::find($role_id);
            $user = User::whereId($user_id)->first();

            if( is_null($user) ) return null;

            $user->attachRole($role);
            /** Attach permisions to users by rol */
            $role->load('permissions');

            foreach ($role->permissions as $perm) {
                if (is_null($user->permissions()->find($perm->id))) {
                    $user->permissions()->attach($perm->id);
                }
            }
            return $user->load('roles');
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
            $permission = Permission::find($permission_id);
            $user = User::whereId($user_id)->first();

            if( is_null($user) ) return null;

            $user->attachPermission($permission);
            return $user->load('permissions');
        }catch(PermissionDoesNotExist | \Exception $exception){
            return response()->json($exception->getMessage(),500);
        }
    }

    /**
     * @param int $role_id
     */
    public function assignPermissionsRole(Request $request, int $role_id)
    {
        try {
            $permissions = $request->permissions ?? [];
            $role = Role::find($role_id);
            foreach ($permissions as $permission_id) {
                $permission = Permission::find($permission_id);

                $role->attachPermission($permission);
            }
            /** Attach permisions to users by rol */
            $users = User::with('roles')->whereHas('roles', function ($query) use ($role) {
                $query->where('role_id', $role->id);
            })->get();
            foreach ($users as $user) {
                foreach ($permissions as $permission_id) {
                    $permission = Permission::find($permission_id);
                    if (is_null($user->permissions()->find($permission->id))) {
                        $user->permissions()->attach($permission->id);
                    }
                }
            }
            return $role->load('permissions');
        }catch (RoleDoesNotExist | PermissionDoesNotExist | \Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    /**
     * @param int $permission_id
     * @param int $user_id
     */
    public function assignPermissionsUser(Request $request, int $user_id)
    {
        try {
            $permissions = $request->permissions ?? [];
            $user = User::whereId($user_id)->first();

            foreach ($permissions as $permission_id) {
                $permission = Permission::find($permission_id);

                $user->attachPermission($permission);
            }
            return $user->load('permissions');
        } catch(PermissionDoesNotExist | \Exception $exception){
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
            $role = Role::find($role_id);
            $user = User::whereId($user_id)->first();

            if( is_null($user) ) return null;

            $user->detachRole($role);
            return $user->load('roles');
        }catch (RoleDoesNotExist | \Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    /**
     * @param int $user_id
     * @param int $permission_id
     * @return User|Builder|Model|JsonResponse|object|null
     */
    public function revokePermissionUser(int $user_id,int $permission_id)
    {
        try {
            $permission = Permission::find($permission_id);
            $user = User::whereId($user_id)->first();
            if( is_null($user) ) return null;
            
            $permissionConstraints = Permission::whereConstraint($permission->slug)->get();
            foreach ($permissionConstraints as $permissionC) {
                $permissionsC = Permission::whereConstraint($permissionC->slug)->get();
                foreach ($permissionsC as $permC) {
                    $user->detachPermission($permC);
                }
                $user->detachPermission($permissionC);
            }

            $user->detachPermission($permission);
            return $user->load('permissions');
        } catch (PermissionDoesNotExist | \Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    /**
     * @param int $role_id
     * @param int $permission_id
     */
    public function revokePermissionRole(int $role_id,int $permission_id)
    {
        try{
            $role = Role::find($role_id);
            $permission = Permission::find($permission_id);
            $permissionConstraints = Permission::whereConstraint($permission->slug)->get();
            foreach ($permissionConstraints as $permissionC) {
                $permissionsC = Permission::whereConstraint($permissionC->slug)->get();
                foreach ($permissionsC as $permC) {
                    $role->detachPermission($permC);
                }
                $role->detachPermission($permissionC);
            }
            $role->detachPermission($permission);
            return $role->load('permissions');
        }catch (RoleDoesNotExist | PermissionDoesNotExist | \Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }


    /**
     * @param int $user_id
     * @return User|Builder|Model|JsonResponse|object|null
     */
    public function revokePermissionsUser(Request $request, int $user_id)
    {
        try {
            $permissions = $request->permissions ?? [];
            $user = User::whereId($user_id)->first();

            foreach ($permissions as $permission_id) {
                $permission = Permission::find($permission_id);

                $user->detachPermission($permission);
            }
            return $user->load('permissions');
        }catch(PermissionDoesNotExist | \Exception $exception){
            return response()->json($exception->getMessage(),500);
        }
    }

    /**
     * @param int $role_id
     */
    public function revokePermissionsRole(Request $request, int $role_id)
    {
        try {
            $permissions = $request->permissions ?? [];
            $role = Role::whereId($role_id)->first();

            foreach ($permissions as $permission_id) {
                $permission = Permission::find($permission_id);

                $role->detachPermission($permission);
            }
            return $role->load('permissions');
        } catch(PermissionDoesNotExist | \Exception $exception){
            return response()->json($exception->getMessage(),500);
        }
    }
}

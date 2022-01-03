<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
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
        return Permission::all();
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
}

<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Http\Resources\Permissions\RoleResource;
use App\Models\User\Role;

final class UpdateRolePermitAction
{
    /** @param int[] $permission */
    public function invoke(array $permission, Role $role): RoleResource
    {
        $role->permissions()->detach();
        $role->permissions()->sync($permission);

        $role->refresh();

        return new RoleResource($role);
    }
}

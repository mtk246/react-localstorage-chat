<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Http\Resources\Permissions\RoleResource;
use App\Models\User\Role;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class UpdateRolePermitAction
{
    /** @param int[] $permission */
    public function invoke(array $permission, Role $role): AnonymousResourceCollection
    {
        $role->permissions()->detach();
        $role->permissions()->sync($permission);

        return RoleResource::collection($role->refresh());
    }
}

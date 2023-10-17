<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Http\Resources\Permissions\RoleResource;
use App\Models\User\Role;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

final class UpdateRolePermitAction
{
    public function invoke(Collection $wrapper, Role $role): AnonymousResourceCollection
    {
        $role->permissions()->detach();
        $role->permissions()->sync($wrapper->getPermissions());

        return RoleResource::collection($role->refresh());
    }
}

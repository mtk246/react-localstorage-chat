<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Http\Casts\Permissions\StoreMembershipWrapper;
use App\Http\Resources\Permissions\RoleResource;
use App\Models\User\Role;
use Illuminate\Support\Facades\DB;

final class StoreRoleAction
{
    public function invoke(StoreMembershipWrapper $wrapper): RoleResource
    {
        return DB::transaction(function () use ($wrapper) {
            return new RoleResource(tap(Role::query()->create($wrapper->getData()), function (Role $role) use ($wrapper) {
                $role->permissions()->sync($wrapper->getPermissions());
            }));
        });
    }
}

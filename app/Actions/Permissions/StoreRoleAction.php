<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Http\Casts\Permissions\PermissionWrapper;
use App\Http\Casts\Permissions\StoreMembershipWrapper;
use App\Http\Resources\Permissions\RoleResource;
use App\Models\BillingCompany\MembershipRole;
use App\Models\Permissions\Permission;
use Illuminate\Support\Facades\DB;

final class StoreRoleAction
{
    public function invoke(StoreMembershipWrapper $wrapper): RoleResource
    {
        return DB::transaction(function () use ($wrapper) {
            return new RoleResource(tap(MembershipRole::query()->create($wrapper->getData()), function (MembershipRole $membership) use ($wrapper) {
                $wrapper->getPermissions()->each(function (PermissionWrapper $permission) use ($membership, $wrapper) {
                    return Permission::query()
                        ->create($permission->getData($membership->id, MembershipRole::class, $wrapper->getBillingCompanyId()))
                        ->id;
                });
            }));
        });
    }
}

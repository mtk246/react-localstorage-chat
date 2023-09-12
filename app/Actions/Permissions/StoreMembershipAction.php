<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Http\Casts\Permissions\PermissionWrapper;
use App\Http\Casts\Permissions\StoreMembershipWrapper;
use App\Models\BillingCompany\MembershipRole;
use App\Models\Permissions\Permission;
use Illuminate\Support\Facades\DB;

final class StoreMembershipAction
{
    public function invoke(StoreMembershipWrapper $wrapper): MembershipRole
    {
        return DB::transaction(function () use ($wrapper) {
            return tap(MembershipRole::query()->create($wrapper->getData()), function (MembershipRole $membership) use ($wrapper) {
                $membership->syncPermissions($wrapper->getPermissions()->map(function (PermissionWrapper $permission) use ($membership, $wrapper) {
                    return Permission::query()
                        ->create($permission->getData($membership->id, $wrapper->getBillingCompanyId()))
                        ->id;
                })->toArray());
            });
        });
    }
}

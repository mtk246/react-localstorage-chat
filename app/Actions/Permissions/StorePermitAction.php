<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Http\Casts\Permissions\PermissionWrapper;
use App\Http\Resources\Permissions\PermitResource;
use App\Models\BillingCompany\MembershipRole;
use App\Models\Permissions\Permission;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

final class StorePermitAction
{
    public function invoke(Collection $wrapper, MembershipRole $role): AnonymousResourceCollection
    {
        $role->permits()->delete();
        $wrapper->each(function (PermissionWrapper $permission) use ($role) {
            Permission::query()->create($permission->getData($role->id, MembershipRole::class, $role->billing_company_id));
        });

        return PermitResource::collection($role->refresh()->permits);
    }
}

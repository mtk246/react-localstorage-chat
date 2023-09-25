<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Http\Casts\Permissions\UpdateMembershipWrapper;
use App\Http\Resources\Permissions\RoleResource;
use App\Models\BillingCompany\MembershipRole;

final class UpdateRoleAction
{
    public function invoke(UpdateMembershipWrapper $wrapper, MembershipRole $role): RoleResource
    {
        $role->query()->update($wrapper->getData());

        return new RoleResource($role->refresh());
    }
}

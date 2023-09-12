<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Http\Casts\Permissions\StoreMembershipWrapper;
use App\Models\BillingCompany\MembershipRole;

final class UpdateMembershipAction
{
    public function invoke(StoreMembershipWrapper $wrapper, MembershipRole $role): MembershipRole
    {
        $role->query()->update($wrapper->getData());

        return $role;
    }
}

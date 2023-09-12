<?php

declare(strict_types=1);

namespace App\Http\Casts\Permissions;

use App\Http\Casts\CastsRequest;

final class PermissionWrapper extends CastsRequest
{
    public function getData(int $roleId, ?int $billingCompanyId): array
    {
        return [
            'module' => $this->get('module'),
            'permission' => $this->getCollect('permission'),
            'role_id' => $roleId,
            'billing_company_id' => $billingCompanyId,
        ];
    }
}

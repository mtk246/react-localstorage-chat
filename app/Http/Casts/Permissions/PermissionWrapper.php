<?php

declare(strict_types=1);

namespace App\Http\Casts\Permissions;

use App\Http\Casts\CastsRequest;

final class PermissionWrapper extends CastsRequest
{
    public function getData(int $permissionedId, string $permissionedType, ?int $billingCompanyId): array
    {
        return [
            'module' => $this->get('module'),
            'permission' => $this->getArray('permission'),
            'permissioned_type' => $permissionedType,
            'permissioned_id' => $permissionedId,
            'billing_company_id' => $billingCompanyId,
        ];
    }
}

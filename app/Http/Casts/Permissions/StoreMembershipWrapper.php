<?php

declare(strict_types=1);

namespace App\Http\Casts\Permissions;

use App\Http\Casts\CastsRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

final class StoreMembershipWrapper extends CastsRequest
{
    public function getData(): array
    {
        return [
            'name' => $this->get('name'),
            'slug' => Str::slug($this->get('name')),
            'description' => $this->get('note') ?? '',
            'billing_company_id' => $this->getBillingCompanyId(),
        ];
    }

    public function getPermissions(): Collection
    {
        return $this->castMany('permissions', PermissionWrapper::class);
    }

    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->get('billing_company_id')
            ? (int) $this->get('billing_company_id')
            : $this->user->billingCompanies->first()?->id;
    }
}

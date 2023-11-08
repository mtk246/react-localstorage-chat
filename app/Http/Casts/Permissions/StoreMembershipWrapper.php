<?php

declare(strict_types=1);

namespace App\Http\Casts\Permissions;

use App\Http\Casts\CastsRequest;
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
            'type' => $this->get('type'),
        ];
    }

    /** @return int[] */
    public function getPermissions(): array
    {
        return $this->getArray('permissions');
    }

    public function getBillingCompanyId(): ?int
    {
        return Gate::allows('is-admin') && $this->has('billing_company_id')
            ? $this->getInt('billing_company_id')
            : $this->user->billing_company_id;
    }
}

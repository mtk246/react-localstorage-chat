<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Models\BillingCompany\MembershipRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class GetRoleAction
{
    public function getAll(): Collection
    {
        return MembershipRole::query()
            ->when(
                Gate::denies('is-admin'),
                fn (Builder $query) => $query->where('billing_company_id', \Auth::user()->billing_company_id),
            )
            ->get();
    }
}

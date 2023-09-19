<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Facades\Pagination;
use App\Models\BillingCompany\MembershipRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;

final class GetRoleAction
{
    public function getAll(): LengthAwarePaginator
    {
        return MembershipRole::query()
            ->when(
                Gate::denies('is-admin'),
                fn (Builder $query) => $query->where('billing_company_id', \Auth::user()->billing_company_id),
            )
            ->with('billingCompany')
            ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());
    }
}

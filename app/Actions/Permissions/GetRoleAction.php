<?php

declare(strict_types=1);

namespace App\Actions\Permissions;

use App\Facades\Pagination;
use App\Models\User\Role;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;

final class GetRoleAction
{
    public function getAll(): LengthAwarePaginator
    {
        return Role::query()
            ->where('billing_company_id', Gate::allows('is-admin')
                ? \Request::get('billing_company_id')
                : \Auth::user()->billing_company_id
            )
            ->when(
                \Request::boolean('public', true),
                fn ($query) => $query->where('public', true)
            )
            ->with('billingCompany')
            ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());
    }
}

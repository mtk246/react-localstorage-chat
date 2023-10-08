<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Facades\Pagination;
use App\Http\Resources\Claim\RuleResource;
use App\Models\Claims\Rules;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

final class GetClaimRuleAction
{
    public function getAll(Request $request): LengthAwarePaginator
    {
        $billingCompanyId = Gate::denies('is-admin')
            ? $request->user()->billing_company_id
            : $request->get('billing_company_id');

        $search = $request->get('query');

        $rules = ($search ? Rules::search($search) : Rules::query())
            ->when($billingCompanyId, fn ($query) => $query->where('billing_company_id', $billingCompanyId))
            ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());

        return RuleResource::collection($rules)->resource;
    }
}

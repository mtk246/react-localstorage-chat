<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Resources\Claim\RuleResource;
use App\Models\Claims\Rules;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

final class GetClaimRuleAction
{
    public function getAll(?int $billingCompanyId): AnonymousResourceCollection
    {
        $rules = Rules::query()
            ->when(Gate::denies('is-admin'), fn ($query) => $query->where('billing_company_id', $billingCompanyId))
            ->paginate();

        return RuleResource::collection($rules);
    }
}

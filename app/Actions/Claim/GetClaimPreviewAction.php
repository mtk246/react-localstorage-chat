<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Enums\Claim\ClaimType;
use App\Enums\Claim\FormatType;
use App\Models\Claims\Claim;
use App\Models\User;
use App\Services\ClaimService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class GetClaimPreviewAction
{
    public function __construct(
        private readonly ClaimService $claimService,
    ) {
    }

    public function single(array $data, User $user): array
    {
        return DB::transaction(function () use ($data, $user): array {
            $claim = isset($data['rule_id'])
                ? Claim::query()
                    ->with(['demographicInformation', 'insurancePolicies'])
                    ->where('type', $data['type'] ?? ClaimType::INSTITUTIONAL->value)
                    ->firstOrFail()
                : Claim::query()
                    ->where('id', $data['id'] ?? null)
                    ->when(Gate::denies('is-admin'), function (Builder $query) use ($user): void {
                        $query->where('billing_company_id', $user->billingCompanies->first()?->id);
                    })
                    ->with(['demographicInformation', 'insurancePolicies'])
                    ->firstOrFail();

            return $this->claimService->create(
                formatType: FormatType::FILE,
                claim: $claim,
                company: $claim->demographicInformation->company ?? null,
                insurancePlan: $claim->insurancePolicies()
                    ->wherePivot('order', 1)
                    ?->first()
                    ?->insurancePlan ?? null,
                rule: $data['rule_id'] ?? null,
            )->toArray();
        });
    }
}

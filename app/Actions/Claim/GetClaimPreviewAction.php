<?php

declare(strict_types=1);

namespace App\Actions\Claim;

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
            $claim = Claim::query()
                ->where('id', $data['id'] ?? null)
                ->when(Gate::denies('is-admin'), function (Builder $query) use ($user): void {
                    $query->where('billing_company_id', $user->billingCompanies->first()?->id);
                })
                ->with(['demographicInformation', 'insurancePolicies'])
                ->firstOrFail();

            return $this->claimService->create(
                FormatType::FILE,
                $claim,
                $claim->demographicInformation->company ?? null,
                $claim->insurancePolicies()
                    ->wherePivot('order', 1)
                    ?->first()
                    ?->insurancePlan ?? null,
            )->toArray();
        });
    }
}

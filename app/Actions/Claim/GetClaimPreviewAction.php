<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Resources\Claim\PreviewResource;
use App\Models\Claim;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class GetClaimPreviewAction
{
    public function single(array $data, User $user): PreviewResource
    {
        return DB::transaction(function () use ($data, $user): PreviewResource {
            $claim = Claim::query()
                ->where('id', $data['id'] ?? null)
                ->when(Gate::denies('is-admin'), function (Builder $query) use ($user): void {
                    $query->whereHas('claimFormattable', function ($query) use ($user) {
                        $query->where('billing_company_id', $user->billingCompanies->first()?->id);
                    });
                })
                ->first();

            return new PreviewResource($claim);
        });
    }
}

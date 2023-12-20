<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Http\Casts\Company\CopayRequestCast;
use App\Models\Company;
use App\Models\Copay;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class AddCopays
{
    public function invoke(Collection $copays, Company $company, User $user): Collection
    {
        return DB::transaction(function () use ($copays, $company, $user): Collection {
            $this->syncCopays($company, $copays, $user->billing_company_id);

            return $copays->map(fn (CopayRequestCast $copayData) => tap(
                Copay::query()->updateOrCreate(
                    ['id' => $copayData->getId()],
                    $copayData->wrapperCopayBody()
                ),
                fn (Copay $copay) => $this->afterCreate(
                    $copay,
                    $company,
                    $copayData->getProceduresIds(),
                    $copayData->getInsurancePlanIds(),
                )
            ))
            ->map(fn (Copay $copay) => $copay->load('procedures'));
        });
    }

    private function afterCreate(
        Copay &$copay,
        Company &$company,
        Collection $proceduresIds,
        Collection $insurancePlanIds,
    ): void {
        if (is_null($company->copays()->find($copay->id))) {
            $company->copays()->attach($copay->id);
        }
        $copay->procedures()->sync($proceduresIds->toArray());
        $copay->insurancePlans()->sync($insurancePlanIds->toArray());
    }

    private function syncCopays(Company $company, collection $services, ?int $billingCompanyId): void
    {
        $company->copays()
            ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingCompanyId): void {
                $query->where('billing_company_id', $billingCompanyId);
            })
            ->whereNotIn('copays.id', $services->map(
                fn (CopayRequestCast $services) => $services->getId()
            )->toArray())
            ->get()
            ->each(function (Copay $copay) use ($company) {
                $copay->procedures()->detach();
                $copay->insurancePlans()->detach();
                $company->copays()->detach($copay->id);
            });
    }
}

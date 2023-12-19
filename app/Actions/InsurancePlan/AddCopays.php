<?php

declare(strict_types=1);

namespace App\Actions\InsurancePlan;

use App\Http\Casts\InsurancePlan\CopayRequestCast;
use App\Models\Copay;
use App\Models\InsurancePlan;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class AddCopays
{
    public function invoke(Collection $copays, InsurancePlan $insurance, User $user): Collection
    {
        return DB::transaction(function () use ($copays, $insurance, $user): Collection {
            $this->syncCopays($insurance, $copays, $user->billing_company_id);

            return $copays->map(fn (CopayRequestCast $copayData) => tap(
                Copay::query()->updateOrCreate(
                    ['id' => $copayData->getId()],
                    $copayData->wrapperCopayBody()
                ),
                fn (Copay $copay) => $this->afterCreate(
                    $copay,
                    $insurance,
                    $copayData->getProceduresIds(),
                    $copayData->getCompaniesIds()
                )
            ))
            ->map(fn (Copay $copay) => $copay->load([
                'procedures',
                'companies',
            ]));
        });
    }

    private function afterCreate(
        Copay &$copay,
        InsurancePlan &$insurance,
        Collection $proceduresIds,
        Collection $companiesIds
    ): void {
        if (is_null($insurance->copays()->find($copay->id))) {
            $insurance->copays()->attach($copay->id);
        }
        $copay->procedures()->sync($proceduresIds->toArray());
        $copay->companies()->sync($companiesIds->toArray());
    }

    private function syncCopays(InsurancePlan $insurance, collection $services, ?int $billingInsurancePlanId): void
    {
        $insurance->copays()
            ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingInsurancePlanId): void {
                $query->where('billing_company_id', $billingInsurancePlanId);
            })
            ->whereNotIn('copays.id', $services->map(
                fn (CopayRequestCast $services) => $services->getId() ?? null
            )->toArray())
            ->get()
            ->each(function (Copay $copay) use ($insurance) {
                $copay->procedures()->detach();
                $copay->insurancePlans()->detach();
                $copay->companies()->detach();
                $insurance->copays()->detach($copay->id);
            });
    }
}

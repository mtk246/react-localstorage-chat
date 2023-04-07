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
            $this->syncCopays($company, $copays, $user->billingCompanies->first()?->id);

            $copays->each(fn (CopayRequestCast $copayData) => tap(
                Copay::query()->updateOrCreate(['id' => $copayData->getId()], [
                    'billing_company_id' => $copayData->getBillingCompanyId(),
                    'insurance_plan_id' => $copayData->getInsurancePlanId(),
                    'insurance_company_id' => $copayData->getInsuranceCompanyId(),
                    'company_id' => $company->id,
                    'copay' => $copayData->getCopay(),
                    'private_note' => $copayData->getPrivateNote(),
                ]),
                fn (Copay $copay) => $this->afterCreate($copay, $copayData->getProceduresIds())
            ));

            return $company->copays()->with('procedures')->get();
        });
    }

    private function afterCreate(Copay $copay, Collection $proceduresIds): void
    {
        $proceduresIds->each(
            fn (int $procedureId) => $copay->procedures()->attach($procedureId)
        );
    }

    private function syncCopays(Company $company, collection $services, ?int $billingCompanyId): void
    {
        Copay::query()
            ->where('company_id', $company->id)
            ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingCompanyId): void {
                $query->where('billing_company_id', $billingCompanyId);
            })
            ->whereNotIn('id', $services->map(
                fn (CopayRequestCast $services) => $services->getId()
            )->toArray())
            ->get()
            ->each(function (Copay $copay) {
                $copay->procedures()->detach();
                $copay->delete();
            });
    }
}

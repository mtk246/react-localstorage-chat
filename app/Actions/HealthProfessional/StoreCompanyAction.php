<?php

declare(strict_types=1);

namespace App\Actions\HealthProfessional;

use App\Http\Casts\HealthProfessional\StoreCompanyRequestCast;
use App\Http\Resources\HealthProfessional\CompanyHealthProfessionalResource;
use App\Models\CompanyHealthProfessional;
use App\Models\HealthProfessional;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class StoreCompanyAction
{
    public function invoke(Collection $companies, HealthProfessional $doctor): AnonymousResourceCollection
    {
        return DB::transaction(function () use ($companies, $doctor): AnonymousResourceCollection {
            $groups = $companies->mapToGroups(
                fn (StoreCompanyRequestCast $services) => [$services->getBillingCompanyId() => $services]
            );
            if (Gate::allows('is-admin')) {
                $doctor->companies()
                    ->wherePivotNotIn('billing_company_id', $groups->keys()->toArray())
                    ->detach();
            }
            $groups->each(
                fn (Collection $services, int $billingCompanyId) => $this->syncCompanies($doctor, $services, $billingCompanyId)
            );

            $records = CompanyHealthProfessional::query()
                ->where('health_professional_id', $doctor->id)
                ->when(Gate::denies('is-admin'), function (Builder $query) use ($companies): void {
                    $query->where('billing_company_id', $companies->first()->getBillingCompanyId());
                })
                ->get();

            return CompanyHealthProfessionalResource::collection($records);
        });
    }

    private function syncCompanies(HealthProfessional $doctor, Collection $companies, int $billingCompanyId): void
    {
        $validIds = $companies->map(fn (StoreCompanyRequestCast $services) => $services->getId() ?? 0);

        $doctor->companies()
            ->wherePivot('health_professional_id', $doctor->id)
            ->wherePivot('billing_company_id', $billingCompanyId)
            ->wherePivotNotIn('id', $validIds->toArray())
            ->detach();

        $companies->each(
            fn (StoreCompanyRequestCast $company) => CompanyHealthProfessional::query()
                ->updateOrCreate(
                    [
                        'health_professional_id' => $doctor->id,
                        'company_id' => $company->getCompanyId(),
                        'billing_company_id' => $billingCompanyId,
                    ],
                    [
                        'authorization' => $company->getAuthorization()->toArray(),
                    ]
                )
        );
    }
}

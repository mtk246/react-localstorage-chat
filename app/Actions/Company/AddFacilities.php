<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Http\Resources\Company\FacilityResource;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class AddFacilities
{
    public function invoke(Collection $facilities, Company $company): AnonymousResourceCollection
    {
        return DB::transaction(function () use ($facilities, $company): AnonymousResourceCollection {
            $groupByBilling = $facilities->mapToGroups(fn ($facility) => [$facility->getBillingCompanyId() => $facility->getId()]);

            $groupByBilling->each(
                fn (Collection $facilities, int $billingCompanyId) => $this->syncFacilities($company, $facilities, $billingCompanyId)
            );

            $records = $company->facilities()
                ->when(Gate::denies('is-admin'), function (Builder $query) use ($facilities): void {
                    $query->where('billing_company_id', $facilities->first()->getBillingCompanyId());
                })->get();

            return FacilityResource::collection($records);
        });
    }

    private function syncFacilities(Company $company, Collection $facilities, int $billingCompanyId): void
    {
        $company->facilities()
            ->wherePivot('company_id', $company->id)
            ->wherePivot('billing_company_id', $billingCompanyId)
            ->detach();

        $company->facilities()->attach($facilities->mapWithKeys(
            fn ($facility) => [$facility => [
                'billing_company_id' => $billingCompanyId,
            ],
        ])->toArray());
    }
}

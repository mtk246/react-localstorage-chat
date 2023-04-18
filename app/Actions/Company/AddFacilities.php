<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Http\Resources\Company\FacilityResource;
use App\Models\Company;
use App\Models\Facility;
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
            $this->syncFacilities($company, $facilities);

            $records = $company->facilities()
                ->when(Gate::denies('is-admin'), function (Builder $query) use ($facilities): void {
                    $query->where('billing_company_id', $facilities->first()->getBillingCompanyId());
                })->get();

            return FacilityResource::collection($records);
        });
    }

    private function syncFacilities(Company $company, Collection $facilities): void
    {
        $company->facilities()
            ->wherePivot('company_id', $company->id)
            ->when(Gate::denies('is-admin'), function (Builder $query) use ($facilities): void {
                $query->where('billing_company_id', $facilities->first()->getBillingCompanyId());
            })
            ->detach();

        $facilities
            ->mapToGroups(fn ($facility) => [$facility->getBillingCompanyId() => $facility->getId()])
            ->each(function (Collection $facilities, int $billingCompanyId) use ($company) {
                $company->facilities()->attach(
                    $facilities->mapWithKeys(fn ($facility) => [
                        $facility => [
                            'billing_company_id' => $billingCompanyId,
                        ],
                    ])
                    ->toArray()
                );

                Facility::query()
                    ->whereIn('id', $facilities->toArray())
                    ->get()
                    ->each(function (Facility $facility) use ($billingCompanyId): void {
                        $facility->billingCompanies()->attach($billingCompanyId);
                    });
            });
    }
}

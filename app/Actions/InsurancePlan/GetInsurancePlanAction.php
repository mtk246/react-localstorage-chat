<?php

declare(strict_types=1);

namespace App\Actions\InsurancePlan;

use App\Models\InsuranceCompany;
use App\Models\InsurancePlan;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

final class GetInsurancePlanAction
{
    public function list(array $request, User $user): Collection
    {
        if (isset($request['groupBy']) && $request['groupBy']) {
            $query = InsuranceCompany::query()
                ->when(
                    Gate::denies('is-admin'),
                    fn ($query) => $query->whereHas('billingCompanies', function ($query) use ($user) {
                        $query
                            ->where('billing_companies.id', $user->billing_company_id)
                            ->where('billing_companies.status', true);
                    })
                )
                ->get()
                ->map(fn ($model) => [
                    'id' => $model->id,
                    'name' => $model->name,
                    'group_values' => $model->insurancePlans()
                        ->whereNotIn('id', $request['exclude'] ?? [])
                        ->when(
                            Gate::denies('is-admin'),
                            fn ($query) => $query->whereHas('billingCompanies', function ($query) use ($user) {
                                $query
                                    ->where('billing_companies.id', $user->billing_company_id)
                                    ->where('billing_companies.status', true);
                            })
                        )
                        ->get(['id', 'name'])
                        ->setHidden(['status', 'last_modified']),
                ]);
        } else {
            $query = InsurancePlan::query()
                ->whereNotIn('id', $request['exclude'] ?? [])
                ->when(
                    Gate::denies('is-admin'),
                    fn ($query) => $query->whereHas('billingCompanies', function ($query) use ($user) {
                        $query
                            ->where('billing_companies.id', $user->billing_company_id)
                            ->where('billing_companies.status', true);
                    })
                )
                ->get(['id', 'name'])
                ->setHidden(['status', 'last_modified']);
        }

        return $query;
    }
}

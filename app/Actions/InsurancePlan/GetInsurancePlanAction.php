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
        $billingCompanyId = Gate::allows('is-admin')
            ? \Request::get('billing_company_id', $user->billing_company_id)
            : $user->billing_company_id;

        if (isset($request['groupBy']) && $request['groupBy']) {
            $query = InsuranceCompany::query()
                ->with(['insurancePlans' => function ($query) use ($request, $billingCompanyId) {
                    $query
                        ->with(['abbreviations' => function ($query) use ($billingCompanyId) {
                            $query->where('billing_company_id', $billingCompanyId);
                        }])
                        ->whereNotIn('id', $request['exclude'] ?? [])
                        ->when(
                            Gate::denies('is-admin'),
                            fn ($query) => $query->whereHas('billingCompanies', function ($query) use ($billingCompanyId) {
                                $query
                                    ->where('billing_companies.id', $billingCompanyId)
                                    ->where('billing_companies.status', true);
                            })
                        );
                }])
                ->when(
                    !is_null($billingCompanyId),
                    fn ($query) => $query->whereHas('billingCompanies', function ($query) use ($billingCompanyId) {
                        $query
                            ->where('billing_companies.id', $billingCompanyId)
                            ->where('billing_companies.status', true);
                    })
                )
                ->get()
                ->map(fn (InsuranceCompany $model) => [
                    'id' => $model->id,
                    'code' => $model->code,
                    'nicknames' => $model->nicknames->when(
                        Gate::denies('is-admin'),
                        fn ($query) => $query->where('billing_company_id', $billingCompanyId),
                    )->pluck('name')->toArray(),
                    'name' => $model->name,
                    'abbreviation' => $model
                        ->abbreviations
                        ?->where('billing_company_id', $billingCompanyId)
                        ->first()
                        ?->abbreviation,
                    'group_values' => $model->insurancePlans->map(function (InsurancePlan $modelPlan) {
                        $abbreviation = $modelPlan->abbreviations->first()?->abbreviation;
                        return $modelPlan->planTypes->map(fn ($planType) => [
                            'id' => (string) $modelPlan->id.'-'.$planType->id,
                            'name' => $modelPlan->name,
                            'plan_type' => $planType?->code ?? '',
                            'abbreviation' => $abbreviation ?? '',
                        ])->toArray();
                    })->flatten(1)->toArray(),
                ]);
        } else {
            $query = InsurancePlan::query()
                ->whereNotIn('id', $request['exclude'] ?? [])
                ->when(
                    Gate::denies('is-admin'),
                    fn ($query) => $query->whereHas('billingCompanies', function ($query) use ($billingCompanyId) {
                        $query
                            ->where('billing_companies.id', $billingCompanyId)
                            ->where('billing_companies.status', true);
                    })
                )
                ->get(['id', 'name'])
                ->setHidden(['status', 'last_modified']);
        }

        return $query;
    }
}

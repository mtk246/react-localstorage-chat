<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Http\Casts\Company\ExceptionInsuranceWrapper;
use App\Http\Resources\Company\ExceptionInsuranceResource;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class UpdateExceptionInsuranceAction
{
    public function invoke(Company $company, Collection $exceptions, User $user): AnonymousResourceCollection
    {
        return DB::transaction(function () use ($company, $exceptions, $user): AnonymousResourceCollection {
            $billingCompanyId = $user->billing_company_id;
            $company->exceptionInsuranceCompanies()
                ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingCompanyId): void {
                    $query->where('billing_company_id', $billingCompanyId);
                })
                ->whereNotIn('exception_insurance_companies.id', $exceptions->map(
                    fn (ExceptionInsuranceWrapper $exception) => $exception->getId(),
                )->toArray())
                ->delete();

            $exceptions->map(function (ExceptionInsuranceWrapper $exception) use ($company): void {
                $company->exceptionInsuranceCompanies()
                    ->updateOrCreate(
                        [
                            'id' => $exception->getId(),
                        ],
                        [
                            'billing_company_id' => $exception->getBillingCompanyId(),
                            'insurance_plan_ids' => $exception->getInsurancePlanIds(),
                        ]
                    );
            });

            return ExceptionInsuranceResource::collection(
                $company->exceptionInsuranceCompanies()
                    ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingCompanyId): void {
                        $query->where('billing_company_id', $billingCompanyId);
                    })
                    ->orderBy('id')
                    ->get()
            );
        });
    }
}

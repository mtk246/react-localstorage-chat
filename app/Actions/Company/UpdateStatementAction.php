<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Http\Casts\Company\StatementCast;
use App\Http\Resources\Company\StatementResource;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class UpdateStatementAction
{
    public function invoke(Company $company, Collection $statements, User $user): AnonymousResourceCollection
    {
        return DB::transaction(function () use ($company, $statements, $user): AnonymousResourceCollection {
            $billingCompanyId = $user->billing_company_id;
            $company->companyStatements()
                ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingCompanyId): void {
                    $query->where('billing_company_id', $billingCompanyId);
                })
                ->whereNotIn('company_statements.id', $statements->map(
                    fn (StatementCast $statement) => $statement->getId(),
                )->toArray())
                ->delete();

            $statements->map(function (StatementCast $statement) use ($company): void {
                $company->companyStatements()
                    ->updateOrCreate(
                        [
                            'id' => $statement->getId(),
                        ],
                        [
                            'billing_company_id' => $statement->getBillingCompanyId(),
                            'start_date' => $statement->getStartDate(),
                            'end_date' => $statement->getEndDate(),
                            'rule_id' => $statement->getRuleId(),
                            'when_id' => $statement->getWhenId(),
                            'apply_to_ids' => $statement->getApplyToIds(),
                        ]
                    );
            });

            return StatementResource::collection(
                $company->companyStatements()
                    ->when(Gate::denies('is-admin'), function (Builder $query) use ($billingCompanyId): void {
                        $query->where('billing_company_id', $billingCompanyId);
                    })
                    ->orderBy('id')
                    ->get()
            );
        });
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Company;

use App\Http\Casts\Company\StatementCast;
use App\Http\Resources\Company\StatementResource;
use App\Models\Company;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class UpdateStatement
{
    public function invoke(Company $company, Collection $request): AnonymousResourceCollection
    {
        return DB::transaction(function () use ($company, $request): AnonymousResourceCollection {
            $company->companyStatements()
                ->whereNotIn('id', $request->map(
                    fn (StatementCast $statement) => $statement->getId(),
                )->toArray())
                ->where('billing_company_id', $request->getBillingCompanyId())
                ->delete();

            $request->each(function (StatementCast $statement) use ($company, $request): void {
                $company->companyStatements()
                    ->updateOrCreate([
                        'id' => $statement->getId(),
                        'billing_company_id' => $request->getBillingCompanyId(),
                    ], [
                        'start_date' => $statement->getStartDate(),
                        'end_date' => $statement->getEndDate(),
                        'rule_id' => $statement->getRuleId(),
                        'when_id' => $statement->getWhenId(),
                        'apply_to_ids' => $statement->getApplyToIds(),
                    ]);
            });

            return StatementResource::collection(
                $company->companyStatements()
                    ->where('billing_company_id', $request->getBillingCompanyId())
                    ->orderBy('id')
                    ->get(),
                $request,
            );
        });
    }
}

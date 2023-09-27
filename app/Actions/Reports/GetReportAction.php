<?php

declare(strict_types=1);

namespace App\Actions\Reports;

use App\Facades\Pagination;
use App\Http\Casts\Reports\GetAllCast;
use App\Http\Resources\Reports\ReportResource;
use App\Models\Reports\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class GetReportAction
{
    public function all(GetAllCast $filters): LengthAwarePaginator
    {
        return DB::transaction(function () use ($filters): LengthAwarePaginator {
            $reports = Report::query()
                ->where(function (Builder $query) use ($filters): void {
                    $query->when($filters->getBillingCompanyId(), function (Builder $query) use ($filters): void {
                        $query->where('billing_company_id', null)
                            ->orWhere('billing_company_id', $filters->getBillingCompanyId());
                    });
                })
                ->when($filters->getClasifications()->isNotEmpty(), function (Builder $query) use ($filters): void {
                    $filters->getClasifications()->each(function (int $value) use (&$query): void {
                        $query->orWhere('clasifications', 'like', "%{$value}%");
                    });
                })
                ->when($filters->getFavorite(), function (Builder $query): void {
                    $query->Where('favorite', true);
                })
                ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                ->paginate(Pagination::itemsPerPage());

            return ReportResource::collection($reports)->resource;
        });
    }

    public function single(string $id, User $user): ReportResource
    {
        return DB::transaction(function () use ($id, $user): ReportResource {
            $report = Report::query()
                ->where('id', $id)
                ->when(Gate::denies('is-admin'), function (Builder $query) use ($user): void {
                    $query
                        ->where('billing_company_id', null)
                        ->orWhere('billing_company_id', $user->billingCompanies->first()?->id);
                })
                ->firstOrFail();

            return new ReportResource($report);
        });
    }
}

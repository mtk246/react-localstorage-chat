<?php

declare(strict_types=1);

namespace App\Actions\Reports;

use App\Http\Casts\Reports\GetAllCast;
use App\Http\Resources\Reports\ReportResource;
use App\Models\Reports\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class GetReportAction
{
    public function all(GetAllCast $filters): AnonymousResourceCollection
    {
        return DB::transaction(function () use ($filters): AnonymousResourceCollection {
            $reports = Report::query()
                ->where('billing_company_id', null)
                ->orWhere('billing_company_id', $filters->getBillingCompanyId())
                ->when($filters->getTags()->isNotEmpty(), function (Builder $query) use ($filters): void {
                    $filters->getTags()->each(function (int $value) use (&$query): void {
                        $query->orWhere('tags', 'like', "%{$value}%");
                    });
                })
                ->when($filters->getFavorite(), function (Builder $query): void {
                    $query->orWhere('favorite', true);
                })
                ->get();

            return ReportResource::collection($reports);
        });
    }

    public function single(string $id, User $user): ReportResource
    {
        return DB::transaction(function () use ($id, $user): ReportResource {
            $report = Report::query()
                ->where('id', $id)
                ->where('billing_company_id', null)
                ->when(Gate::denies('is-admin'), function (Builder $query) use ($user): void {
                    $query->orWhere('billing_company_id', $user->billingCompanies->first()?->id);
                })
                ->firstOrFail();

            return new ReportResource($report);
        });
    }
}

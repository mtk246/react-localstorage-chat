<?php

declare(strict_types=1);

namespace App\Actions\Reports;

use App\Http\Casts\Reports\StoreRequestCast;
use App\Http\Resources\Reports\ReportResource;
use App\Models\Reports\Report;
use Illuminate\Support\Facades\DB;

final class StoreReportAction
{
    public function invoke(StoreRequestCast $report): ReportResource
    {
        return DB::transaction(function () use ($report): ReportResource {
            $baseReport = $report->getBaseReport();

            $report = tap(Report::create([
                    'name' => $baseReport?->name ?? $report->getName(),
                    'description' => $baseReport?->description ?? $report->getDescription(),
                    'type' => $baseReport?->type->value ?? $report->getType(),
                    'range' => $baseReport?->range ?? $report->getRange(),
                    'clasification' => $baseReport?->clasification->value ?? $report->getClasification(),
                    'configuration' => $report->getConfiguration()->toArray(),
                    'url' => $baseReport?->url ?? null,
                    'favorite' => false,
                ]), function (Report $reportModel) use ($report): void {
                    // @todo log action
                    $reportModel->billingCompany()->associate($report->getBillingCompanyId())->save();
                });

            return new ReportResource($report);
        });
    }
}

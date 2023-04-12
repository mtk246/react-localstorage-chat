<?php

declare(strict_types=1);

namespace App\Actions\Reports;

use App\Http\Casts\Reports\ConfigurationCast;
use App\Http\Casts\Reports\StoreRequestCast;
use App\Http\Resources\Reports\ReportResource;
use App\Models\Reports\Report;
use Illuminate\Support\Facades\DB;

final class StoreAction
{
    public function invoke(StoreRequestCast $report): ReportResource
    {
        return DB::transaction(function () use ($report): ReportResource {
            $report = tap(Report::ctreate([
                    'name' => $report->getName(),
                    'use' => $report->getUse(),
                    'description' => $report->getDescription(),
                    'type' => $report->getType(),
                    'range' => $report->getRange(),
                    'tags' => $report->getTags(),
                    'configuration' => $report->getConfiguration()->map(
                        fn (ConfigurationCast $configuration) => $configuration->toArray()
                    )->toArray(),
                    'favorite' => false,
                ]), function (Report $reportModel) use ($report): void {
                    $reportModel->billingCompanies()->attach($report->getBillingCompanyId());
                });

            return new ReportResource($report);
        });
    }
}

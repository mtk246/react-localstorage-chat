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
            $report = tap(Report::create([
                    'name' => $report->getName(),
                    'use' => $report->getUse(),
                    'description' => $report->getDescription(),
                    'type' => $report->getType(),
                    'range' => $report->getRange(),
                    'tags' => $report->getTags(),
                    'configuration' => $report->getConfiguration()->toArray(),
                    'favorite' => false,
                ]), function (Report $reportModel) use ($report): void {
                    // @todo log action
                    $reportModel->billingCompany()->associate($report->getBillingCompanyId())->save();
                });

            return new ReportResource($report);
        });
    }
}

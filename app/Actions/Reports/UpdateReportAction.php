<?php

declare(strict_types=1);

namespace App\Actions\Reports;

use App\Http\Casts\Reports\UpdateRequestCast;
use App\Http\Resources\Reports\ReportResource;
use App\Models\Reports\Report;
use Illuminate\Support\Facades\DB;

final class UpdateReportAction
{
    public function invoke(UpdateRequestCast $reportUpdate, Report $report): ReportResource
    {
        return DB::transaction(function () use ($reportUpdate, $report): ReportResource {
            $report->update([
                'name' => $reportUpdate->getName(),
                'description' => $reportUpdate->getDescription(),
                'type' => $reportUpdate->getType(),
                'range' => $reportUpdate->getRange(),
                'clasification' => $reportUpdate->getClasification(),
                'configuration' => $reportUpdate->getConfiguration()->toArray(),
                'favorite' => $reportUpdate->getFavorite(),
            ]);

            $report->billingCompany()->associate($reportUpdate->getBillingCompanyId());

            return new ReportResource($report);
        });
    }
}

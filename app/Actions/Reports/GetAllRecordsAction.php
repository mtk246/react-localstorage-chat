<?php

declare(strict_types=1);

namespace App\Actions\Reports;

use App\Enums\Reports\TypeReportAll;
use App\Http\Resources\Reports\AllRecordsResource;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class GetAllRecordsAction
{
    public function getAllPatient(string $module, User $user): AllRecordsResource
    {
        $data = DB::transaction(function () use ($module, $user): Collection {
            return DB::table($this->getViewReport($module))
                ->when(
                    Gate::denies('is-admin'),
                    fn ($query) => $query->whereJsonContains('billing_id', $user->billing_company_id),
                )->get();
        })->toArray();
        \Log::info($this->getModuleReport($module));

        return new AllRecordsResource($data, $this->getModuleReport($module));
    }

    private function getViewReport($module)
    {
        return match ($module) {
            TypeReportAll::PGFOODVKOC => 'view_detailed_patient',
            TypeReportAll::JBEPEUZRBK => 'view_general_patient',
            TypeReportAll::QVHZFWCVGJ => 'view_general_facility',
            TypeReportAll::QNSJADXODC => 'view_general_healthcare_professional',
        };
    }

    private function getModuleReport($module)
    {
        return match ($module) {
            TypeReportAll::PGFOODVKOC => 'detailed_patient',
            TypeReportAll::JBEPEUZRBK => 'general_patient',
            TypeReportAll::QVHZFWCVGJ => 'general_facility',
            TypeReportAll::QNSJADXODC => 'general_healthcare_professional',
        };
    }
}

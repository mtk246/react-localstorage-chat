<?php

declare(strict_types=1);

namespace App\Actions\Reports;

use App\Facades\Pagination;
use App\Http\Resources\Reports\AllRecordsResource;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

final class GetAllRecordsAction
{
    public function getAllPatient(string $module, User $user): AllRecordsResource
    {
        $typeReport = Str::snake($module);

        $data = DB::transaction(function () use ($typeReport, $user): LengthAwarePaginator {
            return DB::table('view_'.$typeReport.'_report')
                ->when(
                    Gate::denies('is-admin'),
                    fn ($query) => $query->whereJsonContains('billing_id', $user->billing_company_id),
                )
                ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                ->paginate(Pagination::itemsPerPage());
        })->toArray();

        return new AllRecordsResource($data, $module);
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Reports;

use App\Enums\Reports\TypeReportAll;
use App\Facades\Pagination;
use App\Http\Resources\Reports\AllRecordsResource;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

final class GetAllRecordsAction
{
    public function getAllPatient(string $module, User $user)
    {
        $data = DB::transaction(function () use ($module, $user): LengthAwarePaginator {
            return DB::table(TypeReportAll::from($module)->getText())
                ->when(
                    Gate::denies('is-admin'),
                    fn ($query) => $query->where('billing_id', $user->billing_company_id),
                )->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                ->paginate(Pagination::itemsPerPage());
        })->toArray();
        return new AllRecordsResource($data, TypeReportAll::from($module)->getName());
    }
}

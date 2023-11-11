<?php

declare(strict_types=1);

namespace App\Actions\Reports;

use App\Facades\Pagination;
use App\Http\Resources\Reports\AllRecordsResource;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Str;

final class GetAllRecordsAction
{
    public function getAllPatient(string $module, User $user): AllRecordsResource
    {
        $data = DB::transaction(function () use ($user, $module): LengthAwarePaginator {
            return DB::table('view_'.Str::snake($module).'_report')
                ->paginate(Pagination::itemsPerPage());
        })->toArray();

        return new AllRecordsResource($data, $module);
    }
}

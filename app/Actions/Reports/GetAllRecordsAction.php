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
    public function getAllPatient(string $module, User $user)
    {
        $data = DB::transaction(function () use ($module, $user): Collection {
            return DB::table(TypeReportAll::from($module)->getText())
                ->when(
                    Gate::denies('is-admin'),
                    fn ($query) => $query->where('billing_id', $user->billing_company_id),
                )->get();
        })->toArray();

        return new AllRecordsResource($data, TypeReportAll::from($module)->getName());
    }
}

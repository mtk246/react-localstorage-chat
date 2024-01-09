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
    public function getAllPatient(object $request, User $user): AllRecordsResource
    {
        $data = DB::transaction(function () use ($user, $request): Collection {
            return DB::table(TypeReportAll::from($request->module)->getText())
                ->when(
                    Gate::denies('is-admin'),
                    fn ($query) => $query->where('billing_id', $user->billing_company_id),
                )->when(
                    $request->from && !$request->to,
                    fn ($query) => $query->where($request->typeDate, $request->from),
                )->when(
                    $request->from && $request->to,
                    fn ($query) => $query->whereDate($request->typeDate, '>=', $request->from)
                        ->whereDate($request->typeDate, '<=', $request->to),
                )->get();
        })->toArray();

        return new AllRecordsResource($data, TypeReportAll::from($request->module)->getName());
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Presets;

use App\Models\Reports\Preset;
use Illuminate\Support\Facades\DB;

final class GetAllPresetAction
{
    public function invoke(string $reportId): array
    {
        return DB::transaction(function () use ($reportId): array {
            $presentsPrivate = Preset::select('id', 'name', 'description', 'filter', 'report_id', 'version')
                ->where('report_id', $reportId)
                ->where('is_private', true)
                ->where('user_id', \Auth::user()->id)
                ->get();

            $presentsPublic = Preset::select('id', 'name', 'description', 'filter', 'report_id', 'version')
                ->where('report_id', $reportId)
                ->where('is_private', false)
                ->get();

            return [
                'public' => $presentsPublic,
                'private' => $presentsPrivate,
            ];
        });
    }
}

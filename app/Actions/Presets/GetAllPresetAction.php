<?php

declare(strict_types=1);

namespace App\Actions\Presets;

use App\Http\Resources\Reports\PresetResource;
use App\Models\Reports\Preset;
use Illuminate\Support\Facades\DB;

final class GetAllPresetAction
{
    public function invoke(string $reportId): PresetResource
    {
        return DB::transaction(function () use ($reportId): PresetResource {
            $presentsPrivate = Preset::select('id', 'name', 'description', 'filter', 'report_id')
            ->where('report_id', $reportId)
            ->where('is_private', true)
            ->where('user_id', \Auth::user()->id)
            ->get();

            $presentsPublic = Preset::select('id', 'name', 'description', 'filter', 'report_id')
                ->where('report_id', $reportId)
                ->where('is_private', false)
                ->get();

            return new PresetResource(
                [
                    'public' => $presentsPublic,
                    'private' => $presentsPrivate,
                ]
            );
        });
    }
}

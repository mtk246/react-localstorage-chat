<?php

declare(strict_types=1);

namespace App\Actions\Presets;

use App\Models\Reports\Preset;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

final class UpdatePresetAction
{
    public function invoke(Request $request, Preset $preset): array
    {
        return DB::transaction(function () use ($preset, $request): array {
            $preset->name = $request->name;
            $preset->description = $request->description;
            $preset->filter = json_encode($request->filter);
            $preset->version = $request->version ? $request->version : 'v1';
            $preset->report_id = $request->reportId;
            $preset->is_private = $request->is_private;
            $preset->user_id = Auth::user()->id;
            $preset->billing_company_id = Auth::user()->billing_company_id ? Auth::user()->billing_company_id : 1;
            $preset->update();

            return [
                'success' => true,
                'message' => 'List successfully.',
                'data' => $preset,
            ];
        });
    }
}

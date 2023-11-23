<?php

declare(strict_types=1);

namespace App\Actions\Presets;

use App\Http\Casts\Presets\StoreRequestCast;
use App\Models\Reports\Preset;
use Illuminate\Support\Facades\DB;

final class UpdatePresetAction
{
    public function invoke(StoreRequestCast $request, Preset $preset): Preset
    {
        return DB::transaction(function () use ($preset, $request): Preset {
            $preset->updateOrCreate([
                "user_id" => $request->getUserId(),
                "id" => $preset->id
            ], $request->getData());

            return $preset;
        });
    }
}

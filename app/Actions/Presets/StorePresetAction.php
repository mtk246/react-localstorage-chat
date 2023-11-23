<?php

declare(strict_types=1);

namespace App\Actions\Presets;

use App\Http\Casts\Presets\StoreRequestCast;
use App\Models\Reports\Preset;
use Illuminate\Support\Facades\DB;

final class StorePresetAction
{
    public function invoke(StoreRequestCast $request): Preset
    {
        return DB::transaction(function () use ($request): Preset {
            return Preset::create($request->getData());
        });
    }
}

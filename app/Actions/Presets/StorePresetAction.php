<?php

declare(strict_types=1);

namespace App\Actions\Presets;

use App\Http\Casts\Presets\StoreRequestCast;
use App\Http\Resources\Reports\PresetResource;
use App\Models\Reports\Preset;
use Illuminate\Support\Facades\DB;

final class StorePresetAction
{
    public function invoke(StoreRequestCast $request): PresetResource
    {
        return DB::transaction(function () use ($request): PresetResource {
            $preset = Preset::create($request->getData());

            return new PresetResource($preset);
        });
    }
}

<?php

declare(strict_types=1);

namespace App\Actions\Presets;

use App\Http\Casts\Presets\StoreRequestCast;
use App\Http\Resources\Reports\PresetResource;
use App\Models\Reports\Preset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class UpdatePresetAction
{
    public function invoke(StoreRequestCast $request, Preset $preset): PresetResource
    {
        return DB::transaction(function () use ($preset, $request): PresetResource {
            
            if (Auth::user()->id == $preset->user_id) {
                $preset->update($request->getData());
            }

            if (Auth::user()->id != $preset->user_id) {
                Preset::create($request->getData($preset->version));
            }
            
            return new PresetResource($preset);
        });
    }
}

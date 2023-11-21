<?php

declare(strict_types=1);

namespace App\Actions\Presets;

use App\Http\Casts\Presets\StoreRequestCast;
use App\Models\Reports\Preset;
use Auth;
use Gate;
use Illuminate\Support\Facades\DB;

final class StorePresetAction
{
    public function invoke(StoreRequestCast $preset): Array
    {
        return DB::transaction(function () use ($preset): Array {
            $preset = tap(Preset::create([
                    'name' => $preset->getName(),
                    'description' => $preset->getDescription(),
                    'filter' => $preset->getFilter(),
                    'version' => 'v1',
               ]), function (Preset $presetModel) use ($preset): void {
                    $presetModel->billingCompanies()->associate(Auth::user()->billing_company_id)->save();
                    $presetModel->users()->associate(Auth::user()->id)->save();
                    $presetModel->reports()->associate($preset->getBaseReport())->save();
                });
            return [
                'success' => true,
                'message' => "List successfully.",
                'data' => $preset,
            ];
        });
    }
}

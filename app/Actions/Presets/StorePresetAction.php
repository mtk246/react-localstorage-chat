<?php

declare(strict_types=1);

namespace App\Actions\Presets;

use App\Models\Reports\Preset;
use Illuminate\Support\Facades\DB;

final class StorePresetAction
{
    public function invoke(array $preset): array
    {
        return DB::transaction(function () use ($preset): array {
            $preset = tap(Preset::create([
                    'name' => $preset['name'],
                    'description' => $preset['description'],
                    'is_private' => $preset['is_private'],
                    'filter' => json_encode($preset['filter']),
                    'version' => 'v1',
                    'billing_company_id' => \Auth::user()->billing_company_id ? \Auth::user()->billing_company_id : null,
                    'user_id' => \Auth::user()->id,
                    'report_id' => $preset['reportId'],
               ]));

            return [
                'success' => true,
                'message' => 'List successfully.',
                'data' => $preset,
            ];
        });
    }
}

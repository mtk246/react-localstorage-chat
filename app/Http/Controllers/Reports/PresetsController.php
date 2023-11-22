<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Actions\Presets\GetAllPresetAction;
use App\Actions\Presets\StorePresetAction;
use App\Actions\Presets\UpdatePresetAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Presets\StoreRequest;
use App\Models\Reports\Preset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PresetsController extends Controller
{
    public function index(Request $request, GetAllPresetAction $action) {
        return response()->json(
            $action->invoke($request->id)
        );
    }

    public function store(StoreRequest $request, StorePresetAction $store): JsonResponse {
        return response()->json(
            $store->invoke($request->toArray())
        );
    }

    public function update(Request $request, Preset $preset, UpdatePresetAction $action) {
        return response()->json(
            $action->invoke($request, $preset)
        );
    }

    public function destroy(Preset $preset): JsonResponse {
        $preset->delete();
        return response()->json(['message' => 'Report deleted successfully.']);
    }
}

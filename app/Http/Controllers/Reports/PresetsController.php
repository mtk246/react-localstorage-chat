<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Actions\Presets\StorePresetAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Presets\StoreRequest;
use App\Models\Reports\Preset;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PresetsController extends Controller
{
    public function index() {
        $presents = Preset::select("id", "name", "filter")->get();
        $res = [
            'success' => true,
            'message' => "List successfully.",
            'data' => $presents,
        ];

        return response()->json($res);
    }

    public function store(Request $request, StorePresetAction $store): JsonResponse {
        // public function store(StoreRequest $request, StorePresetAction $store): JsonResponse {
        $presents = new Preset;

        $presents->name = $request->name;
        $presents->description = $request->description;
        $presents->filter = json_encode($request->filter);
        $presents->version = $request->version ? $request->version : 'v1';
        $presents->report_id = '01229C09819911EEB9620242AC';
        $presents->user_id = Auth::user()->id;
        $presents->billing_company_id = Auth::user()->billing_company_id ? Auth::user()->billing_company_id : 1;
        $presents->save();

        $res = [
            'success' => true,
            'message' => "List successfully.",
            'data' => $presents,
        ];

        return response()->json(
            $res
        );
    }

    public function update(Request $request, $id) {
        $presents = Preset::find($id);

        $presents->name = $request->name;
        $presents->description = $request->description;
        $presents->filter = $request->filter;
        $presents->version = $request->version ? $request->version : 'v1';
        $presents->report_id = '01229C09819911EEB9620242AC';
        $presents->user_id = Auth::user()->id;
        $presents->billing_company_id = Auth::user()->billing_company_id ? Auth::user()->billing_company_id : 1;
        $presents->save();

        $res = [
            'success' => true,
            'message' => "List successfully.",
            'data' => $presents,
        ];

        return response()->json($res);
    }

    public function destroy(Preset $preset): JsonResponse {
        $preset->delete();
        return response()->json(['message' => 'Report deleted successfully.']);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repositories\PresetRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PresetController extends Controller
{
    public function __construct(private PresetRepository $presetRepository)
    {
    }

    public function store(Request $request)
    {
        $preset = $this->presetRepository->create($request->toArray());
        return response()->json($preset);
    }

    public function update(Request $request, $id)
    {
        $preset = $this->presetRepository->update($request->toArray(), $id);
        return response()->json($preset);
    }

    public function show($id)
    {
        $preset = $this->presetRepository->show($id);
        return response()->json($preset);
    }

    public function destroy($id)
    {
        $preset = $this->presetRepository->destroy($id);
        return response()->json($preset);
    }
}

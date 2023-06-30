<?php

declare(strict_types=1);

namespace App\Http\Controllers\Claim;

use App\Http\Controllers\Controller;
use App\Http\Requests\Claim\StoreRulesRequest;
use App\Http\Requests\Claim\UpdateRulesRequest;
use App\Models\Claim\Rules;
use Illuminate\Http\JsonResponse;

final class RulesController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json();
    }

    public function create(): JsonResponse
    {
        return response()->json();
    }

    public function store(StoreRulesRequest $request): JsonResponse
    {
        return response()->json();
    }

    public function show(Rules $rules): JsonResponse
    {
        return response()->json();
    }

    public function edit(Rules $rules): JsonResponse
    {
        return response()->json();
    }

    public function update(UpdateRulesRequest $request, Rules $rules): JsonResponse
    {
        return response()->json();
    }

    public function destroy(Rules $rules): JsonResponse
    {
        return response()->json();
    }
}

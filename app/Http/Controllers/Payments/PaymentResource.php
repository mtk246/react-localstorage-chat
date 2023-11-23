<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PaymentResource extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json();
    }

    public function create(): JsonResponse
    {
        return response()->json();
    }

    public function store(Request $request): JsonResponse
    {
        return response()->json();
    }

    public function show($id): JsonResponse
    {
        return response()->json();
    }

    public function edit($id): JsonResponse
    {
        return response()->json();
    }

    public function update(Request $request, $id): JsonResponse
    {
        return response()->json();
    }

    public function destroy($id): JsonResponse
    {
        return response()->json();
    }
}

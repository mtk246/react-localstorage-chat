<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Claim\GetClaimPreviewAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ClaimPreviewController extends Controller
{
    public function show(Request $request, GetClaimPreviewAction $preview): JsonResponse
    {
        return response()->json(
            $preview->single($request->input(), $request->user()),
        );
    }
}

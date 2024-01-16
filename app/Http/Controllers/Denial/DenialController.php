<?php

declare(strict_types=1);

namespace App\Http\Controllers\Denial;

use App\Actions\Claim\Denial\StoreRefileAction;
use App\Actions\Claim\Denial\UpdateRefileAction;
use App\Actions\Claim\GetDenialAction;
use App\Models\Claims\Claim;
use App\Http\Controllers\Controller;
use App\Http\Requests\Denial\StoreRefileRequest;
use App\Repositories\ClaimRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class DenialController extends Controller
{
    public function __construct(
        private ClaimRepository $claimRepository,
    ) {
    }

    public function getServerAll(
        Request $request,
        GetDenialAction $getDenial
    ): JsonResponse {
        return response()->json($getDenial->all($request));
    }

    public function getOneDenial(
        Claim $denial,
        GetDenialAction $getDenial
    ): JsonResponse {
        return response()->json($getDenial->single($denial));
    }

    public function createDenialTracking(Request $request, GetDenialAction $getDenialAction)
    {
        return $getDenialAction->createDenialTracking($request);
    }

    public function updateDenialTracking(Request $request, GetDenialAction $getDenialAction)
    {
        return $getDenialAction->updateDenialTracking($request);
    }

    public function createDenialRefile(StoreRefileRequest $request, StoreRefileAction $store)
    {
        return response()->json($store->invoke($request->casted()));
    }

    public function updateDenialRefile(StoreRefileRequest $request, UpdateRefileAction $update)
    {
        return response()->json($update->invoke($request->casted()));
    }
}

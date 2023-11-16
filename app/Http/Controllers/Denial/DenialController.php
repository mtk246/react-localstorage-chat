<?php

declare(strict_types=1);

namespace App\Http\Controllers\Denial;

use App\Actions\Claim\GetDenialAction;
use App\Models\Claims\Claim;
use App\Models\Claims\DenialTracking;
use App\Models\Claims\DenialRefile;
use App\Http\Casts\Claims\DenialRefileWrapper;
use App\Http\Casts\Claims\DenialTrackingWrapper;
use App\Http\Controllers\Controller;
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
        Claim $claim,
        GetDenialAction $getDenial
    ): JsonResponse {
        $status = ($request->has('status') && $request->status !== null) ?
        json_decode($request->status, true) : [];

        $subStatus = ($request->has('subStatus') && $request->subStatus !== null) ?
        json_decode($request->subStatus, true) : [];

        return response()->json($getDenial->all($claim, $request, $status, $subStatus));
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

    public function createDenialRefile(Request $request, GetDenialAction $getDenialAction)
    {
        return $getDenialAction->createDenialRefile($request);
    }

    public function updateDenialRefile(Request $request, GetDenialAction $getDenialAction)
    {
        return $getDenialAction->updateDenialRefile($request);
    }
}

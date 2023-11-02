<?php

declare(strict_types=1);

namespace App\Http\Controllers\Denial;

use App\Actions\Claim\GetClaimAction;
use App\Actions\Claim\GetDenialAction;
use App\Models\Claims\Claim;
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
        GetClaimAction $getClaim
    ): JsonResponse {
        return response()->json($getClaim->all($claim, $request));
    }

    public function getOneDenial(
        Claim $denial,
        GetDenialAction $getDenial
    ): JsonResponse {
        return response()->json($getDenial->single($denial));
    }
}

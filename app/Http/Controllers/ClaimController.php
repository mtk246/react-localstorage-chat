<?php

namespace App\Http\Controllers;

use App\Http\Requests\Claim\CreateClaimRequest;
use App\Repositories\ClaimRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    private $claimRepository;

    public function __construct()
    {
        $this->claimRepository = new ClaimRepository();
    }

    /**
     * @param claimCreateRequest $request
     * @return JsonResponse
     */
    public function create(CreateclaimRequest $request)
    {
        $rs = $this->claimRepository->create($request->validated());

        return $rs ? response()->json($rs) : response()->json(__("Error creating claim"), 400);
    }
}

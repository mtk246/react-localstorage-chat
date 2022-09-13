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

    public function getListTypeOfServices()
    {
        $rs = $this->claimRepository->getListTypeOfServices();

        return $rs ? response()->json($rs) : response()->json(__("Error get all service type of service"), 400);
    }

    public function getListPlaceOfServices()
    {
        $rs = $this->claimRepository->getListPlaceOfServices();

        return $rs ? response()->json($rs) : response()->json(__("Error get all service place of service"), 400);
    }

    public function getListRevCenters()
    {
        $rs = $this->claimRepository->getListRevCenters();

        return $rs ? response()->json($rs) : response()->json(__("Error get all service rev. Centers"), 400);
    }

    public function getListTypeFormats()
    {
        $rs = $this->claimRepository->getListTypeFormats();

        return $rs ? response()->json($rs) : response()->json(__("Error get all type formats"), 400);
    }

    public function getListStatus()
    {
        $rs = $this->claimRepository->getListStatus();

        return $rs ? response()->json($rs) : response()->json(__("Error get all status claim"), 400);
    }
}

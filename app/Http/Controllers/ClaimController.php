<?php

namespace App\Http\Controllers;

use App\Http\Requests\Claim\ClaimCreateRequest;
use App\Repositories\ClaimRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

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
    public function createClaim(ClaimCreateRequest $request)
    {
        $rs = $this->claimRepository->createClaim($request->validated());

        return $rs ? response()->json($rs) : response()->json(__("Error creating claim"), 400);
    }

    /**
     * @param claimCreateRequest $request
     * @return JsonResponse
     */
    public function updateClaim(ClaimCreateRequest $request, $id)
    {
        $rs = $this->claimRepository->updateClaim($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__("Error updating claim"), 400);
    }

    public function getAllClaims() {
        return response()->json(
            $this->claimRepository->getAllClaims()
        );
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneClaim(int $id): JsonResponse
    {
        $rs = $this->claimRepository->getOneClaim($id);

        return $rs ? response()->json($rs) : response()->json(__("Error, claim not found"), 404);
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

    /**
     * Security Authorization Access Token
     *
     * @method getSecurityAuthorizationAccessToken
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function getSecurityAuthorizationAccessToken(): JsonResponse
    {
        $client = new Client([
            'base_uri' => 'https://sandbox.apigw.changehealthcare.com/apip/auth/v2/token',
            //'timeout'  => 2.0
        ]);
        try {
            /**$response = $client->request('POST', '', [
                'form_params' => [
                    'client_id'     => '7ULJqHZb91y2zP3lgD4xQ3A3jACdmPTF',
                    'client_secret' => 'EBPadsDKoOuEoOWv',
                    'grant_type'    => 'client_credentials'
                ]
            ]);*/
            $response = Http::acceptJson()->post('https://sandbox.apigw.changehealthcare.com/apip/auth/v2/token', [
                'client_id'     => '7ULJqHZb91y2zP3lgD4xQ3A3jACdmPTF',
                'client_secret' => 'EBPadsDKoOuEoOWv',
                'grant_type'    => 'client_credentials'
            ]);
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}

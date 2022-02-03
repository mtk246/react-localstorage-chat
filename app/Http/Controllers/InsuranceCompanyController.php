<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInsuranceRequest;
use App\Repositories\InsuranceCompanyRepository;
use Illuminate\Http\JsonResponse;
#use Illuminate\Http\Request;

class InsuranceCompanyController extends Controller
{
    private $InsuranceRepository;

    public function __construct(){
        $this->InsuranceRepository = new InsuranceCompanyRepository();
    }

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function getByName(string $name): JsonResponse
    {
        $rs = $this->InsuranceRepository->searchByName($name);

        return count($rs) > 0 ? response()->json($rs) : response()->json("Insurance companies not found",404);
    }

    /**
     * @param CreateInsuranceRequest $request
     * @return JsonResponse
     */
    public function createInsurance(CreateInsuranceRequest $request): JsonResponse
    {
        $rs = $this->InsuranceRepository->createInsurance($request->validated());

        return $rs ? response()->json($rs,201) : response()->json("error creating insurance",400);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getOneInsurance($id): JsonResponse
    {
        $rs = $this->InsuranceRepository->getOneInsurance($id);

        return $rs ? response()->json($rs) : response()->json("insurance not found",404);
    }

    /**
     * @return JsonResponse
     */
    public function getAllInsurance(): JsonResponse
    {
        $rs = $this->InsuranceRepository->getAllInsurance();

        return response()->json($rs);
    }


}

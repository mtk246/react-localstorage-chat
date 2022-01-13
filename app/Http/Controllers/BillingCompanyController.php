<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyBilling;
use App\Repositories\BillingCompanyRepository;
use Illuminate\Http\Request;

class BillingCompanyController extends Controller
{
    private $billingCompanyRepository;

    public function __construct()
    {
        $this->billingCompanyRepository = new BillingCompanyRepository();
    }

    /**
     * @param CreateCompanyBilling $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCompany(CreateCompanyBilling $request): \Illuminate\Http\JsonResponse
    {
        $rs = $this->billingCompanyRepository->createBillingCompany($request->validated());

        return $rs ? response()->json($rs,201) : response()->json("error creating billing company",400);
    }

    /**
     * @param mixed $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBillingCompanyByUser($user_id): \Illuminate\Http\JsonResponse
    {
        $rs = $this->billingCompanyRepository->getAllBillingCompanyByUser($user_id);

        return $rs ? response()->json($rs) : response()->json("user not found",404);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllBillingCompany(): \Illuminate\Http\JsonResponse
    {
        $rs = $this->billingCompanyRepository->getAllBillingCompany();

        return response()->json($rs);
    }
}

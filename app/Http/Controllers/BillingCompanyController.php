<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompanyBilling;
use App\Repositories\BillingCompanyRepository;
use Illuminate\Http\JsonResponse;
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
     * @return JsonResponse
     */
    public function createCompany(CreateCompanyBilling $request): JsonResponse
    {
        $rs = $this->billingCompanyRepository->createBillingCompany($request->validated());

        return $rs ? response()->json($rs,201) : response()->json("error creating billing company",400);
    }

    /**
     * @param mixed $user_id
     * @return JsonResponse
     */
    public function getBillingCompanyByUser($user_id): JsonResponse
    {
        $rs = $this->billingCompanyRepository->getAllBillingCompanyByUser($user_id);

        return $rs ? response()->json($rs) : response()->json("user not found",404);
    }

    /**
     * @return JsonResponse
     */
    public function getAllBillingCompany(): JsonResponse
    {
        $rs = $this->billingCompanyRepository->getAllBillingCompany();

        return response()->json($rs);
    }

    /**
     * @param string $code
     * @return JsonResponse
     */
    public function getByCode(string $code): JsonResponse
    {
        $rs = $this->billingCompanyRepository->getByCode($code);

        return !is_null($rs) ? response()->json($rs) : response()->json([],404);
    }

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function getByName(string $name): JsonResponse
    {
        $rs = $this->billingCompanyRepository->getByName($name);

        return !is_null($rs) ? response()->json($rs) : response()->json([],404);
    }
}

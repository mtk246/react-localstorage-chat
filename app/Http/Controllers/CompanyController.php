<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Repositories\CompanyRepository;
use Illuminate\Http\JsonResponse;
#use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private $companyRepository;

    public function __construct()
    {
        $this->companyRepository = new CompanyRepository();
    }

    /**
     * @param CompanyCreateRequest $request
     * @return JsonResponse
     */
    public function createCompany(CompanyCreateRequest $request): JsonResponse
    {
        $rs = $this->companyRepository->createCompany($request->validated());

        return $rs ? response()->json($rs,201) : response()->json("Error creating company",400);
    }

    /**
     * @return JsonResponse
     */
    public function getAllCompany(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getAllCompanies()
        );
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneCompany(int $id): JsonResponse
    {
        $rs = $this->companyRepository->getOneCompany($id);

        return $rs ? response()->json($rs) : response()->json("error company not found",404);
    }
}

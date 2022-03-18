<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusCompanyRequest;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
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

    /**
     * @param CompanyUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateCompany(CompanyUpdateRequest $request,int $id): JsonResponse
    {
        $rs = $this->companyRepository->updateCompany($request->validated(),$id);

        return $rs ? response()->json($rs) : response()->json("Error updating company",400);
    }

    /**
     * @param string $email
     * @return JsonResponse
     */
    public function getOneByEmail(string $email): JsonResponse
    {
        $rs = $this->companyRepository->getOneByEmail($email);

        return $rs ? response()->json($rs) : response()->json("company not found",404);
    }

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function getByName(string $name): JsonResponse
    {
        $rs = $this->companyRepository->getByName($name);

        return $rs ? response()->json($rs) : response()->json("company not found",404);
    }

    /**
     * @param string $npi
     * @return JsonResponse
     */
    public function getOneByNpi(string $npi): JsonResponse
    {
        $rs = $this->companyRepository->getOneByNpi($npi);

        return $rs ? response()->json($rs) : response()->json("company not found", 404);
    }

    /**
     * @param ChangeStatusCompanyRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusCompanyRequest $request,int $id): JsonResponse
    {
        $rs = $this->companyRepository->changeStatus($request->input("status"),$id);

        return $rs ? response()->json([],204) : response()->json("error updating status",400);
    }

    /**
     * @param  int $id
     * @return JsonResponse
     */
    public function addToBillingCompany(int $id): JsonResponse
    {
        $rs = $this->companyRepository->addToBillingCompany($id);

        return $rs ? response()->json($rs) : response()->json("error add company to billing company", 404);
    }
}

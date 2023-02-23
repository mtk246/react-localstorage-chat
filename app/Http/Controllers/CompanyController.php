<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusCompanyRequest;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Requests\Company\AddFacilitiesRequest;
use App\Repositories\CompanyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(
        private CompanyRepository $companyRepository,
    ) { }

    /**
     * @param CompanyCreateRequest $request
     * @return JsonResponse
     */
    public function createCompany(CompanyCreateRequest $request): JsonResponse
    {
        $rs = $this->companyRepository->createCompany($request->validated());

        return $rs ? response()->json($rs,201) : response()->json(__("Error creating company"), 400);
    }

    
    /**
     * @return JsonResponse
     */
    public function getList($id = null): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListCompanies($id)
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListStatementRules(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListStatementRules()
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListStatementWhen(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListStatementWhen()
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListStatementApplyTo(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListStatementApplyTo()
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListNameSuffix(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListNameSuffix()
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListContractFeeTypes(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListContractFeeTypes()
        );
    }

    public function getListBillingCompanies(Request $request) {
        return response()->json(
            $this->companyRepository->getListBillingCompanies($request)
        );
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
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function getServerAll(Request $request): JsonResponse
    {
        return $this->companyRepository->getServerAllCompanies($request);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneCompany(int $id): JsonResponse
    {
        $rs = $this->companyRepository->getOneCompany($id);

        return $rs ? response()->json($rs) : response()->json(__("Error, company not found"), 404);
    }

    /**
     * @param CompanyUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateCompany(CompanyUpdateRequest $request,int $id): JsonResponse
    {
        $rs = $this->companyRepository->updateCompany($request->validated(),$id);

        return $rs ? response()->json($rs) : response()->json(__("Error updating company"), 400);
    }

    /**
     * @param string $email
     * @return JsonResponse
     */
    public function getOneByEmail(string $email): JsonResponse
    {
        $rs = $this->companyRepository->getOneByEmail($email);

        return $rs ? response()->json($rs) : response()->json(__("Error, company not found"), 404);
    }

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function getByName(string $name): JsonResponse
    {
        $rs = $this->companyRepository->getByName($name);

        return $rs ? response()->json($rs) : response()->json(__("Error, company not found"), 404);
    }

    /**
     * @param string $npi
     * @return JsonResponse
     */
    public function getOneByNpi(string $npi): JsonResponse
    {
        $rs = $this->companyRepository->getOneByNpi($npi);

        return $rs ? response()->json($rs) : response()->json(__("Error, company not found"), 404);
    }

    /**
     * @param ChangeStatusCompanyRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusCompanyRequest $request,int $id): JsonResponse
    {
        $rs = $this->companyRepository->changeStatus($request->input("status"),$id);

        return $rs ? response()->json([],204) : response()->json(__("Error updating status"), 400);
    }

    /**
     * @param  int $id
     * @return JsonResponse
     */
    public function addToBillingCompany(int $id): JsonResponse
    {
        $rs = $this->companyRepository->addToBillingCompany($id);

        return $rs ? response()->json($rs) : response()->json(__("Error add company to billing company"), 404);
    }

    /**
     * @param  int $id
     * @return JsonResponse
     */
    public function addFacilities(AddFacilitiesRequest $request, int $id): JsonResponse
    {
        $rs = $this->companyRepository->addFacilities($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__("Error add facilities to company"), 404);
    }
}

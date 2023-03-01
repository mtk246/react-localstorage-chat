<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Company\AddServices;
use App\Http\Requests\ChangeStatusCompanyRequest;
use App\Http\Requests\Company\AddFacilitiesRequest;
use App\Http\Requests\Company\AddServicesRequest;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(
        private CompanyRepository $companyRepository,
    ) {
    }

    public function createCompany(CompanyCreateRequest $request): JsonResponse
    {
        $rs = $this->companyRepository->createCompany($request->validated());

        return $rs ? response()->json($rs, 201) : response()->json(__('Error creating company'), 400);
    }

    public function getList($id = null): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListCompanies($id)
        );
    }

    public function getListStatementRules(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListStatementRules()
        );
    }

    public function getListStatementWhen(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListStatementWhen()
        );
    }

    public function getListStatementApplyTo(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListStatementApplyTo()
        );
    }

    public function getListNameSuffix(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListNameSuffix()
        );
    }

    public function getListContractFeeTypes(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListContractFeeTypes()
        );
    }

    public function getListBillingCompanies(Request $request)
    {
        return response()->json(
            $this->companyRepository->getListBillingCompanies($request)
        );
    }

    public function getAllCompany(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getAllCompanies()
        );
    }

    public function getServerAll(Request $request): JsonResponse
    {
        return $this->companyRepository->getServerAllCompanies($request);
    }

    public function getOneCompany(int $id): JsonResponse
    {
        $rs = $this->companyRepository->getOneCompany($id);

        return $rs ? response()->json($rs) : response()->json(__('Error, company not found'), 404);
    }

    public function updateCompany(CompanyUpdateRequest $request, int $id): JsonResponse
    {
        $rs = $this->companyRepository->updateCompany($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error updating company'), 400);
    }

    public function getOneByEmail(string $email): JsonResponse
    {
        $rs = $this->companyRepository->getOneByEmail($email);

        return $rs ? response()->json($rs) : response()->json(__('Error, company not found'), 404);
    }

    public function getByName(string $name): JsonResponse
    {
        $rs = $this->companyRepository->getByName($name);

        return $rs ? response()->json($rs) : response()->json(__('Error, company not found'), 404);
    }

    public function getOneByNpi(string $npi): JsonResponse
    {
        $rs = $this->companyRepository->getOneByNpi($npi);

        return $rs ? response()->json($rs) : response()->json(__('Error, company not found'), 404);
    }

    public function changeStatus(ChangeStatusCompanyRequest $request, int $id): JsonResponse
    {
        $rs = $this->companyRepository->changeStatus($request->input('status'), $id);

        return $rs ? response()->json([], 204) : response()->json(__('Error updating status'), 400);
    }

    public function addToBillingCompany(int $id): JsonResponse
    {
        $rs = $this->companyRepository->addToBillingCompany($id);

        return $rs ? response()->json($rs) : response()->json(__('Error add company to billing company'), 404);
    }

    public function addFacilities(AddFacilitiesRequest $request, int $id): JsonResponse
    {
        $rs = $this->companyRepository->addFacilities($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error add facilities to company'), 404);
    }

    public function addServices(
        AddServices $addServices,
        AddServicesRequest $request,
        Company $company,
    ): JsonResponse {
        $request->validated();

        $rs = $addServices->invoke(user: $request->user(), company: $company, services: $request->getservices());

        return $rs ? response()->json($rs) : response()->json(__('Error add services to company'), 404);
    }

    public function addCopays(AddCopaysRequest $request, int $id): JsonResponse
    {
        $rs = $this->companyRepository->addCopays($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error add copays to company'), 404);
    }

    public function addContractFees(AddContractFeesRequest $request, int $id): JsonResponse
    {
        $rs = $this->companyRepository->addContractFees($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error add contract fees to company'), 404);
    }
}

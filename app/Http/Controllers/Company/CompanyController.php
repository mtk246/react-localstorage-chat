<?php

declare(strict_types=1);

namespace App\Http\Controllers\Company;

use App\Actions\Company\AddContractFees;
use App\Actions\Company\AddCopays;
use App\Actions\Company\AddServices;
use App\Actions\Company\GetCompany;
use App\Actions\Company\UpdateCompany;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeStatusCompanyRequest;
use App\Http\Requests\Company\AddCompanyCopaysRequest;
use App\Http\Requests\Company\AddContractFeesRequest;
use App\Http\Requests\Company\AddFacilitiesRequest;
use App\Http\Requests\Company\AddServicesRequest;
use App\Http\Requests\Company\StoreExectionICRequest;
use App\Http\Requests\Company\StoreStatementRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Http\Requests\Company\UpdateContactDataRequest;
use App\Http\Requests\Company\UpdateNotesRequest;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/** @todo separate in multiple controllers files this class is too big */
final class CompanyController extends Controller
{
    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    public function createCompany(CompanyCreateRequest $request): JsonResponse
    {
        $rs = $this->companyRepository->createCompany($request->validated());

        return $rs ? response()->json($rs, 201) : response()->json(__('Error creating company'), 400);
    }

    public function getList(Request $request, ?int $id = null): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListCompanies($request, $id),
        );
    }

    public function getListStatementRules(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListStatementRules(),
        );
    }

    public function getListStatementWhen(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListStatementWhen(),
        );
    }

    public function getListStatementApplyTo(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListStatementApplyTo(),
        );
    }

    public function getListNameSuffix(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListNameSuffix(),
        );
    }

    public function getListContractFeeTypes(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListContractFeeTypes(),
        );
    }

    public function getListBillingCompanies(Request $request): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getListBillingCompanies($request),
        );
    }

    public function getAllCompany(): JsonResponse
    {
        return response()->json(
            $this->companyRepository->getAllCompanies(),
        );
    }

    public function getServerAll(Request $request): JsonResponse
    {
        return $this->companyRepository->getServerAllCompanies($request);
    }

    public function getOneCompany(Request $request, GetCompany $getOne, int $id): JsonResponse
    {
        $rs = $getOne->getOne($id, $request->user());

        return $rs ? response()->json($rs) : response()->json(__('Error, company not found'), 404);
    }

    public function updateCompany(CompanyUpdateRequest $request, int $id): JsonResponse
    {
        $rs = $this->companyRepository->updateCompany($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error updating company'), 400);
    }

    public function updateCompanyData(UpdateCompanyRequest $request, UpdateCompany $updateCompany, Company $company): JsonResponse
    {
        $rs = $updateCompany->invoke($company, $request->casted());

        return response()->json($rs);
    }

    public function UpdateContactData(
        UpdateContactDataRequest $request,
        UpdateCompany $updateCompany,
        Company $company
    ): JsonResponse {
        $rs = $updateCompany->contactData($company, $request->casted());

        return $rs ? response()->json($rs) : response()->json(__('Error updating company'), 400);
    }

    public function StoreStatements(
        StoreStatementRequest $request,
        UpdateCompany $updateCompany,
        Company $company
    ): JsonResponse {
        $rs = $updateCompany->statement($company, $request->casted());

        return response()->json($rs);
    }

    public function StoreExectionInsuranceCompanies(
        StoreExectionICRequest $request,
        UpdateCompany $updateCompany,
        Company $company
    ): JsonResponse {
        $rs = $updateCompany->exectionInsuranceCompanies($company, $request->casted());

        return response()->json($rs);
    }

    public function updateCompanyNotes(UpdateNotesRequest $request, UpdateCompany $updateCompany, Company $company): JsonResponse
    {
        $rs = $updateCompany->notes($company, $request->casted());

        return response()->json($rs);
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

        $rs = $addServices->invoke($request->castedCollect('services'), $company, $request->user());

        return $rs ? response()->json($rs) : response()->json(__('Error add services to company'), 404);
    }

    public function addCompanyCopays(
        AddCopays $addCopays,
        AddCompanyCopaysRequest $request,
        Company $company,
    ): JsonResponse {
        $request->validated();

        $rs = $addCopays->invoke($request->castedCollect('copays'), $company);

        return $rs ? response()->json($rs) : response()->json(__('Error add copays to company'), 404);
    }

    public function addCompanyContractFees(
        AddContractFees $addContractFees,
        AddContractFeesRequest $request,
        Company $company,
    ): JsonResponse {
        $request->validated();

        $rs = $addContractFees->invoke($request->castedCollect('contract_fees'), $company);

        return $rs ? response()->json($rs) : response()->json(__('Error add contract fees to company'), 404);
    }
}

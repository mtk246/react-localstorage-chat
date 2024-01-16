<?php

namespace App\Http\Controllers\BillingCompany;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillingCompany\UpdateBillingCompanyRequest;
use App\Http\Requests\CreateCompanyBilling;
use App\Http\Requests\ImgBillingCompanyRequest;
use App\Repositories\BillingCompanyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\BillingCompany;

final class BillingCompanyController extends Controller
{
    public function __construct(private BillingCompanyRepository $billingCompanyRepository)
    {
    }

    public function index(): JsonResponse
    {
        $rs = $this->billingCompanyRepository->getAllBillingCompany();

        return response()->json($rs);
    }

    public function show(string $id): JsonResponse
    {
        $rs = $this->billingCompanyRepository->getBillingCompany($id);

        return $rs ? response()->json($rs) : response()->json(__('Error, billing company not found'), 404);
    }

    public function update(UpdateBillingCompanyRequest $request, int $id): JsonResponse
    {
        $rs = $this->billingCompanyRepository->update($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error updating billing company'), 400);
    }

    public function createCompany(CreateCompanyBilling $request): JsonResponse
    {
        $rs = $this->billingCompanyRepository->createBillingCompany($request->validated());

        return $rs ? response()->json($rs, 201) : response()->json(__('Error creating billing company'), 400);
    }

    public function changeStatus(Request $request, BillingCompany $billingCompany): JsonResponse
    {
        $rs = $this->billingCompanyRepository->changeStatus($request->input('status'), $billingCompany);

        return $rs ? response()->json([], 204) : response()->json(__('Error updating status'), 400);
    }

    /** @param string|int $user_id */
    public function getAllBillingCompanyByUser(mixed $user_id): JsonResponse
    {
        $rs = $this->billingCompanyRepository->getAllBillingCompanyByUser($user_id);

        return $rs ? response()->json($rs) : response()->json(__('Error, user not found'), 404);
    }

    public function getAllBillingCompany(): JsonResponse
    {
        $rs = $this->billingCompanyRepository->getAllBillingCompany();

        return response()->json($rs);
    }

    public function getServerAllBillingCompanies(Request $request): JsonResponse
    {
        return $this->billingCompanyRepository->getServerAllBillingCompanies($request);
    }

    public function getByCode(string $code): JsonResponse
    {
        $rs = $this->billingCompanyRepository->getByCode($code);

        return !is_null($rs) ? response()->json($rs) : response()->json([], 404);
    }

    public function getByName(string $name): JsonResponse
    {
        $rs = $this->billingCompanyRepository->getByName($name);

        return !is_null($rs) ? response()->json($rs) : response()->json([], 404);
    }

    public function getList(): JsonResponse
    {
        $rs = $this->billingCompanyRepository->getList();

        return !is_null($rs) ? response()->json($rs) : response()->json([], 404);
    }

    public function uploadImage(ImgBillingCompanyRequest $request): JsonResponse
    {
        $rs = $this->billingCompanyRepository->uploadImage($request);

        return $rs ? response()->json($rs) : response()->json(__('Error updating image billing company'), 400);
    }

    public function getBillingCompany(BillingCompany $company_binding): JsonResponse
    {
        return response()->json($company_binding);
    }
}

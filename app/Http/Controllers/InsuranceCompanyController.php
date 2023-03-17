<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\InsuranceCompany\GetInsuranceCompany;
use App\Http\Requests\BillingCompany\GetAllFiltered;
use App\Http\Requests\ChangeStatusInsuraceRequest;
use App\Http\Requests\CreateInsuranceRequest;
use App\Http\Requests\UpdateInsuranceRequest;
use App\Repositories\InsuranceCompanyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class InsuranceCompanyController extends Controller
{
    private $insuranceRepository;

    public function __construct()
    {
        $this->insuranceRepository = new InsuranceCompanyRepository();
    }

    /** @todo please delete me this kind of end point should not exist */
    public function filtered(GetAllFiltered $request, GetInsuranceCompany $getInsuranceCompany): JsonResponse
    {
        $rs = $getInsuranceCompany->filtered($request->toArray());

        return response()->json($rs);
    }

    public function getByName(string $name): JsonResponse
    {
        $rs = $this->insuranceRepository->searchByName($name);

        return count($rs) > 0 ? response()->json($rs) : response()->json(__('Error, insurance company not found'), 404);
    }

    public function getByPayer(string $payer): JsonResponse
    {
        $rs = $this->insuranceRepository->getByPayer($payer);

        return $rs ? response()->json($rs) : response()->json(__('Error, insurance company not found'), 404);
    }

    public function createInsurance(CreateInsuranceRequest $request): JsonResponse
    {
        $rs = $this->insuranceRepository->createInsurance($request->validated());

        return $rs ? response()->json($rs, 201) : response()->json(__('Error creating insurance company'), 400);
    }

    public function getOneInsurance($id): JsonResponse
    {
        $rs = $this->insuranceRepository->getOneInsurance($id);

        return $rs ? response()->json($rs) : response()->json(__('Error, insurance company not found'), 404);
    }

    public function getAllInsurance(): JsonResponse
    {
        $rs = $this->insuranceRepository->getAllInsurance();

        return response()->json($rs);
    }

    /**
     * @param Illuminate\Http\Request $request
     */
    public function getServerAll(Request $request): JsonResponse
    {
        return $this->insuranceRepository->getServerAllInsurance($request);
    }

    public function changeStatus(ChangeStatusInsuraceRequest $request, int $id): JsonResponse
    {
        $rs = $this->insuranceRepository->changeStatus($request->input('status'), $id);

        return $rs ? response()->json([], 204) : response()->json(__('Error, insurance company not found'), 404);
    }

    public function updateInsurance(UpdateInsuranceRequest $request, int $id): JsonResponse
    {
        $rs = $this->insuranceRepository->updateInsurance($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error updating insurance company'), 400);
    }

    public function addToBillingCompany(int $id): JsonResponse
    {
        $rs = $this->insuranceRepository->addToBillingCompany($id);

        return $rs ? response()->json($rs) : response()->json(__('Error add insurance company to billing company'), 404);
    }

    public function getList()
    {
        return response()->json(
            $this->insuranceRepository->getList()
        );
    }

    public function getListBillingCompanies(Request $request)
    {
        return response()->json(
            $this->insuranceRepository->getListBillingCompanies($request)
        );
    }

    public function getListFileMethods()
    {
        return response()->json(
            $this->insuranceRepository->getListFileMethods()
        );
    }

    public function getListFromTheDate()
    {
        return response()->json(
            $this->insuranceRepository->getListFromTheDate()
        );
    }

    public function getListBillingIncompleteReasons()
    {
        return response()->json(
            $this->insuranceRepository->getListBillingIncompleteReasons()
        );
    }

    public function getListAppealReasons()
    {
        return response()->json(
            $this->insuranceRepository->getListAppealReasons()
        );
    }
}

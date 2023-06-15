<?php

namespace App\Http\Controllers;

use App\Actions\InsuranceCompany\GetInsuranceCompany;
use App\Http\Requests\ChangeStatusInsuraceRequest;
use App\Http\Requests\CreateInsuranceRequest;
use App\Http\Requests\InsuranceCompany\SearchRequest;
use App\Http\Requests\UpdateInsuranceRequest;
use App\Repositories\InsuranceCompanyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

final class InsuranceCompanyController extends Controller
{
    private $insuranceRepository;

    public function __construct()
    {
        $this->insuranceRepository = new InsuranceCompanyRepository();
    }

    /** @todo please delete me this kind of end point should not exist */
    public function search(SearchRequest $request, GetInsuranceCompany $getInsuranceCompany): JsonResponse
    {
        $rs = $getInsuranceCompany->search($request->toArray());

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

        if ($rs) {
            if (isset($rs['result']) && $rs['result']) {
                return response()->json($rs['data']);
            } else {
                if (Gate::check('is-admin')) {
                    return response()->json(__('Forbidden, The insurance company has already been associated with all the billing companies'), 403);
                } else {
                    return response()->json(__('Forbidden, The insurance company has already been associated with the billing company'), 403);
                }
            }
        } else {
            return response()->json(__('Error, insurance company not found'), 404);
        }
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

    public function getList(Request $request)
    {
        return response()->json(
            $this->insuranceRepository->getList($request->all())
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

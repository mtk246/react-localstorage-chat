<?php

namespace App\Http\Controllers;

use App\Actions\InsurancePlan\GetInsurancePlanAction;
use App\Http\Requests\ChangeStatusInsurancePlanRequest;
use App\Http\Requests\InsurancePlan\AddContractFeesRequest;
use App\Http\Requests\InsurancePlan\AddCopaysRequest;
use App\Http\Requests\InsurancePlan\CreateRequest;
use App\Http\Requests\InsurancePlan\UpdateRequest;
use App\Repositories\InsurancePlanRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InsurancePlanController extends Controller
{
    private $insurancePlanRepository;

    public function __construct()
    {
        $this->insurancePlanRepository = new InsurancePlanRepository();
    }

    public function createInsurancePlan(CreateRequest $request): JsonResponse
    {
        $rs = $this->insurancePlanRepository->createInsurancePlan($request->validated());

        return $rs ? response()->json($rs, 201) : response()->json(__('Error creating insurance plan'), 400);
    }

    public function updateInsurancePlan(UpdateRequest $request, int $id): JsonResponse
    {
        $rs = $this->insurancePlanRepository->updateInsurancePlan($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error update insurance plan'), 400);
    }

    public function getOneInsurancePlan(int $id): JsonResponse
    {
        $rs = $this->insurancePlanRepository->getOneInsurancePlan($id);

        return $rs ? response()->json($rs) : response()->json(__('Error, insurance plan not found'), 404);
    }

    public function getByName(string $name): JsonResponse
    {
        $rs = $this->insurancePlanRepository->getByName($name);

        return $rs ? response()->json($rs) : response()->json(__('Error, insurance plan not found'), 404);
    }

    public function getAllInsurancePlans(): JsonResponse
    {
        return response()->json($this->insurancePlanRepository->getAllInsurancePlan());
    }

    public function getServerAll(Request $request): JsonResponse
    {
        return $this->insurancePlanRepository->getServerAllInsurancePlan($request);
    }

    public function changeStatus(ChangeStatusInsurancePlanRequest $request, int $id): JsonResponse
    {
        $rs = $this->insurancePlanRepository->changeStatus($request->input('status'), $id);

        return $rs ? response()->json([], 204) : response()->json(__('Error, insurance plan not found'), 404);
    }

    public function getByCompany(string $companyName): JsonResponse
    {
        $rs = $this->insurancePlanRepository->getByCompany($companyName);

        return $rs ? response()->json($rs) : response()->json(__('Error, insurance plan not found'), 404);
    }

    public function getAllPlanByInsuranceCompany(int $id): JsonResponse
    {
        return response()->json(
            $this->insurancePlanRepository->getAllPlanByInsurancePlan($id)
        );
    }

    public function getList(Request $request, GetInsurancePlanAction $getInsurace)
    {
        return response()->json(
            $getInsurace->list($request->input(), $request->user())
        );
    }

    public function getListBillingCompanies(Request $request)
    {
        return response()->json(
            $this->insurancePlanRepository->getListBillingCompanies($request)
        );
    }

    public function getListByCompany(int $id)
    {
        return response()->json(
            $this->insurancePlanRepository->getListByCompany($id)
        );
    }

    public function getListFormats()
    {
        return response()->json(
            $this->insurancePlanRepository->getListFormats()
        );
    }

    public function getListInsTypes()
    {
        return response()->json(
            $this->insurancePlanRepository->getListInsTypes()
        );
    }

    public function getListPlanTypes()
    {
        return response()->json(
            $this->insurancePlanRepository->getListPlanTypes()
        );
    }

    public function getListChargeUsings()
    {
        return response()->json(
            $this->insurancePlanRepository->getListChargeUsings()
        );
    }

    public function getByPayer(string $payer): JsonResponse
    {
        $rs = $this->insurancePlanRepository->getByPayer($payer);

        if ($rs) {
            if (isset($rs['result']) && $rs['result']) {
                return response()->json($rs['data']);
            } else {
                if (Gate::check('is-admin')) {
                    return response()->json(__('Forbidden, The insurance plan has already been associated with all the billing companies of your insurance company'), 403);
                } else {
                    return response()->json(__('Forbidden, The insurance plan has already been associated with the billing company of your insurance company'), 403);
                }
            }
        } else {
            return response()->json(__('Error, insurance plan not found'), 404);
        }
    }

    public function addCopays(AddCopaysRequest $request, int $id): JsonResponse
    {
        $rs = $this->insurancePlanRepository->addCopays($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error add copays to insurance'), 404);
    }

    public function addContractFees(AddContractFeesRequest $request, int $id): JsonResponse
    {
        $rs = $this->insurancePlanRepository->addContractFees($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error add contract fees to insurance'), 404);
    }
}

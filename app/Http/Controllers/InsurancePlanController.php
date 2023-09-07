<?php

namespace App\Http\Controllers;

use App\Actions\InsurancePlan\GetInsurancePlan;
use App\Actions\InsurancePlan\GetInsurancePlanAction;
use App\Http\Requests\ChangeStatusInsurancePlanRequest;
use App\Http\Requests\InsurancePlan\AddContractFeesRequest;
use App\Http\Requests\InsurancePlan\AddCopaysRequest;
use App\Http\Requests\InsurancePlan\CreateRequest;
use App\Http\Requests\InsurancePlan\UpdateRequest;
use App\Http\Resources\InsurancePlan\InsurancePlanByPayerResource;
use App\Repositories\InsurancePlanRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Actions\InsurancePlan\AddCopays;
use App\Models\InsurancePlan;

use App\Actions\InsurancePlan\AddContractFees;
use App\Services\ClearingHouseService;

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

    public function getOneInsurancePlan(Request $request, GetInsurancePlan $getInsurance, InsurancePlan $insurance): JsonResponse
    {
        $rs = $getInsurance->single($insurance, $request->user());

        return $rs ? response()->json($rs) : response()->json(__('Error, company not found'), 404);
    }

    public function getByName(string $name): JsonResponse
    {
        $rs = $this->insurancePlanRepository->getByName($name);

        return $rs ? response()->json($rs) : response()->json(__('Error, insurance plan not found'), 404);
    }

    public function getListByPayer(string $payer, ClearingHouseService $service): JsonResponse
    {
        $rs = $service->list($payer, request()->user());

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
        return response()->json($this->insurancePlanRepository->getListPlanTypes());
    }

    public function getByPayer(string $payer, ClearingHouseService $service): JsonResponse
    {
        $servicePayer = $this->getListByPayer($payer, $service);
        $rs = $this->insurancePlanRepository->getByPayer($payer);

        if ('Error, insurance plan not found' !== $servicePayer->original) {
            if ($rs) {
                return response()->json(
                    InsurancePlanByPayerResource::make(
                        ['data' => $rs, 'service' => $servicePayer, 'type' => 'local'],
                    ),
                    200,
                );
            }

            if ($servicePayer->original) {
                return response()->json(
                    InsurancePlanByPayerResource::make(
                        ['data' => $servicePayer->original, 'type' => 'service'],
                    ),
                    200,
                );
            }
        }
    }

    public function addCopays(
        AddCopays $addCopays,
        AddCopaysRequest $request,
        InsurancePlan $insurance,
    ): JsonResponse {
        $request->validated();

        $rs = $addCopays->invoke($request->castedCollect('copays'), $insurance, $request->user());

        return $rs ? response()->json($rs) : response()->json(__('Error add copays to company'), 404);
    }

    public function addContractFees(
        AddContractFees $addContractFees,
        AddContractFeesRequest $request,
        InsurancePlan $insurance,
    ): JsonResponse {
        $request->validated();

        $rs = $addContractFees->invoke($request->castedCollect('contract_fees'), $insurance, $request->user());

        return $rs ? response()->json($rs) : response()->json(__('Error add contract fees to company'), 404);
    }

    public function getListResponsibilityType(): JsonResponse
    {
        return response()->json(
            $this->insurancePlanRepository->getListResponsibilityType()
        );
    }
}

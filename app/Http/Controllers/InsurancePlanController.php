<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusInsurancePlanRequest;
use App\Http\Requests\CreateInsurancePlanRequest;
use App\Http\Requests\UpdateInsurancePlanRequest;
use App\Repositories\InsurancePlanRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InsurancePlanController extends Controller
{
    private $insurancePlanRepository;

    public function __construct()
    {
        $this->insurancePlanRepository = new InsurancePlanRepository();
    }

    /**
     * @param CreateInsurancePlanRequest $request
     * @return JsonResponse
     */
    public function createInsurancePlan(CreateInsurancePlanRequest $request): JsonResponse
    {
        $rs = $this->insurancePlanRepository->createInsurancePlan($request->validated());

        return $rs ? response()->json($rs,201) : response()->json(__("Error creating insurance plan"), 400);
    }

    /**
     * @param UpdateInsurancePlanRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateInsurancePlan(UpdateInsurancePlanRequest $request,int $id): JsonResponse
    {
        $rs = $this->insurancePlanRepository->updateInsurancePlan($request->validated(),$id);

        return $rs ? response()->json($rs) : response()->json(__("Error update insurance plan"), 400);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneInsurancePlan(int $id): JsonResponse
    {
        $rs = $this->insurancePlanRepository->getOneInsurancePlan($id);

        return $rs ? response()->json($rs) : response()->json(__("Error, insurance plan not found"), 404);
    }

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function getByName(string $name): JsonResponse
    {
        $rs = $this->insurancePlanRepository->getByName($name);

        return $rs ? response()->json($rs) : response()->json(__("Error, insurance plan not found"), 404);
    }

    /**
     * @return JsonResponse
     */
    public function getAllInsurancePlans(): JsonResponse
    {
        return response()->json($this->insurancePlanRepository->getAllInsurancePlan());
    }

    /**
     *
     * @param Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function getServerAll(Request $request): JsonResponse
    {
        return $this->insurancePlanRepository->getServerAllInsurancePlan($request);
    }

    /**
     * @param ChangeStatusInsurancePlanRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusInsurancePlanRequest $request,int $id): JsonResponse
    {
        $rs = $this->insurancePlanRepository->changeStatus($request->input("status"),$id);

        return $rs ? response()->json([],204) : response()->json(__("Error, insurance plan not found"), 404);
    }

    /**
     * @param string $companyName
     * @return JsonResponse
     */
    public function getByCompany(string $companyName): JsonResponse
    {
        $rs = $this->insurancePlanRepository->getByCompany($companyName);

        return $rs ? response()->json($rs) : response()->json(__("Error, insurance plan not found"), 404);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getAllPlanByInsuranceCompany(int $id): JsonResponse
    {
        return response()->json(
            $this->insurancePlanRepository->getAllPlanByInsurancePlan($id)
        );
    }

    public function getList() {
        return response()->json(
            $this->insurancePlanRepository->getList()
        );
    }

    public function getListByCompany(int $id) {
        return response()->json(
            $this->insurancePlanRepository->getListByCompany($id)
        );
    }

    public function getListFormats() {
        return response()->json(
            $this->insurancePlanRepository->getListFormats()
        );
    }

    public function getListInsTypes() {
        return response()->json(
            $this->insurancePlanRepository->getListInsTypes()
        );
    }

    public function getListPlanTypes() {
        return response()->json(
            $this->insurancePlanRepository->getListPlanTypes()
        );
    }

    public function getListChargeUsings() {
        return response()->json(
            $this->insurancePlanRepository->getListChargeUsings()
        );
    }
}

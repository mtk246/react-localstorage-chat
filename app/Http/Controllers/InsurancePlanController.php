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
    private $InsurancePlanRepository;

    public function __construct()
    {
        $this->InsurancePlanRepository = new InsurancePlanRepository();
    }

    /**
     * @param CreateInsurancePlanRequest $request
     * @return JsonResponse
     */
    public function createInsurancePlan(CreateInsurancePlanRequest $request): JsonResponse
    {
        $rs = $this->InsurancePlanRepository->createInsurancePlan($request->validated());

        return $rs ? response()->json($rs,201) : response()->json("Error creating insurance plan",400);
    }

    /**
     * @param UpdateInsurancePlanRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateInsurancePlan(UpdateInsurancePlanRequest $request,int $id): JsonResponse
    {
        $rs = $this->InsurancePlanRepository->updateInsurancePlan($request->validated(),$id);

        return $rs ? response()->json($rs) : response()->json("Error update insurance plan",400);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneInsurancePlan(int $id): JsonResponse
    {
        $rs = $this->InsurancePlanRepository->getOneInsurancePlan($id);

        return $rs ? response()->json($rs) : response()->json("Error, insurance not found",404);
    }

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function getByName(string $name): JsonResponse
    {
        $rs = $this->InsurancePlanRepository->getByName($name);

        return $rs ? response()->json($rs) : response()->json("insurance plan not found",404);
    }

    /**
     * @return JsonResponse
     */
    public function getAllInsurancePlans(): JsonResponse
    {
        return response()->json($this->InsurancePlanRepository->getAllInsurancePlan());
    }

    /**
     * @param ChangeStatusInsurancePlanRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusInsurancePlanRequest $request,int $id): JsonResponse
    {
        $rs = $this->InsurancePlanRepository->changeStatus($request->input("status"),$id);

        return $rs ? response()->json([],204) : response()->json("Error! insurance plan not found",404);
    }

    /**
     * @param string $companyName
     * @return JsonResponse
     */
    public function getByCompany(string $companyName): JsonResponse
    {
        $rs = $this->InsurancePlanRepository->getByCompany($companyName);

        return $rs ? response()->json($rs) : response()->json("Error, insurance not found",404);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getAllPlanByInsuranceCompany(int $id): JsonResponse
    {
        return response()->json(
            $this->InsurancePlanRepository->getAllPlanByInsurancePlan($id)
        );
    }
}

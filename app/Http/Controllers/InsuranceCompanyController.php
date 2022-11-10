<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusInsuraceRequest;
use App\Http\Requests\CreateInsuranceRequest;
use App\Http\Requests\UpdateInsuranceRequest;
use App\Repositories\InsuranceCompanyRepository;
use Illuminate\Http\JsonResponse;
#use Illuminate\Http\Request;

class InsuranceCompanyController extends Controller
{
    private $InsuranceRepository;

    public function __construct(){
        $this->InsuranceRepository = new InsuranceCompanyRepository();
    }

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function getByName(string $name): JsonResponse
    {
        $rs = $this->InsuranceRepository->searchByName($name);

        return count($rs) > 0 ? response()->json($rs) : response()->json(__("Error, insurance company not found"), 404);
    }

    /**
     * @param CreateInsuranceRequest $request
     * @return JsonResponse
     */
    public function createInsurance(CreateInsuranceRequest $request): JsonResponse
    {
        $rs = $this->InsuranceRepository->createInsurance($request->validated());

        return $rs ? response()->json($rs,201) : response()->json(__("Error creating insurance company"), 400);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getOneInsurance($id): JsonResponse
    {
        $rs = $this->InsuranceRepository->getOneInsurance($id);

        return $rs ? response()->json($rs) : response()->json(__("Error, insurance company not found"), 404);
    }

    /**
     * @return JsonResponse
     */
    public function getAllInsurance(): JsonResponse
    {
        $rs = $this->InsuranceRepository->getAllInsurance();

        return response()->json($rs);
    }

    /**
     *
     * @param Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function getServerAll(Request $request): JsonResponse
    {
        return $this->InsuranceRepository->getServerAllInsurance($request);
    }

    /**
     * @param ChangeStatusInsuraceRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusInsuraceRequest $request,int $id): JsonResponse
    {
        $rs = $this->InsuranceRepository->changeStatus($request->input("status"),$id);

        return $rs ? response()->json([], 204) : response()->json(__("Error, insurance company not found"), 404);
    }

    /**
     * @param UpdateInsuranceRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateInsurance(UpdateInsuranceRequest $request,int $id): JsonResponse
    {
        $rs = $this->InsuranceRepository->updateInsurance($request->validated(),$id);

        return $rs ? response()->json($rs) : response()->json(__("Error updating insurance company"), 400);
    }

    /**
     * @param  int $id
     * @return JsonResponse
     */
    public function addToBillingCompany(int $id): JsonResponse
    {
        $rs = $this->InsuranceRepository->addToBillingCompany($id);

        return $rs ? response()->json($rs) : response()->json(__("Error add insurance company to billing company"), 404);
    }

    public function getList() {
        $rs = $this->InsuranceRepository->getList();

        return !is_null($rs) ? response()->json($rs) : response()->json([], 404);
    }
}

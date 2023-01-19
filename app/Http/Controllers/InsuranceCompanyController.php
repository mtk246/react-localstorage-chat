<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusInsuraceRequest;
use App\Http\Requests\CreateInsuranceRequest;
use App\Http\Requests\UpdateInsuranceRequest;
use App\Repositories\InsuranceCompanyRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InsuranceCompanyController extends Controller
{
    private $insuranceRepository;

    public function __construct(){
        $this->insuranceRepository = new InsuranceCompanyRepository();
    }

    /**
     * @param string $name
     * @return JsonResponse
     */
    public function getByName(string $name): JsonResponse
    {
        $rs = $this->insuranceRepository->searchByName($name);

        return count($rs) > 0 ? response()->json($rs) : response()->json(__("Error, insurance company not found"), 404);
    }

    /**
     * @param CreateInsuranceRequest $request
     * @return JsonResponse
     */
    public function createInsurance(CreateInsuranceRequest $request): JsonResponse
    {
        $rs = $this->insuranceRepository->createInsurance($request->validated());

        return $rs ? response()->json($rs,201) : response()->json(__("Error creating insurance company"), 400);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function getOneInsurance($id): JsonResponse
    {
        $rs = $this->insuranceRepository->getOneInsurance($id);

        return $rs ? response()->json($rs) : response()->json(__("Error, insurance company not found"), 404);
    }

    /**
     * @return JsonResponse
     */
    public function getAllInsurance(): JsonResponse
    {
        $rs = $this->insuranceRepository->getAllInsurance();

        return response()->json($rs);
    }

    /**
     *
     * @param Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function getServerAll(Request $request): JsonResponse
    {
        return $this->insuranceRepository->getServerAllInsurance($request);
    }

    /**
     * @param ChangeStatusInsuraceRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusInsuraceRequest $request,int $id): JsonResponse
    {
        $rs = $this->insuranceRepository->changeStatus($request->input("status"),$id);

        return $rs ? response()->json([], 204) : response()->json(__("Error, insurance company not found"), 404);
    }

    /**
     * @param UpdateInsuranceRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateInsurance(UpdateInsuranceRequest $request,int $id): JsonResponse
    {
        $rs = $this->insuranceRepository->updateInsurance($request->validated(),$id);

        return $rs ? response()->json($rs) : response()->json(__("Error updating insurance company"), 400);
    }

    /**
     * @param  int $id
     * @return JsonResponse
     */
    public function addToBillingCompany(int $id): JsonResponse
    {
        $rs = $this->insuranceRepository->addToBillingCompany($id);

        return $rs ? response()->json($rs) : response()->json(__("Error add insurance company to billing company"), 404);
    }

    public function getList() {
        return response()->json(
            $this->insuranceRepository->getList()
        );
    }

    public function getListBillingCompanies(int $insuranceCompanyId = null) {
        return response()->json(
            $this->insuranceRepository->getListBillingCompanies($insuranceCompanyId)
        );
    }

    public function getListFileMethods() {
        return response()->json(
            $this->insuranceRepository->getListFileMethods()
        );
    }

    public function getListFromTheDate() {
        return response()->json(
            $this->insuranceRepository->getListFromTheDate()
        );
    }

    public function getListBillingIncompleteReasons() {
        return response()->json(
            $this->insuranceRepository->getListBillingIncompleteReasons()
        );
    }

    public function getListAppealReasons() {
        return response()->json(
            $this->insuranceRepository->getListAppealReasons()
        );
    }
}

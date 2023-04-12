<?php

namespace App\Http\Controllers;

use App\Http\Requests\Procedure\ProcedureCreateRequest;
use App\Http\Requests\Procedure\ProcedureUpdateRequest;
use App\Http\Requests\Company\AddProcedureRequest;
use App\Http\Requests\ChangeStatusRequest;
use App\Repositories\ProcedureRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProcedureController extends Controller
{
    private $procedureRepository;

    public function __construct()
    {
        $this->procedureRepository = new ProcedureRepository();
    }
    
    /**
     * @param ProcedureCreateRequest $request
     * @return JsonResponse
     */
    public function createProcedure(ProcedureCreateRequest $request): JsonResponse
    {
        $rs = $this->procedureRepository->createProcedure($request->validated());

        return $rs ? response()->json($rs,201) : response()->json(__("Error creating procedure"), 400);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneProcedure(int $id): JsonResponse
    {
        $rs = $this->procedureRepository->getOneProcedure($id);

        return $rs ? response()->json($rs) : response()->json(__("Error, procedure not found"), 404);
    }

    /**
     * @param string
     * @return JsonResponse
     */
    public function getByCode(string $code): JsonResponse
    {
        $rs = $this->procedureRepository->getByCode($code);

        return $rs ? response()->json($rs) : response()->json(__("Error, procedure not found"), 404);
    }

    /**
     * @return JsonResponse
     */
    public function getAllProcedures(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getAllProcedures()
        );
    }

    /**
     *
     * @param Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function getServerAll(Request $request): JsonResponse
    {
        return $this->procedureRepository->getServerAllProcedures($request);
    }

    /**
     * @param ProcedureUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateProcedure(ProcedureUpdateRequest $request, int $id): JsonResponse
    {
        $rs = $this->procedureRepository->updateProcedure($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__("Error updating procedure"), 400);
    }

    /**
     * @param ChangeStatusRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusRequest $request, int $id): JsonResponse
    {
        $rs = $this->procedureRepository->changeStatus($request->input("status"), $id);

        return $rs ? response()->json([],204) : response()->json(__("Error updating status"), 400);
    }

    /**
     * @return JsonResponse
     */
    public function getListMacLocalities(Request $request): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListMacLocalities($request)
        );
    }

    /**
     * @return JsonResponse
     */
    public function getPriceOfProcedure(Request $request): JsonResponse
    {
        $rs = $this->procedureRepository->getPriceOfProcedure($request);
        return $rs ? response()->json($rs) : response()->json(__("Error price of procedure not found"), 404);
    }

    /**
     * @return JsonResponse
     */
    public function getListMac(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListMac()
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListLocalityNumber(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListLocalityNumber()
        );
    }
    /**
     * @return JsonResponse
     */
    public function getListState(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListState()
        );
    }
    /**
     * @return JsonResponse
     */
    public function getListFsa(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListFsa()
        );
    }
    /**
     * @return JsonResponse
     */
    public function getListCounties(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListCounties()
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListGenders(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListGenders()
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListDiscriminatories(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListDiscriminatories()
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListModifiers(string $code = ''): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListModifiers($code)
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListDiagnoses(Request $request, string $code = ''): JsonResponse
    {
        $except_ids = ((is_array($request->except_ids)) ? $request->except_ids : json_decode($request->except_ids)) ?? null;
        return response()->json(
            $this->procedureRepository->getListDiagnoses($request->code ?? $code, $except_ids)
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListInsuranceCompanies(int $procedure_id = null): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListInsuranceCompanies($procedure_id)
        );
    }

    /**
     * @return JsonResponse
     */
    public function getList(Request $request, int $company_id = null): JsonResponse
    {
        $search = $request->search ?? '';
        return response()->json(
            $this->procedureRepository->getList($company_id, $search, $request->except_ids ?? null)
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListInsuranceLabelFees(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListInsuranceLabelFees()
        );
    }

    /**
     * @param  int $id
     * @return JsonResponse
     */
    public function addToCompany(AddProcedureRequest $request, int $id): JsonResponse
    {
        $rs = $this->procedureRepository->addToCompany($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__("Error add procedure to company"), 404);
    }

    /**
     * @param  int $id
     * @return JsonResponse
     */
    public function getToCompany(int $id): JsonResponse
    {
        return response()->json($this->procedureRepository->getToCompany($id));
    }
}

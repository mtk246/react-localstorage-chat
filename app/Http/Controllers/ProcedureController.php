<?php

namespace App\Http\Controllers;

use App\Enums\Procedure\ProcedureType;
use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\Company\AddProcedureRequest;
use App\Http\Requests\Procedure\ProcedureConsiderationsUpdateRequest;
use App\Http\Requests\Procedure\ProcedureCreateRequest;
use App\Http\Requests\Procedure\ProcedureNoteUpdateRequest;
use App\Http\Requests\Procedure\ProcedureUpdateRequest;
use App\Http\Resources\Enums\ColorTypeResource;
use App\Http\Resources\Enums\EnumResource;
use App\Http\Resources\Procedure\ClassificationResource;
use App\Models\Procedure;
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

    public function createProcedure(ProcedureCreateRequest $request): JsonResponse
    {
        $rs = $this->procedureRepository->createProcedure($request->validated());

        return $rs ? response()->json($rs, 201) : response()->json(__('Error creating procedure'), 400);
    }

    public function getOneProcedure(int $id): JsonResponse
    {
        $rs = $this->procedureRepository->getOneProcedure($id);

        return $rs ? response()->json($rs) : response()->json(__('Error, procedure not found'), 404);
    }

    /**
     * @param string
     */
    public function getByCode(string $code): JsonResponse
    {
        $rs = $this->procedureRepository->getByCode($code);

        return $rs ? response()->json($rs) : response()->json(__('Error, procedure not found'), 404);
    }

    public function getAllProcedures(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getAllProcedures()
        );
    }

    public function getServerAll(Request $request): JsonResponse
    {
        return $this->procedureRepository->getServerAllProcedures($request);
    }

    public function updateProcedure(ProcedureUpdateRequest $request, Procedure $procedure): JsonResponse
    {
        $rs = $this->procedureRepository->updateProcedure($request->validated(), $procedure);

        return $rs ? response()->json($rs) : response()->json(__('Error updating procedure'), 400);
    }

    public function updateProcedureConsiderations(ProcedureConsiderationsUpdateRequest $request, Procedure $procedure): JsonResponse
    {
        $rs = $this->procedureRepository->updateProcedureConsiderations($procedure, $request->validated());

        return $rs ? response()->json($rs) : response()->json(__('Error updating procedure'), 400);
    }

    public function updateProcedureNote(ProcedureNoteUpdateRequest $request, Procedure $procedure): JsonResponse
    {
        $rs = $this->procedureRepository->updateProcedureNote($procedure, $request->validated()["note"]);

        return $rs ? response()->json($rs) : response()->json(__('Error updating procedure note'), 400);
    }

    public function changeStatus(ChangeStatusRequest $request, int $id): JsonResponse
    {
        $rs = $this->procedureRepository->changeStatus($request->input('status'), $id);

        return $rs ? response()->json([], 204) : response()->json(__('Error updating status'), 400);
    }

    public function getListMacLocalities(Request $request): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListMacLocalities($request)
        );
    }

    public function getPriceOfProcedure(Request $request): JsonResponse
    {
        $rs = $this->procedureRepository->getPriceOfProcedure($request);

        return $rs ? response()->json($rs) : response()->json(__('Error price of procedure not found'), 404);
    }

    public function getListMac(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListMac()
        );
    }

    public function getListLocalityNumber(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListLocalityNumber()
        );
    }

    public function getListState(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListState()
        );
    }

    public function getListFsa(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListFsa()
        );
    }

    public function getListCounties(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListCounties()
        );
    }

    public function getListGenders(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListGenders()
        );
    }

    public function getListDiscriminatories(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListDiscriminatories()
        );
    }

    public function getListModifiers(?string $code = null): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListModifiers($code)
        );
    }

    public function getListDiagnoses(Request $request, string $code = ''): JsonResponse
    {
        $except_ids = ((is_array($request->except_ids)) ? $request->except_ids : json_decode($request->except_ids)) ?? null;

        return response()->json(
            $this->procedureRepository->getListDiagnoses($request->code ?? $code, $except_ids)
        );
    }

    public function getListInsuranceCompanies(int $procedure_id = null): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListInsuranceCompanies($procedure_id)
        );
    }

    public function getList(Request $request, $company_id = null): JsonResponse
    {
        $search = $request->search ?? '';
        $companyId = str_contains($company_id ?? '', '-')
            ? explode('-', $company_id ?? '')[0]
            : $company_id ?? null;

        return response()->json(
            $this->procedureRepository->getList($companyId, $search)
        );
    }

    public function getListInsuranceLabelFees(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getListInsuranceLabelFees()
        );
    }

    public function getListInsuranceCompany(): JsonResponse
    {
        return response()->json($this->procedureRepository->getListInsuranceCompany());
    }

    public function getType(): JsonResponse
    {
        return response()->json(
            new EnumResource(collect(ProcedureType::cases()), ColorTypeResource::class)
        );
    }

    public function getClassifications(int $type): JsonResponse
    {
        return response()->json(
            new ClassificationResource($type)
        );
    }
}

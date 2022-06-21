<?php

namespace App\Http\Controllers;

use App\Http\Requests\Procedure\ProcedureCreateRequest;
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
     * @return JsonResponse
     */
    public function getAllProcedures(): JsonResponse
    {
        return response()->json(
            $this->procedureRepository->getAllProcedures()
        );
    }

    /**
     * @param ProcedureUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateProcedure(ProcedureCreateRequest $request, int $id): JsonResponse
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
}

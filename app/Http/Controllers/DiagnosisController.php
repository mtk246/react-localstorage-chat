<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\Diagnosis\DiagnosisCreateRequest;
use App\Http\Requests\Diagnosis\DiagnosisUpdateRequest;
use App\Repositories\DiagnosisRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    private $diagnosisRepository;

    public function __construct()
    {
        $this->diagnosisRepository = new DiagnosisRepository();
    }

    public function createDiagnosis(DiagnosisCreateRequest $request): JsonResponse
    {
        $rs = $this->diagnosisRepository->createDiagnosis($request->validated());

        return $rs ? response()->json($rs, 201) : response()->json(__('Error creating diagnosis'), 400);
    }

    public function getOneDiagnosis(int $id): JsonResponse
    {
        $rs = $this->diagnosisRepository->getOneDiagnosis($id);

        return $rs ? response()->json($rs) : response()->json(__('Error, diagnosis not found'), 404);
    }

    /**
     * @param string
     */
    public function getByCode(string $code): JsonResponse
    {
        $rs = $this->diagnosisRepository->getByCode($code);

        return $rs ? response()->json($rs) : response()->json(__('Error, diagnosis not found'), 404);
    }

    public function getAllDiagnoses(): JsonResponse
    {
        return response()->json(
            $this->diagnosisRepository->getAllDiagnoses()
        );
    }

    public function getServerAll(Request $request): JsonResponse
    {
        return $this->diagnosisRepository->getServerAllDiagnoses($request);
    }

    public function updateDiagnosis(DiagnosisUpdateRequest $request, int $id): JsonResponse
    {
        $rs = $this->diagnosisRepository->updateDiagnosis($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error updating diagnosis'), 400);
    }

    public function changeStatus(ChangeStatusRequest $request, int $id): JsonResponse
    {
        $rs = $this->diagnosisRepository->changeStatus($request->input('status'), $id);

        return $rs ? response()->json([], 204) : response()->json(__('Error updating status'), 400);
    }

    public function getList(): JsonResponse
    {
        return response()->json(
            $this->diagnosisRepository->getListDiagnoses()
        );
    }
}

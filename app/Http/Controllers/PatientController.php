<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientCreateRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Repositories\PatientRepository;
use Illuminate\Http\JsonResponse;
#use Illuminate\Http\Request;

class PatientController extends Controller
{
    private $patientRepository;

    public function __construct()
    {
        $this->patientRepository = new PatientRepository();
    }

    /**
     * @param PatientCreateRequest $request
     * @return JsonResponse
     */
    public function createPatient(PatientCreateRequest $request): JsonResponse
    {
        $rs = $this->patientRepository->createPatient($request->validated());

        return $rs ? response()->json($rs,201) : response()->json("Error creating patient",400);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOnePatient(int $id): JsonResponse
    {
        $rs = $this->patientRepository->getOnePatient($id);

        return $rs ? response()->json($rs) : response()->json("Patient not found",404);
    }

    /**
     * @return JsonResponse
     */
    public function getAllPatient(): JsonResponse
    {
        return response()->json(
            $this->patientRepository->getAllPatient()
        );
    }

    /**
     * @param PatientUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updatePatient(PatientUpdateRequest $request, int $id): JsonResponse
    {
        $rs = $this->patientRepository->updatePatient($request->validated(),$id);

        return $rs ? response()->json($rs) : response()->json("error updating user",400);
    }

    /**
     * @return JsonResponse
     */
    public function getAllSuscribers(string $ssn)
    {
        return response()->json(
            $this->patientRepository->getAllSuscribers($ssn)
        );
    }
}

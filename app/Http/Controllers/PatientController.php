<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientCreateRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\Patient\PatientPolicyRequest;
use App\Repositories\PatientRepository;
use Illuminate\Http\JsonResponse;

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

        return $rs ? response()->json($rs,201) : response()->json(__("Error creating patient"), 400);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getBySsn(string $ssn): JsonResponse
    {
        $rs = $this->patientRepository->getBySsn($ssn);

        return $rs ? response()->json($rs) : response()->json(__("Error, patient not found"), 404);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOnePatient(int $id): JsonResponse
    {
        $rs = $this->patientRepository->getOnePatient($id);

        return $rs ? response()->json($rs) : response()->json(__("Error, patient not found"), 404);
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
     *
     * @param Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function getServerAll(Request $request): JsonResponse
    {
        return $this->patientRepository->getServerAllPatient($request);
    }

    /**
     * @param PatientUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updatePatient(PatientUpdateRequest $request, int $id): JsonResponse
    {
        $rs = $this->patientRepository->updatePatient($request->validated(),$id);

        return $rs ? response()->json($rs) : response()->json(__("Error updating patient"), 400);
    }

    /**
     * @return JsonResponse
     */
    public function getAllSubscribers(string $ssn)
    {
        return response()->json(
            $this->patientRepository->getAllSubscribers($ssn)
        );
    }

    /**
     * @param ChangeStatusRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusRequest $request, int $id)
    {
        $rs = $this->patientRepository->changeStatus($request->input("status"), $id);

        return $rs ? response()->json([],204) : response()->json(__("Error updating status"), 404);
    }

    /**
     * @param PatientUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function addPolicy(PatientPolicyRequest $request, int $patient_id): JsonResponse
    {
        $rs = $this->patientRepository->addPolicy($request->validated(), $patient_id);

        return $rs ? response()->json($rs) : response()->json(__("Error add policy to patient"), 400);
    }

    /**
     * @param PatientUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function removePolicy(int $patient_id, int $insurance_policy_id): JsonResponse
    {
        $rs = $this->patientRepository->removePolicy($insurance_policy_id, $patient_id);

        return $rs ? response()->json($rs) : response()->json(__("Error remove policy to patient"), 400);
    }

    /**
     * @param PatientUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function getPolicy(int $patient_id, int $insurance_policy_id): JsonResponse
    {
        $rs = $this->patientRepository->getPolicy($insurance_policy_id, $patient_id);

        return $rs ? response()->json($rs) : response()->json(__("Error, policy to patient not found"), 400);
    }

    public function getPolicies(int $patient_id): JsonResponse
    {
        return response()->json(
            $this->patientRepository->getPolicies($patient_id)
        );
    }

    /**
     * @param PatientUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function editPolicy(PatientPolicyRequest $request, int $patient_id, int $insurance_policy_id)
    {
        $rs = $this->patientRepository->editPolicy($request->validated(), $insurance_policy_id, $patient_id);

        return $rs ? response()->json($rs) : response()->json(__("Error, edit policy to patient"), 400);
    }
}

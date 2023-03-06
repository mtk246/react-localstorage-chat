<?php

namespace App\Http\Controllers;

use App\Http\Requests\Patient\AddCompaniesRequest;
use App\Http\Requests\Patient\CreateRequest;
use App\Http\Requests\Patient\UpdateRequest;
use App\Http\Requests\Patient\PolicyRequest;
use App\Http\Requests\Patient\ChangeStatusPolicyRequest;
use App\Http\Requests\ChangeStatusRequest;
use App\Http\Requests\ValidateSearchRequest;
use App\Repositories\PatientRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    private $patientRepository;

    public function __construct()
    {
        $this->patientRepository = new PatientRepository();
    }

    /**
     * @param CreateRequest $request
     * @return JsonResponse
     */
    public function createPatient(CreateRequest $request): JsonResponse
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
     * @param UpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updatePatient(UpdateRequest $request, int $id): JsonResponse
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
     * @param UpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function addPolicy(PolicyRequest $request, int $patient_id): JsonResponse
    {
        $rs = $this->patientRepository->addPolicy($request->validated(), $patient_id);

        return $rs ? response()->json($rs) : response()->json(__("Error add policy to patient"), 400);
    }

    /**
     * @param UpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function removePolicy(int $patient_id, int $insurance_policy_id): JsonResponse
    {
        $rs = $this->patientRepository->removePolicy($insurance_policy_id, $patient_id);

        return $rs ? response()->json($rs) : response()->json(__("Error remove policy to patient"), 400);
    }

    /**
     * @param UpdateRequest $request
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
     * @param UpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function editPolicy(PolicyRequest $request, int $patient_id, int $insurance_policy_id)
    {
        $rs = $this->patientRepository->editPolicy($request->validated(), $insurance_policy_id, $patient_id);

        return $rs ? response()->json($rs) : response()->json(__("Error, edit policy to patient"), 400);
    }

    /**
     * @param ChangeStatusPolicyRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatusPolicy(ChangeStatusPolicyRequest $request, int $patient_id, int $insurance_policy_id)
    {
        $rs = $this->patientRepository->changeStatusPolicy($request->validated(), $insurance_policy_id, $patient_id);

        return $rs ? response()->json([],204) : response()->json(__("Error updating status policy"), 404);
    }

    /**
     * @return JsonResponse
     */
    public function getList(Request $request): JsonResponse
    {
        return response()->json(
            $this->patientRepository->getList($request)
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListMaritalStatus(): JsonResponse
    {
        return response()->json(
            $this->patientRepository->getListMaritalStatus()
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListAddressType(): JsonResponse
    {
        return response()->json(
            $this->patientRepository->getListAddressType()
        );
    }

    /**
     * @return JsonResponse
     */
    public function getListInsurancePolicyType(): JsonResponse
    {
        return response()->json(
            $this->patientRepository->getListInsurancePolicyType()
        );
    }

    public function getListRelationship(): JsonResponse
    {
        return response()->json(
            $this->patientRepository->getListRelationship()
        );
    }

    public function getListResponsibilityType(): JsonResponse
    {
        return response()->json(
            $this->patientRepository->getListResponsibilityType()
        );
    }

    /**
     * @param string $ssn
     * @return JsonResponse
     */
    public function search(ValidateSearchRequest $request): JsonResponse
    {
        $rs = $this->patientRepository->search($request);
        return ($rs) ? response()->json($rs) : response()->json(__("Error, patient not found"), 404);
    }

    public function addCompanies(AddCompaniesRequest $request, int $patient_id): JsonResponse
    {
        $rs = $this->patientRepository->addCompanies($request->validated(), $patient_id);

        return $rs ? response()->json($rs) : response()->json(__("Error add companies to patient"), 400);
    }
}

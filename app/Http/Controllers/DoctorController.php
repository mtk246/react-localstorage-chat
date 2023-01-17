<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\DoctorChangeStatusRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Requests\HealthProfessional\UpdateCompaniesRequest;
use App\Repositories\DoctorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private $doctorRepository;

    public function  __construct()
    {
        $this->doctorRepository = new DoctorRepository();
    }

    /**
     * @param CreateDoctorRequest $request
     * @return JsonResponse
     */
    public function createDoctor(CreateDoctorRequest $request): JsonResponse
    {
        $rs = $this->doctorRepository->createDoctor($request->validated());

        return $rs ? response()->json($rs,201) : response()->json(__("Error creating health professional"), 400);
    }

    /**
     * @param UpdateDoctorRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateDoctor(UpdateDoctorRequest $request,int $id): JsonResponse
    {
        $rs = $this->doctorRepository->updateDoc($request->validated(),$id);

        return $rs ? response()->json($rs) : response()->json(__("Error, health professional not found"), 404);
    }

    /**
     * @return JsonResponse
     */
    public function getAllDoctors(): JsonResponse
    {
        return response()->json($this->doctorRepository->getAllDoctors());
    }

    /**
     *
     * @param Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function getServerAll(Request $request): JsonResponse
    {
        return $this->doctorRepository->getServerAllDoctors($request);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneDoctor(int $id): JsonResponse
    {
        $rs = $this->doctorRepository->getOneDoctor($id);

        return $rs ? response()->json($rs) : response()->json(__("Error, health professional not found"), 404);
    }

    /**
     * @param string $npi
     * @return JsonResponse
     */
    public function getOneByNpi(string $npi): JsonResponse
    {
        $rs = $this->doctorRepository->getOneByNpi($npi);

        return $rs ? response()->json($rs) : response()->json(__("Error, health professional not found"), 404);
    }

    /**
     * @param DoctorChangeStatusRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(DoctorChangeStatusRequest $request,int $id): JsonResponse
    {
        $rs = $this->doctorRepository->changeStatus($request->input("status"),$id);

        return $rs ? response()->json([],204) : response()->json(__("Error updating status"), 404);
    }

    public function getListTypes()
    {
        $rs = $this->doctorRepository->getListTypes();

        return $rs ? response()->json($rs) : response()->json(__("Error get all health professional types"), 400);
    }

    public function getListAuthorizations()
    {
        $rs = $this->doctorRepository->getListAuthorizations();

        return $rs ? response()->json($rs) : response()->json(__("Error get all authorizations"), 400);
    }

    public function getListBillingCompanies(int $healthProfessionalId = null) {
        $rs = $this->doctorRepository->getListBillingCompanies($healthProfessionalId);

        return response()->json($rs);
    }

    /**
     * @param UpdateDoctorRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateCompanies(UpdateCompaniesRequest $request, int $id): JsonResponse
    {
        $rs = $this->doctorRepository->updateCompanies($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__("Error, update companies/providers by health professional"), 404);
    }
}

<?php

namespace App\Http\Controllers;

use App\Actions\HealthProfessional\GetDoctorAction;
use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\DoctorChangeStatusRequest;
use App\Http\Requests\HealthProfessional\UpdateCompaniesRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Http\Resources\HealthProfessional\HealthProfessionalNpiResource;
use App\Models\HealthProfessional;
use App\Repositories\DoctorRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Actions\GetAPIAction;
use Illuminate\Support\Facades\Gate;

class DoctorController extends Controller
{
    private $doctorRepository;

    public function __construct()
    {
        $this->doctorRepository = new DoctorRepository();
    }

    public function createDoctor(CreateDoctorRequest $request): JsonResponse
    {
        $rs = $this->doctorRepository->createDoctor($request->validated());

        return $rs ? response()->json($rs, 201) : response()->json(__('Error creating health professional'), 400);
    }

    public function updateDoctor(UpdateDoctorRequest $request, int $id): JsonResponse
    {
        $rs = $this->doctorRepository->updateDoc($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error, health professional not found'), 404);
    }

    public function getAllDoctors(): JsonResponse
    {
        return response()->json($this->doctorRepository->getAllDoctors());
    }

    public function getServerAll(Request $request): JsonResponse
    {
        return $this->doctorRepository->getServerAllDoctors($request);
    }

    public function getOneDoctor(
        Request $request,
        HealthProfessional $doctor,
        GetDoctorAction $getDoctor
    ): JsonResponse {
        return response()->json($getDoctor->single($doctor, $request->user()));
    }

    public function getOneByNpi(string $npi, GetAPIAction $APIAction): JsonResponse
    {
        $apiResponse = $APIAction->getByNPI($npi);
        $rs = $this->doctorRepository->getOneByNpi($npi);

        if ($rs) {
            if (isset($rs['result']) && $rs['result']) {
                return response()->json(HealthProfessionalNpiResource::make(['data' => $rs['data'], 'api' => $apiResponse, 'type' => 'public']), 200);
            } else {
                if (Gate::check('is-admin')) {
                    return response()->json(__('Forbidden, The health porfessional has already been associated with all the billing companies'), 403);
                } else {
                    return response()->json(__('Forbidden, The health porfessional has already been associated with the billing company'), 403);
                }
            }
        } else {
            if ($apiResponse) {
                return ('NPI-1' === $apiResponse->enumeration_type)
                    ? response()->json(HealthProfessionalNpiResource::make(['api' => $apiResponse, 'type' => 'api']), 200)
                    : response()->json(__('Error, The entered NPI does not belong to a facility but to a health care professional, please verify it and enter a valid NPI.'), 404);
            }

            return response()->json(__('Error, The NPI doesn`t exist, verify that it`s a valid NPI by NPPES.'), 404);
        }
    }

    public function changeStatus(DoctorChangeStatusRequest $request, int $id): JsonResponse
    {
        $rs = $this->doctorRepository->changeStatus($request->input('status'), $id);

        return $rs ? response()->json([], 204) : response()->json(__('Error updating status'), 404);
    }

    public function getListTypes()
    {
        $rs = $this->doctorRepository->getListTypes();

        return $rs ? response()->json($rs) : response()->json(__('Error get all health professional types'), 400);
    }

    public function getListAuthorizations()
    {
        $rs = $this->doctorRepository->getListAuthorizations();

        return $rs ? response()->json($rs) : response()->json(__('Error get all authorizations'), 400);
    }

    public function getListBillingCompanies(Request $request)
    {
        $rs = $this->doctorRepository->getListBillingCompanies($request);

        return response()->json($rs);
    }

    public function getList(Request $request)
    {
        $rs = $this->doctorRepository->getList($request);

        return response()->json($rs);
    }

    /**
     * @param UpdateDoctorRequest $request
     */
    public function updateCompanies(UpdateCompaniesRequest $request, int $id): JsonResponse
    {
        $rs = $this->doctorRepository->updateCompanies($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error, update companies/providers by health professional'), 404);
    }
}

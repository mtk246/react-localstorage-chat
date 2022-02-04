<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDoctorRequest;
use App\Http\Requests\UpdateDoctorRequest;
use App\Repositories\DoctorRepository;
use Illuminate\Http\JsonResponse;
#use Illuminate\Http\Request;

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

        return $rs ? response()->json($rs,201) : response()->json("Error creating doctor",400);
    }

    /**
     * @param UpdateDoctorRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateDoctor(UpdateDoctorRequest $request,int $id): JsonResponse
    {
        $rs = $this->doctorRepository->updateDoc($request->validated(),$id);

        return $rs ? response()->json($rs) : response()->json("Doctor not found",404);
    }

    /**
     * @return JsonResponse
     */
    public function getAllDoctors(): JsonResponse
    {
        return response()->json($this->doctorRepository->getAllDoctors());
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneDoctor(int $id): JsonResponse
    {
        $rs = $this->doctorRepository->getOneDoctor($id);

        return $rs ? response()->json($rs) : response()->json("doctor not found",404);
    }

    /**
     * @param string $npi
     * @return JsonResponse
     */
    public function getByNpi(string $npi): JsonResponse
    {
        $rs = $this->doctorRepository->getOneByNpi($npi);

        return $rs ? response()->json($rs) : response()->json("doctor not found",404);
    }
}

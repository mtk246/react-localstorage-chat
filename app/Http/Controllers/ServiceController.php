<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\CreateServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Http\Requests\ChangeStatusRequest;
use App\Repositories\ServiceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private $serviceRepository;

    public function __construct()
    {
        $this->serviceRepository = new ServiceRepository();
    }

    /**
     * @param serviceCreateRequest $request
     * @return JsonResponse
     */
    public function create(CreateServiceRequest $request)
    {
        $rs = $this->serviceRepository->create($request->validated());

        return $rs ? response()->json($rs) : response()->json("Error creating service", 400);
    }

    /**
     * @return JsonResponse
     */
    public function getAllServices()
    {
        return response()->json(
            $this->serviceRepository->getAllServices()
        );
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function getOneService(int $id)
    {
        $rs = $this->serviceRepository->getOneService($id);

        return $rs ? response()->json($rs) : response()->json("service not found",404);
    }

    /**
     * @param UpdateServiceRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateServiceRequest $request, int $id)
    {
        $rs = $this->serviceRepository->updateService($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json("Error updating service",400);
    }

    /**
     * @param ChangeStatus $request
     * @param int $id
     * @return JsonResponse
     */
    public function changeStatus(ChangeStatusRequest $request, int $id)
    {
        $rs = $this->serviceRepository->changeStatus($request->input("status"), $id);

        return $rs ? response()->json([], 204) : response()->json("Error, service not found", 404);
    }

    public function getAllServiceApplicableTo()
    {
        $rs = $this->serviceRepository->getAllServiceApplicableTo();

        return $rs ? response()->json($rs) : response()->json("Error get all service applicable to", 400);

    }

    public function getAllServiceGroups()
    {
        $rs = $this->serviceRepository->getAllServiceGroups();

        return $rs ? response()->json($rs) : response()->json("Error get all service groups", 400);

    }

    public function getAllServiceRevCenters()
    {
        $rs = $this->serviceRepository->getAllServiceRevCenters();

        return $rs ? response()->json($rs) : response()->json("Error get all service rev centers", 400);

    }

    public function getAllServiceTypes()
    {
        $rs = $this->serviceRepository->getAllServiceTypes();

        return $rs ? response()->json($rs) : response()->json("Error get all service types", 400);

    }

    public function getAllServiceTypeOfServices()
    {
        $rs = $this->serviceRepository->getAllServiceTypeOfServices();

        return $rs ? response()->json($rs) : response()->json("Error get all service type of service", 400);

    }

    public function getAllServiceStmtDescriptions()
    {
        $rs = $this->serviceRepository->getAllServiceStmtDescriptions();

        return $rs ? response()->json($rs) : response()->json("Error get all service stmt descriptions", 400);

    }

    public function getAllServiceSpecialInstructions()
    {
        $rs = $this->serviceRepository->getAllServiceSpecialInstructions();

        return $rs ? response()->json($rs) : response()->json("Error get all service special instruction", 400);

    }

}

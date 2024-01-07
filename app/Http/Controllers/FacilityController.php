<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeStatusFacilityRequest;
use App\Http\Requests\FacilityCreateRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Repositories\FacilityRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Facility\AddCompanyRequest;
use App\Http\Requests\Facility\RemoveCompanyRequest;
use App\Models\Facility;
use App\Models\FacilityType;
use App\Http\Resources\Facility\BillClassificationResource;
use App\Actions\GetAPIAction;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\Facility\FacilityResource;

class FacilityController extends Controller
{
    private $facilityRepository;

    public function __construct()
    {
        $this->facilityRepository = new FacilityRepository();
    }

    public function create(FacilityCreateRequest $request): JsonResponse
    {
        $rs = $this->facilityRepository->create($request->validated());

        return $rs ? response()->json($rs, 201) : response()->json(__('Error creating facility'), 400);
    }

    public function getListFacilityTypes(): JsonResponse
    {
        return response()->json(
            $this->facilityRepository->getListFacilityTypes()
        );
    }

    public function getList(Request $request): JsonResponse
    {
        return response()->json(
            $this->facilityRepository->getList($request)
        );
    }

    public function getAllFacilities(): JsonResponse
    {
        return response()->json(
            $this->facilityRepository->getAllFacilities()
        );
    }

    public function getServerAll(Request $request): JsonResponse
    {
        return $this->facilityRepository->getServerAllFacilities($request);
    }

    public function getAllByCompany($company_id): JsonResponse
    {
        return response()->json(
            $this->facilityRepository->getAllByCompany($company_id)
        );
    }

    public function getOneFacility(int $id): JsonResponse
    {
        $rs = $this->facilityRepository->getOneFacility($id);

        return $rs ? response()->json($rs) : response()->json(__('Error, facility not found'), 404);
    }

    public function updateFacility(UpdateFacilityRequest $request, int $id): JsonResponse
    {
        $rs = $this->facilityRepository->updateFacility($request->validated(), $id);

        return $rs ? response()->json($rs) : response()->json(__('Error updating facility'), 400);
    }

    public function getByName(string $name): JsonResponse
    {
        $rs = $this->facilityRepository->getByName($name);

        return $rs ? response()->json($rs) : response()->json(__('Error, facility not found'), 404);
    }

    public function getOneByNpi(string $npi, GetAPIAction $APIAction): JsonResponse
    {
        $apiResponse = $APIAction->getByNPI($npi);
        $rs = $this->facilityRepository->getOneByNpi($npi);

        if ($rs) {
            if (isset($rs['result']) && $rs['result']) {
                return response()->json(FacilityResource::make(['data' => $rs['data'], 'api' => $apiResponse, 'type' => 'public']), 200);
            } else {
                if (Gate::check('is-admin')) {
                    return response()->json(__('Forbidden, The facility has already been associated with all the billing companies'), 403);
                } else {
                    return response()->json(__('Forbidden, The facility has already been associated with the billing company'), 403);
                }
            }
        } else {
            if ($apiResponse) {
                return ('NPI-2' === $apiResponse->enumeration_type)
                    ? response()->json(FacilityResource::make(['api' => $apiResponse, 'type' => 'api']), 200)
                    : response()->json(__('Error, The entered NPI does not belong to a facility but to a health care professional, please verify it and enter a valid NPI.'), 404);
            }

            return response()->json(__('Error, The NPI doesn`t exist, verify that it`s a valid NPI by NPPES.'), 404);
        }
    }

    public function getListBillingCompanies(Request $request)
    {
        $rs = $this->facilityRepository->getListBillingCompanies($request);

        return !is_null($rs) ? response()->json($rs) : response()->json([], 404);
    }

    public function changeStatus(ChangeStatusFacilityRequest $request, int $id): JsonResponse
    {
        $rs = $this->facilityRepository->changeStatus($request->input('status'), $id);

        return $rs ? response()->json([], 204) : response()->json(__('Error updating status'), 404);
    }

    public function addToBillingCompany(int $id): JsonResponse
    {
        $rs = $this->facilityRepository->addToBillingCompany($id);

        return $rs ? response()->json($rs) : response()->json(__('Error add facility to billing company'), 404);
    }

    /**
     * @param int $id
     */
    public function addToCompany(Facility $facility, AddCompanyRequest $request): JsonResponse
    {
        $rs = $this->facilityRepository->addToCompany($facility, $request->validated());

        return $rs ? response()->json($rs) : response()->json(__('Error add facility to company'), 404);
    }

    public function getBillClassifiations(FacilityType $facilityType)
    {
        return response()->json(
            BillClassificationResource::collection($facilityType->billClasifications()->distinct('name')->get())
        );
    }
}

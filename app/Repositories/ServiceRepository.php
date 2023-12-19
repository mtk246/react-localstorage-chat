<?php

namespace App\Repositories;

use App\Models\InsurancePlan;
use App\Models\InsurancePlanService;
use App\Models\InsurancePlanServiceAliance;
use App\Models\PrivateNote;
use App\Models\PublicNote;
use App\Models\Service;
use App\Models\ServiceApplicableTo;
use App\Models\ServiceGroup;
use App\Models\ServiceRevCenter;
use App\Models\ServiceSpecialInstruction;
use App\Models\ServiceStmtDescription;
use App\Models\ServiceType;
use App\Models\ServiceTypeOfService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceRepository
{
    /**
     * @return Service|Model
     */
    public function create(array $data)
    {
        try {
            DB::beginTransaction();

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()?->billingCompanies->first();
            }

            $service = Service::create([
                'code' => generateNewCode(getPrefix($data['name']), 5, date('Y'), Service::class, 'code'),
                'name' => $data['name'],
                'description' => $data['description'],
                'service_group_1_id' => $data['service_group_1_id'],
                'service_group_2_id' => $data['service_group_2_id'],
                'service_type_id' => $data['service_type_id'],
                'service_applicable_to_id' => $data['service_applicable_to_id'],
                'service_type_of_service_id' => $data['service_type_of_service_id'],
                'service_rev_center_id' => $data['service_rev_center_id'],
                'service_stmt_description_id' => $data['service_stmt_description_id'],
                'service_special_instruction_id' => $data['service_special_instruction_id'],
                'rev_code' => $data['rev_code'],
                'use_time_units' => $data['use_time_units'],
                'ndc_number' => $data['ndc_number'],
                'units' => $data['units'],
                'measure' => $data['measure'],
                'units_limit' => $data['units_limit'],
                'requires_claim_note' => $data['requires_claim_note'],
                'requires_supervisor' => $data['requires_supervisor'],
                'requires_authorization' => $data['requires_authorization'],
                'std_price' => $data['std_price'],
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
                'company_id' => $data['company_id'],
            ]);

            /* Create Insurance Plan Services */
            if (isset($data['insurance_plan_services'])) {
                foreach ($data['insurance_plan_services'] as $insurance_plan_service) {
                    $insurance_plan = InsurancePlan::find($insurance_plan_service['insurance_plan_id']);
                    /** Attached insurance plan to service */
                    $insurancePlanService = InsurancePlanService::create([
                        'insurance_plan_id' => $insurance_plan->id,
                        'service_id' => $service->id,
                        'price' => $insurance_plan_service['price'],
                        'percentage' => $insurance_plan_service['percentage'],
                        'aliance' => $insurance_plan_service['aliance'],
                    ]);

                    /* Attached insurance plan service to aliance */
                    if ($insurance_plan_service['aliance']) {
                        $aliance = $insurance_plan_service['insurance_plan_service_aliance'];
                        InsurancePlanServiceAliance::create([
                            'price' => $aliance['price'],
                            'percentage' => $aliance['percentage'],
                            'insurance_plan_service_id' => $insurancePlanService->id,
                        ]);
                    }
                }
            }

            if (isset($data['public_note'])) {
                /* PublicNote */
                PublicNote::create([
                    'publishable_type' => Service::class,
                    'publishable_id' => $service->id,
                    'note' => $data['public_note'],
                ]);
            }

            if (isset($data['private_note'])) {
                /* PrivateNote */
                PrivateNote::updateOrCreate([
                    'publishable_type' => Service::class,
                    'publishable_id' => $service->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'note' => $data['private_note'],
                ]);
            }

            DB::commit();

            return $service;
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @return Service[]|Collection
     */
    public function getAllServices()
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $services = Service::with([
                'insurancePlanServices' => function ($query) {
                    $query->with('insurancePlan');
                },
                'publicNote',
                'privateNotes',
                'company',
                'billingCompany',
                'serviceApplicableTo',
                'serviceGroup1',
                'serviceGroup2',
                'serviceType',
                'serviceTypeOfService',
                'serviceRevCenter',
                'serviceStmtDescription',
                'serviceSpecialInstruction',
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        } else {
            $services = Service::with([
                'insurancePlanServices' => function ($query) {
                    $query->with('insurancePlan');
                },
                'publicNote',
                'privateNotes',
                'company',
                'billingCompany',
                'serviceApplicableTo',
                'serviceGroup1',
                'serviceGroup2',
                'serviceType',
                'serviceTypeOfService',
                'serviceRevCenter',
                'serviceStmtDescription',
                'serviceSpecialInstruction',
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        }

        return !is_null($services) ? $services : null;
    }

    /**
     * @return Service|Builder|Model|object|null
     */
    public function getOneService(int $id)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $service = Service::whereId($id)->with([
                'insurancePlanServices' => function ($query) {
                    $query->with('insurancePlan');
                },
                'publicNote',
                'privateNotes',
                'company',
                'billingCompany',
                'serviceApplicableTo',
                'serviceGroup1',
                'serviceGroup2',
                'serviceType',
                'serviceTypeOfService',
                'serviceRevCenter',
                'serviceStmtDescription',
                'serviceSpecialInstruction',
            ])->first();
        } else {
            $service = Service::whereId($id)->with([
                'insurancePlanServices' => function ($query) {
                    $query->with('insurancePlan');
                },
                'publicNote',
                'privateNotes',
                'company',
                'billingCompany',
                'serviceApplicableTo',
                'serviceGroup1',
                'serviceGroup2',
                'serviceType',
                'serviceTypeOfService',
                'serviceRevCenter',
                'serviceStmtDescription',
                'serviceSpecialInstruction',
            ])->first();
        }

        return !is_null($service) ? $service : null;
    }

    /**
     * @return Service|Builder|Model|object|null
     */
    public function updateService(array $data, int $id)
    {
        try {
            DB::beginTransaction();

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()?->billingCompanies->first();
            }

            $service = Service::find($id);

            $service->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'service_group_1_id' => $data['service_group_1_id'],
                'service_group_2_id' => $data['service_group_2_id'],
                'service_type_id' => $data['service_type_id'],
                'service_applicable_to_id' => $data['service_applicable_to_id'],
                'service_type_of_service_id' => $data['service_type_of_service_id'],
                'service_rev_center_id' => $data['service_rev_center_id'],
                'service_stmt_description_id' => $data['service_stmt_description_id'],
                'service_special_instruction_id' => $data['service_special_instruction_id'],
                'rev_code' => $data['rev_code'],
                'use_time_units' => $data['use_time_units'],
                'ndc_number' => $data['ndc_number'],
                'units' => $data['units'],
                'measure' => $data['measure'],
                'units_limit' => $data['units_limit'],
                'requires_claim_note' => $data['requires_claim_note'],
                'requires_supervisor' => $data['requires_supervisor'],
                'requires_authorization' => $data['requires_authorization'],
                'std_price' => $data['std_price'],
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
                'company_id' => $data['company_id'],
            ]);

            /* Insurance Plan Service */
            if (isset($data['insurance_plan_services'])) {
                /** Delete insurancePlanServices */
                $insurancePlanServices = $service->insurancePlanServices;
                foreach ($insurancePlanServices as $insurancePlanService) {
                    $insAliance = InsurancePlanServiceAliance::where('insurance_plan_service_id', $insurancePlanService->id)->first();
                    if ($insAliance) {
                        $insAliance->delete();
                    }
                    $insurancePlanService->delete();
                }

                /* Update Insurance Plan Services */
                foreach ($data['insurance_plan_services'] as $insurance_plan_service) {
                    $insurance_plan = InsurancePlan::find($insurance_plan_service['insurance_plan_id']);
                    /** Attached insurance plan to service */
                    $insurancePlanService = InsurancePlanService::create([
                        'insurance_plan_id' => $insurance_plan->id,
                        'service_id' => $service->id,
                        'price' => $insurance_plan_service['price'],
                        'percentage' => $insurance_plan_service['percentage'],
                        'aliance' => $insurance_plan_service['aliance'],
                    ]);

                    /* Attached insurance plan service to aliance */

                    if ($insurance_plan_service['aliance']) {
                        $aliance = $insurance_plan_service['insurance_plan_service_aliance'];
                        InsurancePlanServiceAliance::create([
                            'price' => $aliance['price'],
                            'percentage' => $aliance['percentage'],
                            'insurance_plan_service_id' => $insurancePlanService->id,
                        ]);
                    }
                }
            }

            if (isset($data['public_note'])) {
                /* PublicNote */
                PublicNote::updateOrCreate([
                    'publishable_type' => Service::class,
                    'publishable_id' => $service->id,
                ],
                    [
                        'note' => $data['public_note'],
                    ]);
            }

            if (isset($data['private_note'])) {
                /* PrivateNote */
                PrivateNote::updateOrCreate([
                    'publishable_type' => Service::class,
                    'publishable_id' => $service->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'note' => $data['private_note'],
                ]);
            }

            DB::commit();

            return $service;
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @return bool|int
     */
    public function changeStatus(bool $status, int $id)
    {
        try {
            $service = Service::whereId($id)->update(['status' => $status]);

            return $service;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getAllServiceApplicableTo()
    {
        return getList(ServiceApplicableTo::class, 'applicable_to');
    }

    public function getAllServiceGroups()
    {
        return getList(ServiceGroup::class, 'group');
    }

    public function getAllServiceRevCenters()
    {
        return getList(ServiceRevCenter::class, 'rev_center');
    }

    public function getAllServiceTypes()
    {
        return getList(ServiceType::class, 'type');
    }

    public function getAllServiceTypeOfServices()
    {
        return getList(ServiceTypeOfService::class, 'type_of_service');
    }

    public function getAllServiceStmtDescriptions()
    {
        return getList(ServiceStmtDescription::class, 'stmt_description');
    }

    public function getAllServiceSpecialInstructions()
    {
        return getList(ServiceSpecialInstruction::class, 'special_instruction');
    }
}

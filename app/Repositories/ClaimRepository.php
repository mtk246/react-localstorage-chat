<?php

namespace App\Repositories;

use App\Http\Resources\ClaimResource;
use App\Models\BillingCompany;
use App\Models\Claim;
use App\Models\ClaimCheckStatus;
use App\Models\ClaimDateInformation;
use App\Models\ClaimEligibility;
use App\Models\ClaimEligibilityStatus;
use App\Models\ClaimFormP;
use App\Models\ClaimFormPService;
use App\Models\ClaimStatus;
use App\Models\ClaimStatusClaim;
use App\Models\ClaimSubStatus;
use App\Models\ClaimTransmissionResponse;
use App\Models\ClaimTransmissionStatus;
use App\Models\ClaimValidation;
use App\Models\Company;
use App\Models\Injury;
use App\Models\Patient;
use App\Models\PatientOrInsuredInformation;
use App\Models\PhysicianOrSupplierInformation;
use App\Models\PlaceOfService;
use App\Models\PrivateNote;
use App\Models\Procedure;
use App\Models\PublicNote;
use App\Models\TypeCatalog;
use App\Models\TypeDiag;
use App\Models\TypeForm;
use App\Models\TypeOfService;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ClaimRepository
{
    /**
     * @return claim|Model
     */
    public function createClaim(array $data)
    {
        try {
            DB::beginTransaction();
            $newCode = 1;
            $targetModel = Claim::select('id', 'control_number')->orderBy('created_at', 'desc')->orderBy('id', 'desc')->first();

            $newCode += ($targetModel) ? (int) $targetModel->control_number : 0;
            $newCode = str_pad($newCode, 9, '0', STR_PAD_LEFT);

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'] ?? null;
            } else {
                $billingCompany = auth()->user()?->billingCompanies->first();
            }

            if (isset($data['format'])) {
                $typeFormat = TypeForm::find($data['format']);
                if (isset($typeFormat)) {
                    if ('CMS-1500 / 837P' == $typeFormat->form) {
                        $model = ClaimFormP::class;
                        if (isset($data['claim_services'])) {
                            $claimForm = ClaimFormP::create([
                                'type_form_id' => $data['format'] ?? null,
                                'billing_company_id' => $billingCompany->id ?? $billingCompany,
                            ]);
                            $claimForm->claimFormServices()->delete();
                            foreach ($data['claim_services'] as $service) {
                                $service['claim_form_p_id'] = $claimForm->id;
                                ClaimFormPService::create($service);
                            }
                        }
                        if (isset($data['patient_or_insured_information'])) {
                            PatientOrInsuredInformation::updateOrCreate([
                                'claim_form_p_id' => $claimForm->id,
                            ], $data['patient_or_insured_information']);
                        }
                        if (isset($data['physician_or_supplier_information'])) {
                            $physician = PhysicianOrSupplierInformation::updateOrCreate([
                                'claim_form_p_id' => $claimForm->id,
                            ], $data['physician_or_supplier_information']);

                            if (isset($data['physician_or_supplier_information']['claim_date_informations'])) {
                                foreach ($data['physician_or_supplier_information']['claim_date_informations'] ?? [] as $dateInf) {
                                    $dateInf['physician_or_supplier_information_id'] = $physician->id;
                                    ClaimDateInformation::updateOrCreate([
                                        'id' => $dateInf->id ?? null,
                                    ], $dateInf);
                                }
                            }
                        }
                    } else {
                        $model = ClaimFormP::class;
                        if (isset($data['claim_services'])) {
                            $claimForm = ClaimFormP::create([
                                'type_form_id' => $data['format'] ?? null,
                                'type_of_medical_assistance' => $data['type_of_medical_assistance'] ?? null,
                                'billing_company_id' => $billingCompany->id ?? $billingCompany,
                            ]);
                            $claimForm->claimFormServices()->delete();
                            foreach ($data['claim_services'] as $service) {
                                $service['days_or_units'] = $service['units_of_service'];
                                $service['claim_form_p_id'] = $claimForm->id;
                                ClaimFormPService::create($service);
                            }
                        }
                        PatientOrInsuredInformation::updateOrCreate([
                            'claim_form_p_id' => $claimForm->id,
                        ], [
                            'employment_related_condition' => $data['employment_related_condition'],
                            'auto_accident_related_condition' => $data['auto_accident_related_condition'],
                            'auto_accident_place_state' => $data['auto_accident_place_state'] ?? null,
                            'other_accident_related_condition' => $data['other_accident_related_condition'],
                            'patient_signature' => $data['patient_signature'],
                            'insured_signature' => $data['insured_signature'],
                        ]);
                        if (isset($data['additional_information'])) {
                            $data['additional_information']['prior_authorization_number'] = $data['prior_authorization_number'];
                            $data['additional_information']['outside_lab'] = $data['outside_lab'];
                            $data['additional_information']['charges'] = $data['charges'] ?? null;
                            $data['additional_information']['accept_assignment'] = $data['accept_assignment'];
                            $additional = PhysicianOrSupplierInformation::updateOrCreate([
                                'claim_form_p_id' => $claimForm->id,
                            ], $data['additional_information']);

                            if (isset($data['additional_information']['claim_date_informations'])) {
                                foreach ($data['additional_information']['claim_date_informations'] ?? [] as $dateInf) {
                                    ClaimDateInformation::updateOrCreate([
                                        'id' => $dateInf['id'] ?? null,
                                    ], [
                                        'from_date_or_current' => $dateInf['from_date'],
                                        'to_date' => $dateInf['to_date'],
                                        'field_id' => $dateInf['field_id'],
                                        'qualifier_id' => $dateInf['qualifier_id'],
                                        'through' => $dateInf['through'],
                                        'amount' => $dateInf['amount'],
                                        'physician_or_supplier_information_id' => $additional->id,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }

            $claim = Claim::create([
                'control_number' => $newCode,
                'company_id' => $data['company_id'] ?? null,
                'facility_id' => $data['facility_id'] ?? null,
                'patient_id' => $data['patient_id'] ?? null,
                'billing_provider_id' => $data['billing_provider_id'] ?? null,
                'service_provider_id' => $data['service_provider_id'] ?? null,
                'referred_id' => $data['referred_id'] ?? null,
                'referred_provider_role_id' => $data['referred_provider_role_id'] ?? null,
                'validate' => $data['validate'] ?? false,
                'automatic_eligibility' => $data['automatic_eligibility'] ?? false,
                'claim_formattable_type' => $model ?? null,
                'claim_formattable_id' => $claimForm->id ?? null,
            ]);

            if (isset($data['health_professional_qualifier'])) {
                $claim->healthProfessionals()->detach();
                foreach ($data['health_professional_qualifier'] as $hpq) {
                    $claim->healthProfessionals()->attach(
                        $hpq['health_professional_id'],
                        [
                            'field_id' => $hpq['field_id'] ?? null,
                            'qualifier_id' => $hpq['qualifier_id'] ?? null,
                        ]);
                }
            }

            if (isset($data['diagnoses'])) {
                $claim->diagnoses()->detach();
                foreach ($data['diagnoses'] as $diagnosis) {
                    $claim->diagnoses()->attach(
                        $diagnosis['diagnosis_id'],
                        [
                            'item' => $diagnosis['item'],
                            'admission' => $diagnosis['admission'] ?? null,
                            'poa' => $diagnosis['poa'] ?? null,
                        ]
                    );
                }
            }

            if (isset($data['insurance_policies'])) {
                $order_values = [];

                foreach ($data['insurance_policies'] as $item) {
                    $order_values[$item['insurance_policy_id']] = ['order' => $item['order']];
                }
                $claim->insurancePolicies()->sync($order_values);
            }

            $claimStatus = ClaimStatus::whereStatus('Draft')->first();
            $claimStatusClaim = ClaimStatusClaim::create([
                'claim_id' => $claim->id,
                'claim_status_type' => ClaimStatus::class,
                'claim_status_id' => $claimStatus->id,
            ]);
            if (isset($data['private_note'])) {
                PrivateNote::create([
                    'publishable_type' => ClaimStatusClaim::class,
                    'publishable_id' => $claimStatusClaim->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'note' => $data['private_note'],
                ]);
            }
            if (isset($data['sub_status_id'])) {
                $this->changeStatus([
                    'status_id' => $claimStatus->id,
                    'sub_status_id' => $data['sub_status_id'],
                    'private_note' => $data['private_note'] ?? '',
                ], $claim->id);
            }

            DB::commit();

            return $claim;
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @return claim[]|Collection
     */
    public function getAllClaims($status, $subStatus)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $claims = Claim::whereHas('claimStatusClaims', function ($query) use ($status, $subStatus) {
                if (1 == count($status)) {
                    $query->where('claim_status_type', ClaimStatus::class)->whereIn('claim_status_id', $status)
                          ->orWhere('claim_status_type', ClaimSubStatus::class)->whereIn('claim_status_id', $subStatus);
                } elseif (count($status) > 1) {
                    $query->where('claim_status_type', ClaimStatus::class)->whereIn('claim_status_id', $status);
                }
            })->with([
                'company' => function ($query) {
                    $query->with('nicknames');
                },
                'patient' => function ($query) {
                    $query->with([
                        'user' => function ($q) {
                            $q->with(['profile', 'addresses', 'contacts']);
                        },
                    ]);
                },
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        } else {
            $claims = Claim::whereHas('claimStatusClaims', function ($query) use ($status, $subStatus) {
                if (1 == count($status)) {
                    $query->where('claim_status_type', ClaimStatus::class)->whereIn('claim_status_id', $status)
                          ->orWhere('claim_status_type', ClaimSubStatus::class)->whereIn('claim_status_id', $subStatus);
                } elseif (count($status) > 1) {
                    $query->where('claim_status_type', ClaimStatus::class)->whereIn('claim_status_id', $status);
                }
            })->with([
                'company' => function ($query) use ($bC) {
                    $query->with([
                        'nicknames' => function ($q) use ($bC) {
                            $q->where('billing_company_id', $bC);
                        },
                    ]);
                },
                'patient' => function ($query) use ($bC) {
                    $query->with([
                        'user' => function ($q) use ($bC) {
                            $q->with([
                                'profile',
                                'addresses' => function ($qq) use ($bC) {
                                    $qq->where('billing_company_id', $bC);
                                },
                                'contacts' => function ($qq) use ($bC) {
                                    $qq->where('billing_company_id', $bC);
                                },
                            ]);
                        },
                    ]);
                },
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        }
        $records = [];
        foreach ($claims as $claim) {
            if (1 == count($status)) {
                if (isset($claim->status->claim_sub_status)) {
                    if (in_array($claim->status->claim_sub_status->id, $subStatus)) {
                        array_push($records, $claim);
                    }
                } elseif (in_array($claim->status->id, $status) && 0 == count($subStatus)) {
                    array_push($records, $claim);
                }
            } elseif (count($status) > 1) {
                if (in_array($claim->status->id, $status)) {
                    array_push($records, $claim);
                }
            } else {
                array_push($records, $claim);
            }
        }

        return is_null($claims) ? null : $records;
    }

    public function getServerAll(Request $request)
    {
        $status = ((is_array($request->status)) ? $request->status : json_decode($request->status)) ?? [];
        $subStatus = ((is_array($request->substatus)) ? $request->substatus : json_decode($request->substatus)) ?? [];
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = Claim::query()->with([
                'company' => function ($query) {
                    $query->with('nicknames');
                },
                'patient' => function ($query) {
                    $query->with([
                        'user' => function ($q) {
                            $q->with(['profile', 'addresses', 'contacts']);
                        },
                    ]);
                },
            ]);
            if (count($subStatus) > 0) {
                $data = $data->whereHas('claimStatusClaims', function ($query) use ($subStatus) {
                    $query->where('claim_status_claim.claim_status_type', ClaimSubStatus::class)
                        ->whereIn('claim_status_claim.claim_status_id', $subStatus)
                        ->whereRaw('claim_status_claim.created_at = (SELECT MAX(created_at) FROM claim_status_claim WHERE claim_status_claim.claim_id = claims.id)');
                })->whereHas('claimStatusClaims', function ($query) use ($status) {
                    $query->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                        ->whereIn('claim_status_claim.claim_status_id', $status)
                        ->whereRaw('claim_status_claim.created_at = (SELECT MAX(created_at) FROM claim_status_claim WHERE claim_status_claim.claim_id = claims.id)');
                });
            } elseif (count($status) > 0) {
                $data = $data->whereHas('claimStatusClaims', function ($query) use ($status) {
                    $query->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                        ->whereIn('claim_status_claim.claim_status_id', $status)
                        ->whereRaw('claim_status_claim.created_at = (SELECT MAX(created_at) FROM claim_status_claim WHERE claim_status_claim.claim_id = claims.id)');
                });
            }
        } else {
            $data = Claim::query()
                ->whereHas('claimFormattable', function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                })->with([
                    'company' => function ($query) use ($bC) {
                        $query->with([
                            'nicknames' => function ($q) use ($bC) {
                                $q->where('billing_company_id', $bC);
                            },
                        ]);
                    },
                    'patient' => function ($query) use ($bC) {
                        $query->with([
                            'user' => function ($q) use ($bC) {
                                $q->with([
                                    'profile',
                                    'addresses' => function ($qq) use ($bC) {
                                        $qq->where('billing_company_id', $bC);
                                    },
                                    'contacts' => function ($qq) use ($bC) {
                                        $qq->where('billing_company_id', $bC);
                                    },
                                ]);
                            },
                        ]);
                    },
                    'claimFormattable' => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                ]);
            if (count($subStatus) > 0) {
                $data = $data->whereHas('claimStatusClaims', function ($query) use ($subStatus) {
                    $query->where('claim_status_claim.claim_status_type', ClaimSubStatus::class)
                        ->whereIn('claim_status_claim.claim_status_id', $subStatus)
                        ->whereRaw('claim_status_claim.created_at = (SELECT MAX(created_at) FROM claim_status_claim WHERE claim_status_claim.claim_id = claims.id)');
                })->whereHas('claimStatusClaims', function ($query) use ($status) {
                    $query->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                        ->whereIn('claim_status_claim.claim_status_id', $status)
                        ->whereRaw('claim_status_claim.created_at = (SELECT MAX(created_at) FROM claim_status_claim WHERE claim_status_claim.claim_id = claims.id)');
                });
            } elseif (count($status) > 0) {
                $data = $data->whereHas('claimStatusClaims', function ($query) use ($status) {
                    $query->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                        ->whereIn('claim_status_claim.claim_status_id', $status)
                        ->whereRaw('claim_status_claim.created_at = (SELECT MAX(created_at) FROM claim_status_claim WHERE claim_status_claim.claim_id = claims.id)');
                });
            }
        }

        if (!empty($request->query('query')) && '{}' !== $request->query('query')) {
            $data = $data->search($request->query('query'));
        }

        if ($request->patient_id) {
            $data = $data->where('patient_id', $request->patient_id);
        }

        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'billingcompany')) {
                $data = $data->orderBy(
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'claims.billing_company_id'), (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } else {
                $data = $data->orderBy($request->sortBy, (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            }
        } else {
            $data = $data->orderBy('created_at', 'desc')->orderBy('id', 'asc');
        }

        $data = $data->paginate($request->itemsPerPage ?? 10);

        return response()->json([
            'data' => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count' => $data->total(),
        ], 200);
    }

    /**
     * @return claim|Builder|Model|object|null
     */
    public function getOneclaim(int $id)
    {
        $claim = Claim::query()->find($id);

        return !is_null($claim) ? new ClaimResource($claim) : null;
    }

    /**
     * @return claim|Builder|Model|object|null
     */
    public function updateClaim(array $data, int $id)
    {
        try {
            DB::beginTransaction();
            $claim = Claim::find($id);

            $claimForm = $claim->claimFormattable;

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'] ?? null;
            } else {
                $billingCompany = auth()->user()?->billingCompanies->first();
            }

            if (isset($data['format'])) {
                $typeFormat = TypeForm::find($data['format']);
                if (isset($typeFormat)) {
                    if ('CMS-1500 / 837P' == $typeFormat->form) {
                        $model = ClaimFormP::class;
                        if (isset($data['claim_services'])) {
                            $claimForm->update([
                                'type_form_id' => $data['format'],
                                'billing_company_id' => $billingCompany->id ?? $billingCompany,
                            ]);
                            foreach ($claimForm->claimFormServices ?? [] as $serviceDB) {
                                $validated = false;
                                foreach ($data['claim_services'] as $service) {
                                    if ($service['id'] ?? null === $serviceDB->id) {
                                        $validated = true;
                                        break;
                                    }
                                }
                                if (!$validated) {
                                    $serviceDB->delete();
                                }
                            }
                            foreach ($data['claim_services'] as $service) {
                                $service['claim_form_p_id'] = $claimForm->id;
                                ClaimFormPService::updateOrCreate([
                                    'id' => $service['id'] ?? null,
                                ], $service);
                            }
                        }
                        if (isset($data['patient_or_insured_information'])) {
                            PatientOrInsuredInformation::updateOrCreate([
                                'claim_form_p_id' => $claimForm->id,
                            ], $data['patient_or_insured_information']);
                        }
                        if (isset($data['physician_or_supplier_information'])) {
                            $physician = PhysicianOrSupplierInformation::updateOrCreate([
                                'claim_form_p_id' => $claimForm->id,
                            ], $data['physician_or_supplier_information']);

                            if (isset($data['physician_or_supplier_information']['claim_date_informations'])) {
                                foreach ($data['physician_or_supplier_information']['claim_date_informations'] ?? [] as $dateInf) {
                                    $dateInf['physician_or_supplier_information_id'] = $physician->id;
                                    ClaimDateInformation::updateOrCreate([
                                        'id' => $dateInf->id ?? null,
                                    ], $dateInf);
                                }
                            }
                        }
                    } else {
                        $model = ClaimFormP::class;
                        $claimForm->update([
                            'type_form_id' => $data['format'],
                            'type_of_medical_assistance' => $data['type_of_medical_assistance'] ?? null,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ]);
                        if (isset($data['claim_services'])) {
                            foreach ($claimForm->claimFormServices ?? [] as $serviceDB) {
                                $validated = false;
                                foreach ($data['claim_services'] as $service) {
                                    if ($service['id'] ?? null === $serviceDB->id) {
                                        $validated = true;
                                        break;
                                    }
                                }
                                if (!$validated) {
                                    $serviceDB->delete();
                                }
                            }
                            foreach ($data['claim_services'] as $service) {
                                $service['days_or_units'] = $service['units_of_service'];
                                $service['claim_form_p_id'] = $claimForm->id;
                                ClaimFormPService::updateOrCreate([
                                    'id' => $service['id'] ?? null,
                                ], $service);
                            }
                        }
                        PatientOrInsuredInformation::updateOrCreate([
                            'claim_form_p_id' => $claimForm->id,
                        ], [
                            'employment_related_condition' => $data['employment_related_condition'],
                            'auto_accident_related_condition' => $data['auto_accident_related_condition'],
                            'auto_accident_place_state' => $data['auto_accident_place_state'] ?? null,
                            'other_accident_related_condition' => $data['other_accident_related_condition'],
                            'patient_signature' => $data['patient_signature'],
                            'insured_signature' => $data['insured_signature'],
                        ]);
                        if (isset($data['additional_information'])) {
                            $data['additional_information']['prior_authorization_number'] = $data['prior_authorization_number'];
                            $data['additional_information']['outside_lab'] = $data['outside_lab'];
                            $data['additional_information']['charges'] = $data['charges'] ?? null;
                            $data['additional_information']['accept_assignment'] = $data['accept_assignment'];
                            $additional = PhysicianOrSupplierInformation::updateOrCreate([
                                'claim_form_p_id' => $claimForm->id,
                            ], $data['additional_information']);

                            if (isset($data['additional_information']['claim_date_informations'])) {
                                foreach ($claimForm->physicianOrSupplierInformation->claimDateInformations ?? [] as $dateInfDB) {
                                    $validated = false;
                                    foreach ($data['additional_information']['claim_date_informations'] ?? [] as $dateInf) {
                                        if ($dateInf['id'] ?? null === $dateInfDB->id) {
                                            $validated = true;
                                            break;
                                        }
                                    }
                                    if (!$validated) {
                                        $dateInfDB->delete();
                                    }
                                }
                                foreach ($data['additional_information']['claim_date_informations'] ?? [] as $dateInf) {
                                    ClaimDateInformation::updateOrCreate([
                                        'id' => $dateInf['id'] ?? null,
                                    ], [
                                        'from_date_or_current' => $dateInf['from_date'],
                                        'to_date' => $dateInf['to_date'],
                                        'field_id' => $dateInf['field_id'],
                                        'qualifier_id' => $dateInf['qualifier_id'],
                                        'through' => $dateInf['through'],
                                        'amount' => $dateInf['amount'],
                                        'physician_or_supplier_information_id' => $additional->id,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }

            $claim->update([
                'company_id' => $data['company_id'] ?? null,
                'facility_id' => $data['facility_id'] ?? null,
                'patient_id' => $data['patient_id'] ?? null,
                'billing_provider_id' => $data['billing_provider_id'] ?? null,
                'service_provider_id' => $data['service_provider_id'] ?? null,
                'referred_id' => $data['referred_id'] ?? null,
                'referred_provider_role_id' => $data['referred_provider_role_id'] ?? null,
                'claim_formattable_type' => $model ?? null,
                'claim_formattable_id' => $claimForm->id ?? null,
            ]);

            if (isset($data['health_professional_qualifier'])) {
                $claim->healthProfessionals()->detach();
                foreach ($data['health_professional_qualifier'] as $hpq) {
                    $claim->healthProfessionals()->attach(
                        $hpq['health_professional_id'],
                        [
                            'field_id' => $hpq['field_id'] ?? null,
                            'qualifier_id' => $hpq['qualifier_id'] ?? null,
                        ]);
                }
            }

            if (isset($data['diagnoses'])) {
                $claim->diagnoses()->detach();
                foreach ($data['diagnoses'] as $diagnosis) {
                    $claim->diagnoses()->attach(
                        $diagnosis['diagnosis_id'],
                        [
                            'item' => $diagnosis['item'],
                            'admission' => $diagnosis['admission'] ?? null,
                            'poa' => $diagnosis['poa'] ?? null,
                        ]
                    );
                }
            }

            if (isset($data['insurance_policies'])) {
                $order_values = [];

                foreach ($data['insurance_policies'] as $item) {
                    $order_values[$item['insurance_policy_id']] = ['order' => $item['order']];
                }
                $claim->insurancePolicies()->sync($order_values);
            }

            if (isset($data['draft'])) {
                $status = $claim->claimStatusClaims()
                    ->where('claim_status_type', ClaimStatus::class)
                    ->orderBy('id', 'desc')->first() ?? null;
                $claimStatus = ClaimStatus::whereStatus('Draft')->first();
                if ($status->claimStatus->id != $claimStatus->id) {
                    $claimStatusClaim = ClaimStatusClaim::create([
                        'claim_id' => $claim->id,
                        'claim_status_type' => ClaimStatus::class,
                        'claim_status_id' => $claimStatus->id,
                    ]);
                    if (!empty($data['private_note'])) {
                        PrivateNote::create([
                            'publishable_type' => ClaimStatusClaim::class,
                            'publishable_id' => $claimStatusClaim->id,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                            'note' => $data['private_note'],
                        ]);
                    }
                } elseif (!empty($data['private_note'])) {
                    PrivateNote::create([
                        'publishable_type' => ClaimStatusClaim::class,
                        'publishable_id' => $status->id,
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        'note' => $data['private_note'],
                    ]);
                }
                if (isset($data['sub_status_id'])) {
                    $this->changeStatus([
                        'status_id' => $claimStatus->id,
                        'sub_status_id' => $data['sub_status_id'],
                        'private_note' => $data['private_note'] ?? '',
                    ], $claim->id);
                }
            }

            if (isset($data['will_report_injuries'])) {
                if (isset($data['injuries'])) {
                    $injuries = $claim->injuries;
                    /* Delete injuries */
                    foreach ($injuries as $injury) {
                        $validated = false;
                        foreach ($data['injuries'] as $injuryC) {
                            if (($injuryC['diag_date'] == $injury->diag_date) &&
                                ($injuryC['diagnosis_id'] == $injury->diagnosis_id) &&
                                ($injuryC['type_diag_id'] == $injury->type_diag_id)) {
                                $validated = true;
                                break;
                            }
                        }
                        if (!$validated) {
                            $injury->delete();
                        }
                    }
                    foreach ($data['injuries'] as $injury) {
                        $claimInjury = Injury::updateOrCreate(
                            [
                                'diag_date' => $injury['diag_date'],
                                'diagnosis_id' => $injury['diagnosis_id'],
                                'type_diag_id' => $injury['type_diag_id'],
                            ],
                            [
                                'diag_date' => $injury['diag_date'],
                                'diagnosis_id' => $injury['diagnosis_id'],
                                'type_diag_id' => $injury['type_diag_id'],
                            ]
                        );
                        if (isset($injury['public_note'])) {
                            /* PublicNote */
                            PublicNote::create([
                                'publishable_type' => Injury::class,
                                'publishable_id' => $claimInjury->id,
                                'note' => $injury['public_note'],
                            ]);
                        }
                        if (isset($claimInjury)) {
                            if (is_null($claim->injuries()->find($claimInjury->id))) {
                                $claim->injuries()->attach($claimInjury->id);
                            }
                        }
                    }
                }
            }
            DB::commit();

            return Claim::whereId($id)->first();
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    public function getListClaimServices(Request $request)
    {
        $formatId = $request->format_id ?? null;

        try {
            return [
                'type_of_services' => getList(TypeOfService::class, ['code', '-', 'name']),
                'place_of_services' => getList(PlaceOfService::class, ['code', '-', 'name']),
                'epsdts' => getList(
                    TypeCatalog::class,
                    ['description'],
                    ['relationship' => 'type', 'where' => ['description' => 'EPSDT']],
                    null
                ),
                'family_plannings' => getList(
                    TypeCatalog::class,
                    ['description'],
                    ['relationship' => 'type', 'where' => ['description' => 'Family planning']],
                    null
                ),
                'referred_provider_roles' => getList(
                    TypeCatalog::class,
                    ['description'],
                    ['relationship' => 'type', 'where' => ['description' => 'Referred or ordered provider roles']],
                    null,
                    ['code']
                ),
            ];
        } catch (\Exception $e) {
            return [
                'type_of_services' => [],
                'place_of_services' => [],
                'epsdts' => [],
                'family_plannings' => [],
                'referred_provider_roles' => [],
            ];
        }
    }

    public function getListTypeOfServices()
    {
        return getList(TypeOfService::class, ['code', '-', 'name']);
    }

    public function getListPlaceOfServices(Request $request)
    {
        return getList(
            PlaceOfService::class,
            ['code', '-', 'name'],
            !empty($request->facility_id)
                ? ['relationship' => 'facilities', 'where' => ['facility_id' => $request->facility_id]]
                : []
        );
    }

    public function getListRev(?int $company_id = null, $search = '')
    {
        try {
            return DB::table('procedures')
                ->leftJoin('company_services', function ($join) use ($company_id) {
                    $join->on('procedures.id', '=', 'company_services.revenue_code_id')
                        ->where('company_services.company_id', $company_id);
                })
                ->when(null != $company_id, function ($query) {
                    $query->whereNotNull('company_services.id');
                })
                ->when('' !== $search, function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('procedures.code', 'like', "%$search%")
                            ->orWhere(function ($query) use ($search) {
                                $search = str_replace(['f', 'F'], '', $search);
                                $query->whereJsonContains('procedures.clasifications->general', 2)
                                    ->where('procedures.code', 'like', "%$search%F");
                            });
                    });
                })
                ->where('procedures.type', '4')
                ->select('procedures.id', 'procedures.code', 'procedures.description', 'company_services.price')
                ->orderByDesc('company_services.price')
                ->get()
                ->map(function ($procedure) {
                    return [
                        'id' => $procedure->id,
                        'name' => $procedure->code,
                        'description' => $procedure->description,
                        'price' => Money::parse($procedure->price ?? 0, null, true)->formatByDecimal(),
                    ];
                })
                ->values()
                ->toArray();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getListRevCenters()
    {
        return getList(RevCenter::class, 'code');
    }

    public function getListTypeFormats()
    {
        return getList(TypeForm::class, 'form');
    }

    public function getListClaimFieldInformations()
    {
        try {
            return getList(TypeCatalog::class, ['description'], ['relationship' => 'type', 'where' => ['description' => 'Claim field information']], null);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListAdmissionTypes()
    {
        try {
            return getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => 'Admission type code']], null);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListAdmissionSources()
    {
        try {
            return getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => 'Admission source code']], null);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListFieldQualifiers($id = null)
    {
        try {
            $claimField = TypeCatalog::find($id);
            $typeCatalog = getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => $claimField->description]], null, ['code']);
            foreach ($typeCatalog as $key => $value) {
                if (('14. Date of current illnes, injury or pregnancy (LMP)' == $claimField->description) ||
                    ('15. Other date' == $claimField->description)) {
                    $typeCatalog[$key]['except'] = ['to_date', 'description'];
                }
                if (('16. Dates patient unable to work in current occupation' == $claimField->description) ||
                    ('18. Hospitalization dates related to current services' == $claimField->description)) {
                    $typeCatalog[$key]['except'] = ['description'];
                } else {
                    $typeCatalog[$key]['except'] = [];
                }
            }

            return $typeCatalog;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListTypeDiags()
    {
        return getList(TypeDiag::class, ['code', '-', 'description']);
    }

    public function getListStatus()
    {
        return getList(ClaimStatus::class, 'status');
    }

    public function getSecurityAuthorizationAccessToken()
    {
        try {
            $data = [
                'sandbox' => [
                    'url' => 'https://sandbox.apigw.changehealthcare.com/apip/auth/v2/token',
                    'client_id' => '7ULJqHZb91y2zP3lgD4xQ3A3jACdmPTF',
                    'client_secret' => 'EBPadsDKoOuEoOWv',
                ],
                'production' => [
                    'url' => 'https://apigw.changehealthcare.com/apip/auth/v2/token',
                    'client_id' => 'OB5PKVzA2Y0ecMMfML9ZeB56GC3MRKDN',
                    'client_secret' => 'P1YmwbYAIOPMUfF9',
                ],
            ];

            $response = Http::acceptJson()->post($data[env('CHANGEHC_CONNECTION', 'sandbox')]['url'], [
                'client_id' => $data[env('CHANGEHC_CONNECTION', 'sandbox')]['client_id'],
                'client_secret' => $data[env('CHANGEHC_CONNECTION', 'sandbox')]['client_secret'],
                'grant_type' => 'client_credentials',
            ]);
            $responseData = json_decode($response->body());

            return $responseData;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function getcheckStatus($token, $id)
    {
        try {
            $data = [
                'sandbox' => [
                    'url' => 'https://sandbox.apigw.changehealthcare.com/medicalnetwork/claimstatus/v2',
                    'body' => [
                        'controlNumber' => '123456789',
                        'tradingPartnerServiceId' => 'CMSMED',
                        'provider' => [
                            'organizationName' => 'provider_name',
                            'npi' => '0123456789',
                            'serviceProviderNumber' => '54321',
                            'providerCode' => 'AD',
                            'referenceIdentification' => '54321g',
                        ],
                        'subscriber' => [
                            'memberId' => '0000000000',
                            'firstName' => 'johnOne',
                            'lastName' => 'doeOne',
                            'gender' => 'M',
                            'dateOfBirth' => '18800102',
                            'ssn' => '555443333',
                            'idCard' => 'card123',
                        ],
                        'dependents' => [
                            [
                                'firstName' => 'janeOne',
                                'lastName' => 'doeone',
                                'gender' => 'F',
                                'dateOfBirth' => '18160421',
                                'groupNumber' => '1111111111',
                            ],
                        ],
                        'encounter' => [
                            'beginningDateOfService' => '20100102',
                            'endDateOfService' => '20100102',
                            'serviceTypeCodes' => [
                              '98',
                            ],
                        ],
                    ],
                ],
                'production' => [
                    'url' => 'https://apigw.changehealthcare.com/medicalnetwork/claimstatus/v2',
                    'body' => null,
                ],
            ];

            $claim = Claim::with(['patient', 'company', 'claimFormattable', 'claimFormattable.claimFormServices.typeOfService'])->find($id);
            $patient = Patient::with([
                'insurancePolicies' => function ($query) {
                    $query->with('typeResponsibility');
                },
                'user.profile',
            ])->find($claim->patient_id);
            $insurancePolicy = $claim->insurancePolicies->first();
            $encounter = [];
            $serviceCodes = [];

            foreach ($claim->claimFormattable->claimFormServices ?? [] as $service) {
                $encounter['beginningDateOfService'] = str_replace('-', '', $service->from_service);
                $encounter['endDateOfService'] = str_replace('-', '', $service->to_service);
                array_push($serviceCodes, $service->typeOfService->code);
            }
            $encounter['serviceTypeCodes'] = $serviceCodes;

            $dataReal = [
                'controlNumber' => $claim->control_number ?? '',
                'tradingPartnerServiceId' => $insurancePolicy->insurancePlan->insuranceCompany->payer_id ?? null,
                'tradingPartnerName' => $insurancePolicy->insurancePlan->insuranceCompany->name ?? null,
                'provider' => [
                    'organizationName' => $claim->company->name ?? null,
                    'npi' => $claim->company->npi ?? null,
                    'serviceProviderNumber' => $claim->company->sevices_number ?? null,
                    'providerCode' => 'AD', // $claim->company->code ?? null,
                    'referenceIdentification' => $claim->company->reference_identification ?? null,
                ],
                'subscriber' => [
                    'memberId' => $insurancePolicy->subscriber->member_id ?? null,
                    'firstName' => $insurancePolicy->subscriber->first_name ?? $patient->user->profile->first_name,
                    'lastName' => $insurancePolicy->subscriber->last_name ?? $patient->user->profile->last_name,
                    'gender' => $insurancePolicy->subscriber ? null : strtoupper($patient->user->profile->sex),
                    'dateOfBirth' => $insurancePolicy->subscriber ? null : str_replace('-', '', $patient->user->profile->date_of_birth),
                    'ssn' => $insurancePolicy->subscriber->ssn ?? $patient->user->profile->ssn,
                    'idCard' => $insurancePolicy->subscriber->id_card ?? null,
                ],
                'dependents' => [
                    [
                        'firstName' => $patient->user->profile->first_name,
                        'lastName' => $patient->user->profile->last_name,
                        'gender' => strtoupper($patient->user->profile->sex),
                        'dateOfBirth' => str_replace('-', '', $patient->user->profile->date_of_birth),
                        'groupNumber' => $insurancePolicy->subscriber->group_number ?? null,
                    ],
                ],
                'encounter' => $encounter,
            ];

            $response = Http::withToken($token)->acceptJson()->post(
                $data[env('CHANGEHC_CONNECTION', 'sandbox')]['url'],
                $data[env('CHANGEHC_CONNECTION', 'sandbox')]['body'] ?? $dataReal
            );
            $responseData = json_decode($response->body());

            return [
                'claim_id' => $claim->id,
                'response' => $responseData,
            ];
        } catch (\Exception $e) {
            return null;
        }
    }

    public function storeCheckEligibility($token, array $data)
    {
        try {
            DB::beginTransaction();
            $dataENV = [
                'sandbox' => [
                    'url' => 'https://sandbox.apigw.changehealthcare.com/medicalnetwork/eligibility/v3',
                    'body' => [
                        'controlNumber' => '123456789',
                        'tradingPartnerServiceId' => 'CMSMED',
                        'provider' => [
                            'organizationName' => 'provider_name',
                            'npi' => '0123456789',
                            'serviceProviderNumber' => '54321',
                            'providerCode' => 'AD',
                            'referenceIdentification' => '54321g',
                        ],
                        'subscriber' => [
                            'memberId' => '0000000000',
                            'firstName' => 'johnOne',
                            'lastName' => 'doeOne',
                            'gender' => 'M',
                            'dateOfBirth' => '18800102',
                            'ssn' => '555443333',
                            'idCard' => 'card123',
                        ],
                        'dependents' => [
                            [
                                'firstName' => 'janeOne',
                                'lastName' => 'doeone',
                                'gender' => 'F',
                                'dateOfBirth' => '18160421',
                                'groupNumber' => '1111111111',
                            ],
                        ],
                        'encounter' => [
                            'beginningDateOfService' => '20100102',
                            'endDateOfService' => '20100102',
                            'serviceTypeCodes' => [
                              '98',
                            ],
                        ],
                    ],
                ],
                'production' => [
                    'url' => 'https://apigw.changehealthcare.com/medicalnetwork/eligibility/v3',
                    'body' => null,
                ],
            ];

            $patient = Patient::with([
                'insurancePolicies' => function ($query) {
                    $query->with('typeResponsibility');
                },
                'user.profile',
            ])->find($data['patient_id']);
            $insurancePolicies = [];
            $company = Company::find($data['company_id']);

            foreach ($patient->insurancePolicies ?? [] as $insurancePolicy) {
                $newCode = 1;
                $targetModel = ClaimEligibility::select('id', 'control_number')->orderBy('created_at', 'desc')->orderBy('id', 'desc')->first();

                $newCode += ($targetModel) ? (int) $targetModel->control_number : 0;
                $newCode = str_pad($newCode, 9, '0', STR_PAD_LEFT);

                if ($data['automatic_eligibility']) {
                    $encounter = [];
                    $serviceCodes = [];

                    foreach ($data['claim_services'] ?? [] as $service) {
                        $typeOfService = TypeOfService::find($service['type_of_service_id']);
                        $encounter['beginningDateOfService'] = str_replace('-', '', $service['from_service']);
                        $encounter['endDateOfService'] = str_replace('-', '', $service['to_service']);
                        array_push($serviceCodes, $typeOfService->code);
                    }
                    $encounter['serviceTypeCodes'] = $serviceCodes;

                    $dataReal = [
                        'controlNumber' => $newCode,
                        'tradingPartnerServiceId' => $insurancePolicy->insurancePlan->insuranceCompany->payer_id ?? null,
                        'tradingPartnerName' => $insurancePolicy->insurancePlan->insuranceCompany->name ?? null,
                        'provider' => [
                            'organizationName' => $company->name ?? null,
                            'npi' => $company->npi ?? null,
                            'serviceProviderNumber' => $company->sevices_number ?? null,
                            'providerCode' => 'AD', // $company->code ?? null,
                            'referenceIdentification' => $company->reference_identification ?? null,
                        ],
                        'subscriber' => [
                            'memberId' => $insurancePolicy->subscriber->member_id ?? null,
                            'firstName' => $insurancePolicy->subscriber->first_name ?? $patient->user->profile->first_name,
                            'lastName' => $insurancePolicy->subscriber->last_name ?? $patient->user->profile->last_name,
                            'gender' => $insurancePolicy->subscriber ? null : strtoupper($patient->user->profile->sex),
                            'dateOfBirth' => $insurancePolicy->subscriber ? null : str_replace('-', '', $patient->user->profile->date_of_birth),
                            'ssn' => $insurancePolicy->subscriber->ssn ?? $patient->user->profile->ssn,
                            'idCard' => $insurancePolicy->subscriber->id_card ?? null,
                        ],
                        'dependents' => [
                            [
                                'firstName' => $patient->user->profile->first_name,
                                'lastName' => $patient->user->profile->last_name,
                                'gender' => strtoupper($patient->user->profile->sex),
                                'dateOfBirth' => str_replace('-', '', $patient->user->profile->date_of_birth),
                                'groupNumber' => $insurancePolicy->subscriber->group_number ?? null,
                            ],
                        ],
                        'encounter' => $encounter,
                    ];

                    $response = Http::withToken($token)->acceptJson()->post(
                        $dataENV[env('CHANGEHC_CONNECTION', 'sandbox')]['url'],
                        $dataENV[env('CHANGEHC_CONNECTION', 'sandbox')]['body'] ?? $dataReal
                    );
                    $responseData['response'] = json_decode($response->body());
                    $responseData['request'] = $dataReal;

                    if ($response->successful()) {
                        $claimEligibilityStatus = ClaimEligibilityStatus::whereStatus('Eligible policy')->first();
                    } elseif ($response->serverError()) {
                        $claimEligibilityStatus = ClaimEligibilityStatus::whereStatus('Unknow')->first();
                    } elseif ($response->failed()) {
                        $claimEligibilityStatus = ClaimEligibilityStatus::whereStatus('Ineligible policy')->first();
                    }
                } else {
                    $eligibilityCurrent = $insurancePolicy->claimEligibilities()
                        ->orderBy('created_at', 'desc')
                        ->orderBy('id', 'asc')->first();
                    if (isset($eligibilityCurrent)) {
                        $claimEligibilityStatus = $eligibilityCurrent->claimEligibilityStatus;
                    } else {
                        $claimEligibilityStatus = ClaimEligibilityStatus::whereStatus('Unknow')->first();
                    }
                }

                $claimEligibility = ClaimEligibility::updateOrCreate([
                    'control_number' => $newCode,
                    'company_id' => $company->id,
                    'patient_id' => $patient->id,
                    'subscriber_id' => $insurancePolicy->subscriber->id ?? null,
                    'insurance_policy_id' => $insurancePolicy->id,
                    'claim_eligibility_status_id' => $claimEligibilityStatus->id,
                    'response_details' => isset($responseData) ? json_encode($responseData) : null,
                    'insurance_company_id' => $insurancePolicy->insurance_company_id,
                ]);

                $claimEligibilityCurrent = ClaimEligibility::with(['claimEligibilityStatus'])->find($claimEligibility->id) ?? null;
                if (isset($claimEligibilityCurrent)) {
                    $insurancePolicy['claim_eligibility'] = [
                        'control_number' => $claimEligibilityCurrent->control_number ?? null,
                        // "claim_id"                    => $claimEligibilityCurrent->claim_id ?? null,
                        'insurance_policy' => $claimEligibilityCurrent->insurancePolicy ?? null,
                        'insurance_policy_id' => $claimEligibilityCurrent->insurance_policy_id ?? null,
                        'response_details' => json_decode($claimEligibilityCurrent->response_details ?? null),
                        'claim_eligibility_status' => $claimEligibilityCurrent->claimEligibilityStatus ?? null,
                        'claim_eligibility_status_id' => $claimEligibilityCurrent->claim_eligibility_status_id ?? null,
                    ];
                } else {
                    $insurancePolicy['claim_eligibility'] = null;
                }

                array_push($insurancePolicies, $insurancePolicy);
            }
            $order = ['P', 'S', 'T'];

            usort($insurancePolicies, function ($a, $b) use ($order) {
                $a_index = array_search($a->typeResponsibility->code, $order);
                $b_index = array_search($b->typeResponsibility->code, $order);

                return $a_index - $b_index;
            });

            DB::commit();

            return [
                'insurance_policies' => $insurancePolicies,
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    public function checkEligibility($token, $id)
    {
        try {
            DB::beginTransaction();
            $data = [
                'sandbox' => [
                    'url' => 'https://sandbox.apigw.changehealthcare.com/medicalnetwork/eligibility/v3',
                    'body' => [
                        'controlNumber' => '123456789',
                        'tradingPartnerServiceId' => 'CMSMED',
                        'provider' => [
                            'organizationName' => 'provider_name',
                            'npi' => '0123456789',
                            'serviceProviderNumber' => '54321',
                            'providerCode' => 'AD',
                            'referenceIdentification' => '54321g',
                        ],
                        'subscriber' => [
                            'memberId' => '0000000000',
                            'firstName' => 'johnOne',
                            'lastName' => 'doeOne',
                            'gender' => 'M',
                            'dateOfBirth' => '18800102',
                            'ssn' => '555443333',
                            'idCard' => 'card123',
                        ],
                        'dependents' => [
                            [
                                'firstName' => 'janeOne',
                                'lastName' => 'doeone',
                                'gender' => 'F',
                                'dateOfBirth' => '18160421',
                                'groupNumber' => '1111111111',
                            ],
                        ],
                        'encounter' => [
                            'beginningDateOfService' => '20100102',
                            'endDateOfService' => '20100102',
                            'serviceTypeCodes' => [
                              '98',
                            ],
                        ],
                    ],
                ],
                'production' => [
                    'url' => 'https://apigw.changehealthcare.com/medicalnetwork/eligibility/v3',
                    'body' => null,
                ],
            ];

            $claim = Claim::with(['patient', 'company', 'claimFormattable', 'claimFormattable.claimFormServices.typeOfService'])->find($id);
            $patient = Patient::with([
                'insurancePolicies' => function ($query) {
                    $query->with('typeResponsibility');
                },
                'user.profile',
            ])->whereHas('insurancePolicies', function ($query) {
                $query->where('status', true);
            })->find($claim->patient_id);
            $insurancePolicies = [];

            foreach ($patient->insurancePolicies ?? [] as $insurancePolicy) {
                $newCode = 1;
                $targetModel = ClaimEligibility::select('id', 'control_number')->orderBy('created_at', 'desc')->orderBy('id', 'desc')->first();

                $newCode += ($targetModel) ? (int) $targetModel->control_number : 0;
                $newCode = str_pad($newCode, 9, '0', STR_PAD_LEFT);

                if ($claim->automatic_eligibility) {
                    $encounter = [];
                    $serviceCodes = [];

                    foreach ($claim->claimFormattable->claimFormServices ?? [] as $service) {
                        $encounter['beginningDateOfService'] = str_replace('-', '', $service->from_service);
                        $encounter['endDateOfService'] = str_replace('-', '', $service->to_service);
                        array_push($serviceCodes, $service->typeOfService->code);
                    }
                    $encounter['serviceTypeCodes'] = $serviceCodes;

                    $dataReal = [
                        'controlNumber' => $newCode,
                        'tradingPartnerServiceId' => $insurancePolicy->insurancePlan->insuranceCompany->payer_id ?? null,
                        'tradingPartnerName' => $insurancePolicy->insurancePlan->insuranceCompany->name ?? null,
                        'provider' => [
                            'organizationName' => $claim->company->name ?? null,
                            'npi' => $claim->company->npi ?? null,
                            'serviceProviderNumber' => $claim->company->sevices_number ?? null,
                            'providerCode' => 'AD', // $claim->company->code ?? null,
                            'referenceIdentification' => $claim->company->reference_identification ?? null,
                        ],
                        'subscriber' => [
                            'memberId' => $insurancePolicy->subscriber->member_id ?? null,
                            'firstName' => $insurancePolicy->subscriber->first_name ?? $patient->user->profile->first_name,
                            'lastName' => $insurancePolicy->subscriber->last_name ?? $patient->user->profile->last_name,
                            'gender' => $insurancePolicy->subscriber ? null : strtoupper($patient->user->profile->sex),
                            'dateOfBirth' => $insurancePolicy->subscriber ? null : str_replace('-', '', $patient->user->profile->date_of_birth),
                            'ssn' => $insurancePolicy->subscriber->ssn ?? $patient->user->profile->ssn,
                            'idCard' => $insurancePolicy->subscriber->id_card ?? null,
                        ],
                        'dependents' => [
                            [
                                'firstName' => $patient->user->profile->first_name,
                                'lastName' => $patient->user->profile->last_name,
                                'gender' => strtoupper($patient->user->profile->sex),
                                'dateOfBirth' => str_replace('-', '', $patient->user->profile->date_of_birth),
                                'groupNumber' => $insurancePolicy->subscriber->group_number ?? null,
                            ],
                        ],
                        'encounter' => $encounter,
                    ];

                    $response = Http::withToken($token)->acceptJson()->post(
                        $data[env('CHANGEHC_CONNECTION', 'sandbox')]['url'],
                        $data[env('CHANGEHC_CONNECTION', 'sandbox')]['body'] ?? $dataReal
                    );
                    $responseData = json_decode($response->body());

                    if ($response->successful()) {
                        $claimEligibilityStatus = ClaimEligibilityStatus::whereStatus('Eligible policy')->first();
                    } elseif ($response->serverError()) {
                        $claimEligibilityStatus = ClaimEligibilityStatus::whereStatus('Unknow')->first();
                    } elseif ($response->failed()) {
                        $claimEligibilityStatus = ClaimEligibilityStatus::whereStatus('Ineligible policy')->first();
                    }
                } else {
                    $claimEligibilityStatus = ClaimEligibilityStatus::whereStatus('Unknow')->first();
                }

                $claimEligibility = ClaimEligibility::updateOrCreate([
                    'control_number' => $newCode,
                    'claim_id' => $claim->id,
                    'company_id' => $claim->company_id,
                    'patient_id' => $patient->id,
                    'subscriber_id' => $insurancePolicy->subscriber->id ?? null,
                    'insurance_policy_id' => $insurancePolicy->id,
                    'claim_eligibility_status_id' => $claimEligibilityStatus->id,
                    'response_details' => isset($response) ? $response->body() : null,
                    'insurance_company_id' => $insurancePolicy->insurance_company_id,
                ]);

                /**foreach ($responseData->benefitsInformation as $rData) {
                    $claimEligibilityBenefitsInformation = ClaimEligibilityBenefitsInformation::create([
                        "code" => $rData->code,
                        "name" => $rData->name,
                        "claim_eligibility_id" => $claimEligibility->id,
                        "service_type_codes" => $rData->serviceTypeCodes,
                        "service_types" => $rData->serviceTypes,
                        "insurance_type_code" => $rData->insuranceTypeCode ?? null,
                        "insurance_type" => $rData->insuranceType ?? null,
                        "time_qualifer_code" => $rData->timeQualifierCode ?? null,
                        "time_qualifer"  => $rData->timeQualifier ?? null,
                        "benefit_amount" => $rData->benefitAmount ?? null,
                        "benefits_date_information"  => $rData->benefitsDateInformation ?? null,
                        "additional_information"  => $rData->additionalInformation ?? null
                    ]);
                }
                foreach ($responseData->planStatus as $rData) {
                    $claimEligibilityPlanStatus = ClaimEligibilityPlanStatus::create([
                        "status_code"          => $rData->statusCode,
                        "status"               => $rData->status,
                        "claim_eligibility_id" => $claimEligibility->id
                    ]);

                }*/
                $claimEligibilityCurrent = ClaimEligibility::with(['claimEligibilityStatus'])->find($claimEligibility->id) ?? null;
                if (isset($claimEligibilityCurrent)) {
                    $insurancePolicy['claim_eligibility'] = [
                        'control_number' => $claimEligibilityCurrent->control_number ?? null,
                        'claim_id' => $claimEligibilityCurrent->claim_id ?? null,
                        'insurance_policy' => $claimEligibilityCurrent->insurancePolicy ?? null,
                        'insurance_policy_id' => $claimEligibilityCurrent->insurance_policy_id ?? null,
                        'response_details' => json_decode($claimEligibilityCurrent->response_details ?? null),
                        'claim_eligibility_status' => $claimEligibilityCurrent->claimEligibilityStatus ?? null,
                        'claim_eligibility_status_id' => $claimEligibilityCurrent->claim_eligibility_status_id ?? null,
                    ];
                } else {
                    $insurancePolicy['claim_eligibility'] = null;
                }

                array_push($insurancePolicies, $insurancePolicy);
            }
            $order = ['P', 'S', 'T'];

            usort($insurancePolicies, function ($a, $b) use ($order) {
                $a_index = array_search($a->typeResponsibility->code, $order);
                $b_index = array_search($b->typeResponsibility->code, $order);

                return $a_index - $b_index;
            });

            DB::commit();

            return [
                'claim_id' => $claim->id,
                'insurance_policies' => $insurancePolicies,
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    public function claimValidation($token, $id)
    {
        try {
            DB::beginTransaction();
            $data = [
                'sandbox' => [
                    'url' => 'https://sandbox.apigw.changehealthcare.com/medicalnetwork/professionalclaims/v3/validation',
                    'body' => [
                        'controlNumber' => '000000001',
                        'tradingPartnerServiceId' => '9496',
                        'submitter' => [
                            'organizationName' => 'REGIONAL PPO NETWORK',
                            'contactInformation' => [
                                'name' => 'SUBMITTER CONTACT INFO',
                                'phoneNumber' => '123456789',
                            ],
                        ],
                        'receiver' => [
                            'organizationName' => 'EXTRA HEALTHY INSURANCE',
                        ],
                        'subscriber' => [
                            'memberId' => '0000000001',
                            'paymentResponsibilityLevelCode' => 'P',
                            'firstName' => 'johnone',
                            'lastName' => 'doeOne',
                            'gender' => 'M',
                            'dateOfBirth' => '19800102',
                            'policyNumber' => '00001',
                            'address' => [
                                'address1' => '123 address1',
                                'city' => 'city1',
                                'state' => 'wa',
                                'postalCode' => '981010000',
                            ],
                        ],
                        'dependent' => [
                            'memberId' => '0000000002',
                            'paymentResponsibilityLevelCode' => 'P',
                            'firstName' => 'janeone',
                            'lastName' => 'doeOne',
                            'gender' => 'F',
                            'dateOfBirth' => '19800102',
                            'policyNumber' => '00002',
                            'relationshipToSubscriberCode' => '01',
                            'address' => [
                                'address1' => '123 address1',
                                'city' => 'city1',
                                'state' => 'wa',
                                'postalCode' => '981010000',
                            ],
                        ],

                        'providers' => [
                            [
                                'providerType' => 'BillingProvider',
                                'npi' => '1760854442',
                                'employerId' => '123456789',
                                'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
                                'address' => [
                                    'address1' => '000 address1',
                                    'city' => 'city2',
                                    'state' => 'tn',
                                    'postalCode' => '372030000',
                                ],
                                'contactInformation' => [
                                    'name' => 'janetwo doetwo',
                                    'phoneNumber' => '0000000001',
                                ],
                            ],
                            [
                                'providerType' => 'ReferringProvider',
                                'npi' => '1942788757',
                                'firstName' => 'johntwo',
                                'lastName' => 'doetwo',
                                'employerId' => '123456',
                            ],
                            [
                                'providerType' => 'RenderingProvider',
                                'npi' => '1942788757',
                                'firstName' => 'janetwo',
                                'lastName' => 'doetwo',
                                'middleName' => 'middletwo',
                                'ssn' => '000000000',
                            ],
                        ],
                        'claimInformation' => [
                            'claimFilingCode' => 'CI',
                            'patientControlNumber' => '12345',
                            'claimChargeAmount' => '28.75',
                            'placeOfServiceCode' => '11',
                            'claimFrequencyCode' => '1',
                            'signatureIndicator' => 'Y',
                            'planParticipationCode' => 'A',
                            'benefitsAssignmentCertificationIndicator' => 'Y',
                            'releaseInformationCode' => 'Y',
                            'claimSupplementalInformation' => [
                                'repricedClaimNumber' => '00001',
                                'claimNumber' => '12345',
                            ],
                            'healthCareCodeInformation' => [
                                [
                                    'diagnosisTypeCode' => 'BK',
                                    'diagnosisCode' => '496',
                                ],
                                [
                                    'diagnosisTypeCode' => 'BF',
                                    'diagnosisCode' => '25000',
                                ],
                            ],
                            'serviceFacilityLocation' => [
                                'organizationName' => 'HAPPY DOCTORS GROUP',
                                'address' => [
                                    'address1' => '000 address1',
                                    'city' => 'city2',
                                    'state' => 'tn',
                                    'postalCode' => '372030000',
                                ],
                            ],
                            'serviceLines' => [
                                [
                                    'serviceDate' => '20050514',
                                    'professionalService' => [
                                        'procedureIdentifier' => 'HC',
                                        'lineItemChargeAmount' => '25',
                                        'procedureCode' => 'E0570',
                                        'measurementUnit' => 'UN',
                                        'serviceUnitCount' => '1',
                                        'compositeDiagnosisCodePointers' => [
                                            'diagnosisCodePointers' => ['1', '2'],
                                        ],
                                    ],
                                ],
                                [
                                    'serviceDate' => '20050514',
                                    'professionalService' => [
                                        'procedureIdentifier' => 'HC',
                                        'lineItemChargeAmount' => '3.75',
                                        'procedureCode' => 'A7003',
                                        'measurementUnit' => 'UN',
                                        'serviceUnitCount' => '1',
                                        'compositeDiagnosisCodePointers' => [
                                            'diagnosisCodePointers' => ['1'],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'production' => [
                    'url' => 'https://apigw.changehealthcare.com/medicalnetwork/professionalclaims/v3/validation',
                    'body' => null,
                ],
            ];

            $claim = Claim::with([
                'company',
                'diagnoses',
                // "insuranceCompany",
                'insurancePolicies',
                'claimFormattable' => function ($query) {
                    $query->with([
                        'billingCompany' => function ($q) {
                            $q->with('contacts', 'addresses');
                        },
                        'claimFormServices' => function ($q) {
                            $q->with('typeOfService');
                        },
                    ]);
                },
            ])->find($id);

            $patient = Patient::with([
                'insurancePolicies' => function ($query) {
                    $query->with('typeResponsibility');
                },
                'user.profile',
            ])->find($claim->patient_id);
            $insurancePolicies = [];
            $claimInsurancePolicies = [];

            foreach ($claim->insurancePolicies ?? [] as $insurancePolicy) {
                array_push($claimInsurancePolicies, $insurancePolicy->id);
            }

            foreach ($patient->insurancePolicies()->whereIn('insurance_policies.id', $claimInsurancePolicies)->get() ?? [] as $insurancePolicy) {
                $newCode = 1;
                $targetModel = ClaimValidation::select('id', 'control_number')->orderBy('created_at', 'desc')->orderBy('id', 'desc')->first();

                $newCode += ($targetModel) ? (int) $targetModel->control_number : 0;
                $newCode = str_pad($newCode, 9, '0', STR_PAD_LEFT);

                if ($claim->validate) {
                    $subscriber =
                        (($insurancePolicy->own ?? true) == true)
                            ? $patient->user
                            : $insurancePolicy->subscriber;
                    $addressSubscriber = $subscriber->addresses->first();
                    $addressPatient = $patient->user->addresses->first();
                    $addressCompany = $claim->company->addresses->first();
                    $contactCompany = $claim->company->contacts->first();

                    $dependent = (($insurancePolicy->own ?? true) == true)
                        ? null
                        : [
                            'memberId' => $patient->code ?? null,
                            'paymentResponsibilityLevelCode' => $insurancePolicy->payment_responsibility_level_code ?? 'P',
                            'firstName' => $patient->user->profile->first_name ?? null,
                            'lastName' => $patient->user->profile->last_name ?? null,
                            'gender' => strtoupper($patient->user->profile->sex ?? 'M'),
                            'dateOfBirth' => str_replace('-', '', $patient->user->profile->date_of_birth),
                            'policyNumber' => $insurancePolicy->policy_number ?? null,
                            'relationshipToSubscriberCode' => $subscriber->relationship->code ?? '21', /* Si no existe, descococido */
                            'address' => [
                                'address1' => $addressPatient->address ?? null,
                                'city' => $addressPatient->city ?? null,
                                'state' => substr($addressPatient->state ?? '', 0, 2) ?? null,
                                'postalCode' => $addressPatient->zip,
                            ],
                        ];
                    $claimServiceLinePrincipal = $claim->claimFormattable->claimFormServices->first();
                    $claimDiagnoses = [];

                    foreach ($claim->diagnoses ?? [] as $diagnosis) {
                        if (0 == count($claimDiagnoses)) {
                            array_push($claimDiagnoses, [
                                'diagnosisTypeCode' => 'BK',
                                'diagnosisCode' => $diagnosis->code,
                            ]);
                        } else {
                            array_push($claimDiagnoses, [
                                'diagnosisTypeCode' => 'BF',
                                'diagnosisCode' => $diagnosis->code,
                            ]);
                        }
                    }

                    $serviceFacilityLocation = [
                        'organizationName' => 'HAPPY DOCTORS GROUP',
                        'address' => [
                            'address1' => '000 address1',
                            'city' => 'city2',
                            'state' => 'tn',
                            'postalCode' => '372030000',
                        ],
                    ];

                    $serviceLines = [];

                    foreach ($claim->claimFormattable->claimFormServices ?? [] as $service) {
                        array_push($serviceLines, [
                            'serviceDate' => str_replace('-', '', $claim->date_of_service),
                            'professionalService' => [
                                'procedureIdentifier' => 'HC' /* No esta, Loop2400 SV101-01 * */,
                                'lineItemChargeAmount' => $service->price,
                                'procedureCode' => 'E0570',
                                'measurementUnit' => 'UN',
                                'serviceUnitCount' => '1',
                                'compositeDiagnosisCodePointers' => [
                                    'diagnosisCodePointers' => $service->diagnostic_pointers ?? [],
                                ],
                            ],
                        ]);
                    }

                    $dataReal = [
                        'controlNumber' => $newCode,
                        'tradingPartnerServiceId' => '9496', /* Caso de prueba */
                        'usageIndicator' => 'T',  /* Caso de prueba */
                        'tradingPartnerName' => 'BEGENTOOS',
                        'submitter' => [/* Billing Company */
                            'organizationName' => $claim->claimFormattable->billingCompany->name ?? null,
                            'contactInformation' => [
                                'name' => $claim->claimFormattable->billingCompany->contact->contact_name ?? null,
                                'phoneNumber' => $claim->claimFormattable->billingCompany->contact->phone ?? null,
                            ],
                        ],
                        'receiver' => [/**Insurance Company */
                            'organizationName' => $insurancePolicy->insurancePlan->insuranceCompany->name ?? null,
                        ],
                        'subscriber' => [
                            'memberId' => $subscriber->member_id ?? null,
                            'paymentResponsibilityLevelCode' => $insurancePolicy->payment_responsibility_level_code ?? 'P',
                            'firstName' => $subscriber->first_name ?? $subscriber->profile->first_name,
                            'lastName' => $subscriber->last_name ?? $subscriber->profile->last_name,
                            'gender' => strtoupper($subscriber->profile->sex ?? 'M'), /**Agregar*/
                            'dateOfBirth' => str_replace('-', '', $subscriber->profile->date_of_birth ?? $subscriber->date_of_birth),
                            'policyNumber' => $insurancePolicy->policy_number ?? null,
                            'address' => [
                                'address1' => $addressSubscriber->address ?? null,
                                'city' => $addressSubscriber->city ?? null,
                                'state' => substr($addressSubscriber->state ?? '', 0, 2) ?? null,
                                'postalCode' => $addressSubscriber->zip,
                            ],
                        ],
                        'dependent' => $dependent ?? null,
                        'providers' => [/* Company */
                            [
                                'providerType' => 'BillingProvider',
                                'npi' => $claim->company->npi ?? null,
                                'employerId' => $claim->company->ein ?? null,
                                'organizationName' => $claim->company->name ?? null,
                                'address' => [
                                    'address1' => $addressCompany->address ?? null,
                                    'city' => $addressCompany->city ?? null,
                                    'state' => substr($addressCompany->state ?? '', 0, 2),
                                    'postalCode' => $addressCompany->zip ?? null,
                                ],
                                'contactInformation' => [
                                    'name' => $contactCompany->contact_name ?? null,
                                    'phoneNumber' => $contactCompany->phone ?? null,
                                ],
                            ],
                        ],
                        'claimInformation' => [
                            'claimFilingCode' => 'CI',
                            'patientControlNumber' => $claim->control_number, /**Preguntar xq no el el codePAtient Loop2300*/
                            'claimChargeAmount' => $claim->amount_paid ?? '28.75',
                            'placeOfServiceCode' => $claimServiceLinePrincipal->placeOfService->code ?? '11',
                            'claimFrequencyCode' => '1', /* Porque siempre 1 ?? */
                            'signatureIndicator' => isset($claim->claimFormattable->patientOrInsuredInformation)
                                ? ((true == $claim->claimFormattable->patientOrInsuredInformation->insured_signature)
                                    ? 'Y'
                                    : 'N')
                                : 'N',
                            'planParticipationCode' => 'A',
                            'benefitsAssignmentCertificationIndicator' => 'Y',
                            'releaseInformationCode' => 'Y',
                            'claimSupplementalInformation' => [
                                'repricedClaimNumber' => '00001', /* Type 45 Donde lo guardo?. Los códigos del catálogo son diferentes */
                                'claimNumber' => '12345', /* ?? */
                            ],
                            'healthCareCodeInformation' => $claimDiagnoses ?? null,
                            'serviceFacilityLocation' => null,
                            'serviceLines' => $serviceLines,
                        ],
                    ];

                    $response = Http::withToken($token)->acceptJson()->post(
                        $data[env('CHANGEHC_CONNECTION', 'sandbox')]['url'],
                        $data[env('CHANGEHC_CONNECTION', 'sandbox')]['body'] ?? $dataReal
                    );
                    $responseData['response'] = json_decode($response->body());
                    $responseData['request'] = $dataReal;
                }

                $claimValidation = ClaimValidation::updateOrCreate([
                    'control_number' => $newCode,
                    'claim_id' => $claim->id,
                    'insurance_policy_id' => $insurancePolicy->id,
                    'response_details' => isset($responseData) ? json_encode($responseData) : null,
                ]);

                if (isset($claimValidation)) {
                    $insurancePolicy['claim_validation'] = [
                        'control_number' => $claimValidation->control_number ?? null,
                        'claim_id' => $claimValidation->claim_id ?? null,
                        'insurance_policy' => $claimValidation->insurancePolicy ?? null,
                        'insurance_policy_id' => $claimValidation->insurance_policy_id ?? null,
                        'response_details' => json_decode($claimValidation->response_details ?? null),
                    ];
                } else {
                    $insurancePolicy['claim_validation'] = null;
                }

                array_push($insurancePolicies, $insurancePolicy);
            }
            DB::commit();

            return [
                'claim_id' => $claim->id,
                'insurance_policies' => $insurancePolicies,
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return $e;
        }
    }

    public function claimSubmit($token, $claimId, $batchId)
    {
        try {
            $pointers = [
                'A' => 1,
                'B' => 2,
                'C' => 3,
                'D' => 4,
                'E' => 5,
                'F' => 6,
                'G' => 7,
                'H' => 8,
                'I' => 9,
                'J' => 10,
                'K' => 11,
                'L' => 12,
            ];
            $qualifierFields = [
                '431' => 'symptomDate',
                '304' => 'lastSeenDate',
                '444' => 'firstContactDate',
                '453' => 'acuteManifestationDate',
                '439' => 'accidentDate',
                '455' => 'lastXRayDate',
                '090' => 'assumedAndRelinquishedCareBeginDate',
                '091' => 'assumedAndRelinquishedCareEndDate',
                '454' => 'initialTreatmentDate',
                '471' => 'hearingAndVisionPrescriptionDate',
            ];
            DB::beginTransaction();
            $data = [
                'sandbox' => [
                    'url' => 'https://sandbox.apigw.changehealthcare.com/medicalnetwork/professionalclaims/v3/submission',
                    'body' => [
                        'controlNumber' => '000000001',
                        'tradingPartnerServiceId' => '9496',
                        'submitter' => [
                            'organizationName' => 'REGIONAL PPO NETWORK',
                            'contactInformation' => [
                                'name' => 'SUBMITTER CONTACT INFO',
                                'phoneNumber' => '123456789',
                            ],
                        ],
                        'receiver' => [
                            'organizationName' => 'EXTRA HEALTHY INSURANCE',
                        ],
                        'subscriber' => [
                            'memberId' => '0000000001',
                            'paymentResponsibilityLevelCode' => 'P',
                            'firstName' => 'johnone',
                            'lastName' => 'doeOne',
                            'gender' => 'M',
                            'dateOfBirth' => '19800102',
                            'policyNumber' => '00001',
                            'address' => [
                                'address1' => '123 address1',
                                'city' => 'city1',
                                'state' => 'wa',
                                'postalCode' => '981010000',
                            ],
                        ],
                        'dependent' => [
                            'memberId' => '0000000002',
                            'paymentResponsibilityLevelCode' => 'P',
                            'firstName' => 'janeone',
                            'lastName' => 'doeOne',
                            'gender' => 'F',
                            'dateOfBirth' => '19800102',
                            'policyNumber' => '00002',
                            'relationshipToSubscriberCode' => '01',
                            'address' => [
                                'address1' => '123 address1',
                                'city' => 'city1',
                                'state' => 'wa',
                                'postalCode' => '981010000',
                            ],
                        ],

                        'providers' => [
                            [
                                'providerType' => 'BillingProvider',
                                'npi' => '1760854442',
                                'employerId' => '123456789',
                                'organizationName' => 'HAPPY DOCTORS GROUPPRACTICE',
                                'address' => [
                                    'address1' => '000 address1',
                                    'city' => 'city2',
                                    'state' => 'tn',
                                    'postalCode' => '372030000',
                                ],
                                'contactInformation' => [
                                    'name' => 'janetwo doetwo',
                                    'phoneNumber' => '0000000001',
                                ],
                            ],
                            [
                                'providerType' => 'ReferringProvider',
                                'npi' => '1942788757',
                                'firstName' => 'johntwo',
                                'lastName' => 'doetwo',
                                'employerId' => '123456',
                            ],
                            [
                                'providerType' => 'RenderingProvider',
                                'npi' => '1942788757',
                                'firstName' => 'janetwo',
                                'lastName' => 'doetwo',
                                'middleName' => 'middletwo',
                                'ssn' => '000000000',
                            ],
                        ],
                        'claimInformation' => [
                            'claimFilingCode' => 'CI',
                            'patientControlNumber' => '12345',
                            'claimChargeAmount' => '28.75',
                            'placeOfServiceCode' => '11',
                            'claimFrequencyCode' => '1',
                            'signatureIndicator' => 'Y',
                            'planParticipationCode' => 'A',
                            'benefitsAssignmentCertificationIndicator' => 'Y',
                            'releaseInformationCode' => 'Y',
                            'claimSupplementalInformation' => [
                                'repricedClaimNumber' => '00001',
                                'claimNumber' => '12345',
                            ],
                            'healthCareCodeInformation' => [
                                [
                                    'diagnosisTypeCode' => 'BK',
                                    'diagnosisCode' => '496',
                                ],
                                [
                                    'diagnosisTypeCode' => 'BF',
                                    'diagnosisCode' => '25000',
                                ],
                            ],
                            'serviceFacilityLocation' => [
                                'organizationName' => 'HAPPY DOCTORS GROUP',
                                'address' => [
                                    'address1' => '000 address1',
                                    'city' => 'city2',
                                    'state' => 'tn',
                                    'postalCode' => '372030000',
                                ],
                            ],
                            'serviceLines' => [
                                [
                                    'serviceDate' => '20050514',
                                    'professionalService' => [
                                        'procedureIdentifier' => 'HC',
                                        'lineItemChargeAmount' => '25',
                                        'procedureCode' => 'E0570',
                                        'measurementUnit' => 'UN',
                                        'serviceUnitCount' => '1',
                                        'compositeDiagnosisCodePointers' => [
                                            'diagnosisCodePointers' => ['1', '2'],
                                        ],
                                    ],
                                ],
                                [
                                    'serviceDate' => '20050514',
                                    'professionalService' => [
                                        'procedureIdentifier' => 'HC',
                                        'lineItemChargeAmount' => '3.75',
                                        'procedureCode' => 'A7003',
                                        'measurementUnit' => 'UN',
                                        'serviceUnitCount' => '1',
                                        'compositeDiagnosisCodePointers' => [
                                            'diagnosisCodePointers' => ['1'],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'production' => [
                    'url' => 'https://apigw.changehealthcare.com/medicalnetwork/professionalclaims/v3/submission',
                    'body' => null,
                ],
            ];

            $claim = Claim::with([
                'company',
                'diagnoses',
                // "insuranceCompany",
                'insurancePolicies',
                'claimFormattable' => function ($query) {
                    $query->with([
                        'billingCompany' => function ($q) {
                            $q->with('contacts', 'addresses');
                        },
                        'claimFormServices' => function ($q) {
                            $q->with('typeOfService');
                        },
                    ]);
                },
            ])->find($claimId);

            $patient = Patient::with([
                'insurancePolicies' => function ($query) {
                    $query->with('typeResponsibility');
                },
                'user.profile',
            ])->find($claim->patient_id);
            $insurancePolicies = [];
            $claimInsurancePolicies = [];

            foreach ($claim->insurancePolicies ?? [] as $insurancePolicy) {
                array_push($claimInsurancePolicies, $insurancePolicy->id);
            }

            foreach ($patient->insurancePolicies()->whereIn('insurance_policies.id', $claimInsurancePolicies)->get() ?? [] as $insurancePolicy) {
                $subscriber =
                    (($insurancePolicy->own ?? false) == true)
                        ? $patient->user
                        : $insurancePolicy?->subscriber;
                $addressSubscriber = $subscriber->addresses->first();
                $addressPatient = $patient->user->addresses->first();
                $addressCompany = $claim->company->addresses->first();
                $contactCompany = $claim->company->contacts->first();

                $dependent = (($insurancePolicy->own ?? false) == true)
                    ? null
                    : [
                        'memberId' => $patient->code ?? null,
                        'paymentResponsibilityLevelCode' => $insurancePolicy->payment_responsibility_level_code ?? 'P',
                        'firstName' => $patient->user->profile->first_name ?? null,
                        'lastName' => $patient->user->profile->last_name ?? null,
                        'gender' => strtoupper($patient->user->profile->sex ?? 'M'),
                        'dateOfBirth' => str_replace('-', '', $patient->user->profile->date_of_birth),
                        'policyNumber' => $insurancePolicy->policy_number ?? null,
                        'relationshipToSubscriberCode' => $subscriber->relationship->code ?? '21', /* Si no existe, descococido */
                        'address' => [
                            'address1' => $addressPatient->address ?? null,
                            'city' => $addressPatient->city ?? null,
                            'state' => substr($addressPatient->state ?? '', 0, 2) ?? null,
                            'postalCode' => str_replace('-', '', $addressPatient->zip),
                        ],
                    ];
                $claimServiceLinePrincipal = $claim->claimFormattable->claimFormServices->first();
                $claimDiagnoses = [];

                foreach ($claim->diagnoses ?? [] as $diagnosis) {
                    if (0 == count($claimDiagnoses)) {
                        array_push($claimDiagnoses, [
                            'diagnosisTypeCode' => 'ABK',
                            'diagnosisCode' => $diagnosis->code,
                        ]);
                    } else {
                        array_push($claimDiagnoses, [
                            'diagnosisTypeCode' => 'ABF',
                            'diagnosisCode' => $diagnosis->code,
                        ]);
                    }
                }

                $facility = $claim->facility;
                $addressFacility = $claim->facility?->addresses->first();

                if (isset($facility) && isset($addressFacility)) {
                    $serviceFacilityLocation = [
                        'organizationName' => $facility->name,
                        'address' => [
                            'address1' => $addressFacility->address ?? null,
                            'city' => $addressFacility->city ?? null,
                            'state' => substr($addressFacility->state ?? '', 0, 2) ?? null,
                            'postalCode' => str_replace('-', '', $addressFacility->zip),
                        ],
                    ];
                }

                $serviceLines = [];

                foreach ($claim->claimFormattable->claimFormServices ?? [] as $service) {
                    $valuesPoint = [];
                    foreach ($service->diagnostic_pointers as $point) {
                        array_push($valuesPoint, $pointers[$point]);
                    }
                    array_push($serviceLines, [
                        'serviceDate' => str_replace('-', '', $service->from_service),
                        'serviceDateEnd' => !empty($service->to_service)
                            ? str_replace('-', '', $service->to_service)
                            : null,
                        'professionalService' => [
                            'procedureIdentifier' => 'HC' /* No esta, Loop2400 SV101-01 * */,
                            'lineItemChargeAmount' => str_replace(',', '', $service->price),
                            'procedureCode' => $service->procedure->code,
                            'measurementUnit' => 'UN', /**Si es el mismo dias se expresa en min 'MJ' */
                            'serviceUnitCount' => $service->days_or_units ?? '1',
                            'compositeDiagnosisCodePointers' => [
                                'diagnosisCodePointers' => $valuesPoint ?? [],
                            ],
                        ],
                    ]);
                }
                $provider = $claim->referred;
                $providerProfile = $provider?->user?->profile;
                if ($providerProfile) {
                    $referred = [
                        'providerType' => 'ReferringProvider',
                        'npi' => str_replace('-', '', $provider->npi ?? ''),
                        'firstName' => $providerProfile->first_name,
                        'lastName' => $providerProfile->last_name,
                        'employerId' => str_replace('-', '', $provider->ein ?? $provider->npi),
                    ];
                }

                $claimDateInfo = [];
                foreach ($claim->claimFormattable?->physicianOrSupplierInformation?->claimDateInformations ?? [] as $dateInfo) {
                    $qualifier = $dateInfo?->qualifier?->code ?? '';
                    if (isset($qualifierFields[$qualifier])) {
                        if ((1 == $dateInfo->field_id) || (2 == $dateInfo->field_id)) {
                            $claimDateInfo[$qualifierFields[$qualifier]] = $dateInfo->from_date_or_current;
                        }
                    } elseif (3 == $dateInfo->field_id) {
                        if (!empty($dateInfo->from_date_or_current)) {
                            $claimDateInfo['lastWorkedDate'] = $dateInfo->from_date_or_current;
                        }
                        if (!empty($dateInfo->to_date)) {
                            $claimDateInfo['authorizedReturnToWorkDate'] = $dateInfo->to_date;
                        }
                    } elseif (4 == $dateInfo->field_id) {
                        if (!empty($dateInfo->from_date_or_current)) {
                            $claimDateInfo['admissionDate'] = $dateInfo->from_date_or_current;
                        }
                        if (!empty($dateInfo->to_date)) {
                            $claimDateInfo['dischargeDate'] = $dateInfo->to_date;
                        }
                    }
                }

                $dataReal = [
                    'controlNumber' => $claim->control_number,
                    'tradingPartnerServiceId' => '9496', /* Caso de prueba */
                    'usageIndicator' => 'T',  /* Caso de prueba */
                    'tradingPartnerName' => $insurancePolicy->insurancePlan->insuranceCompany->name ?? null,
                    'submitter' => [/* Billing Company */
                        'organizationName' => $claim->claimFormattable->billingCompany->name ?? null,
                        'contactInformation' => [
                            'name' => $claim->claimFormattable->billingCompany->contact->contact_name ?? $claim->claimFormattable->billingCompany->name ?? 'Contact Billing',
                            'phoneNumber' => str_replace('-', '', $claim->claimFormattable->billingCompany->contact->phone ?? ''),
                        ],
                    ],
                    'receiver' => [/**Insurance Company */
                        'organizationName' => $insurancePolicy->insurancePlan->insuranceCompany->name ?? null,
                    ],
                    'subscriber' => [
                        'memberId' => $subscriber->member_id ?? $subscriber->id ?? null,
                        'paymentResponsibilityLevelCode' => $insurancePolicy->payment_responsibility_level_code ?? 'P',
                        'firstName' => $subscriber->first_name ?? $subscriber->profile->first_name,
                        'lastName' => $subscriber->last_name ?? $subscriber->profile->last_name,
                        'gender' => strtoupper($subscriber?->sex ?? $subscriber?->profile?->sex ?? 'M'),
                        'dateOfBirth' => str_replace('-', '', $subscriber->profile?->date_of_birth ?? $subscriber->date_of_birth),
                        'policyNumber' => $insurancePolicy->policy_number ?? null,
                        'address' => [
                            'address1' => $addressSubscriber->address ?? null,
                            'city' => $addressSubscriber->city ?? null,
                            'state' => substr($addressSubscriber->state ?? '', 0, 2) ?? null,
                            'postalCode' => str_replace('-', '', $addressSubscriber->zip),
                        ],
                    ],
                    'dependent' => $dependent ?? null,
                    'providers' => [/* Company */
                        [
                            'providerType' => 'BillingProvider',
                            'npi' => str_replace('-', '', $claim->company->npi ?? ''),
                            'employerId' => str_replace('-', '', $claim->company->ein ?? $claim->company->npi),
                            'organizationName' => $claim->company->name ?? null,
                            'address' => [
                                'address1' => $addressCompany->address ?? null,
                                'city' => $addressCompany->city ?? null,
                                'state' => substr($addressCompany->state ?? '', 0, 2),
                                'postalCode' => str_replace('-', '', $addressCompany->zip),
                            ],
                            'contactInformation' => [
                                'name' => $contactCompany->contact_name ?? $claim->company->name ?? 'Contact company',
                                'phoneNumber' => str_replace('-', '', $contactCompany->phone ?? ''),
                            ],
                        ],
                    ],
                    'claimInformation' => [
                        'claimFilingCode' => 'CI',
                        'patientControlNumber' => $claim->control_number, /**Preguntar xq no el el codePAtient Loop2300*/
                        'claimChargeAmount' => str_replace(',', '', $claim->billed_amount ?? '0.00'),
                        'placeOfServiceCode' => $claimServiceLinePrincipal->placeOfService->code ?? '11',
                        'claimFrequencyCode' => '1', /* Porque siempre 1 ?? */
                        'signatureIndicator' => isset($claim->claimFormattable->patientOrInsuredInformation)
                            ? ((true == $claim->claimFormattable->patientOrInsuredInformation->insured_signature)
                                ? 'Y'
                                : 'N')
                            : 'N',
                        'planParticipationCode' => 'A',
                        'benefitsAssignmentCertificationIndicator' => 'Y',
                        'releaseInformationCode' => 'Y',
                        'claimSupplementalInformation' => [
                            'repricedClaimNumber' => '00001', /* Type 45 Donde lo guardo?. Los códigos del catálogo son diferentes */
                            'claimNumber' => '12345', /* ?? */
                        ],
                        'healthCareCodeInformation' => $claimDiagnoses ?? null,
                        'serviceFacilityLocation' => $serviceFacilityLocation ?? null,
                        'serviceLines' => $serviceLines,
                    ],
                ];
                if (isset($referred)) {
                    array_push($dataReal['providers'], $referred);
                }
                $dataReal['claimInformation']['claimDateInformation'] = !empty($claimDateInfo)
                    ? $claimDateInfo
                    : null;

                $response = Http::withToken($token)->acceptJson()->post(
                    $data[env('CHANGEHC_CONNECTION', 'sandbox')]['url'],
                    $data[env('CHANGEHC_CONNECTION', 'sandbox')]['body'] ?? $dataReal
                );
                $responseData['response'] = json_decode($response->body());
                $responseData['request'] = $dataReal;

                if ($response->successful()) {
                    $claimTransmissionStatus = ClaimTransmissionStatus::whereStatus('Success')->first();
                    $statusSubmitted = ClaimStatus::whereStatus('Submitted')->first();

                    $this->changeStatus([
                        'status_id' => $statusSubmitted->id,
                        'private_note' => 'Submitted to ClearingHouse',
                    ], $claim->id);
                } elseif ($response->serverError()) {
                    $claimTransmissionStatus = ClaimTransmissionStatus::whereStatus('Error')->first();

                    $this->AddNoteCurrentStatus([
                        'private_note' => 'Error in transmission',
                    ], $claim->id);
                } elseif ($response->failed()) {
                    $claimTransmissionStatus = ClaimTransmissionStatus::whereStatus('Error')->first();
                    $statusDenied = ClaimStatus::whereStatus('Rejected')->first();

                    $this->changeStatus([
                        'status_id' => $statusDenied->id,
                        'private_note' => 'Submitted to ClearingHouse',
                    ], $claim->id);
                }

                $claimTransmissionResponse = ClaimTransmissionResponse::updateOrCreate([
                    'claim_id' => $claim->id,
                    'claim_batch_id' => $batchId,
                    'claim_transmission_status_id' => $claimTransmissionStatus->id,
                    'response_details' => isset($responseData) ? json_encode($responseData) : null,
                ]);
            }
            DB::commit();

            return $claim;
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    public function changeStatus($data, $id)
    {
        try {
            DB::beginTransaction();
            $claim = Claim::with('claimFormattable')->find($id);
            $status = $claim->claimStatusClaims()
                    ->where('claim_status_type', ClaimStatus::class)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('id', 'desc')->first()->claimStatus ?? null;

            if ($data['status_id'] != $status->id) {
                $claimStatus = ClaimStatus::find($data['status_id']);
                $claimStatusClaim = ClaimStatusClaim::create([
                    'claim_id' => $claim->id,
                    'claim_status_type' => ClaimStatus::class,
                    'claim_status_id' => $claimStatus->id,
                ]);
                if (empty($data['sub_status_id'])) {
                    PrivateNote::create([
                        'publishable_type' => ClaimStatusClaim::class,
                        'publishable_id' => $claimStatusClaim->id,
                        'billing_company_id' => $claim->claimFormattable->billing_company_id ?? null,
                        'note' => $data['private_note'],
                    ]);
                }
            }
            if (isset($data['sub_status_id'])) {
                $claimSubStatus = ClaimSubStatus::find($data['sub_status_id']);
                $claimStatusClaim = ClaimStatusClaim::create([
                    'claim_id' => $claim->id,
                    'claim_status_type' => ClaimSubStatus::class,
                    'claim_status_id' => $claimSubStatus->id,
                ]);
                PrivateNote::create([
                    'publishable_type' => ClaimStatusClaim::class,
                    'publishable_id' => $claimStatusClaim->id,
                    'billing_company_id' => $claim->claimFormattable->billing_company_id ?? null,
                    'note' => $data['private_note'],
                ]);
            }
            DB::commit();

            return $claim;
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    public function updateNoteCurrentStatus($data, $id)
    {
        try {
            DB::beginTransaction();
            $claim = Claim::with('claimFormattable', 'claimStatusClaims')->find($id);
            $statusClaim = $claim->claimStatusClaims()
                    ->orderBy('created_at', 'desc')
                    ->orderBy('id', 'desc')->first() ?? null;

            if (isset($statusClaim)) {
                PrivateNote::updateOrCreate([
                    'publishable_type' => ClaimStatusClaim::class,
                    'publishable_id' => $statusClaim->id,
                    'billing_company_id' => $claim->claimFormattable->billing_company_id ?? null,
                ], [
                    'note' => $data['private_note'],
                ]);
            }
            DB::commit();

            return $claim;
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    public function AddNoteCurrentStatus($data, $id)
    {
        try {
            DB::beginTransaction();
            $claim = Claim::with('claimFormattable', 'claimStatusClaims')->find($id);
            $statusClaim = $claim->claimStatusClaims()
                                 ->orderBy('created_at', 'desc')
                                 ->orderBy('id', 'desc')->first() ?? null;

            if (isset($statusClaim)) {
                PrivateNote::create([
                    'publishable_type' => ClaimStatusClaim::class,
                    'publishable_id' => $statusClaim->id,
                    'billing_company_id' => $claim->claimFormattable->billing_company_id ?? null,
                    'note' => $data['private_note'],
                ]);
            }
            DB::commit();

            return $claim;
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    public function AddCheckStatus($data, $id)
    {
        try {
            DB::beginTransaction();
            $claim = Claim::with('claimFormattable', 'claimStatusClaims')->find($id);
            $statusClaim = $claim->claimStatusClaims()
                                 ->orderBy('created_at', 'desc')
                                 ->orderBy('id', 'desc')->first() ?? null;

            if (isset($statusClaim)) {
                $note = PrivateNote::create([
                    'publishable_type' => ClaimStatusClaim::class,
                    'publishable_id' => $statusClaim->id,
                    'billing_company_id' => $claim->claimFormattable->billing_company_id ?? null,
                    'note' => $data['private_note'],
                ]);
                ClaimCheckStatus::create([
                    'response_details' => $data['response_details'] ?? null,
                    'interface_type' => $data['interface_type'] ?? null,
                    'interface' => $data['interface'] ?? null,
                    'consultation_date' => $data['consultation_date'] ?? null,
                    'resolution_time' => $data['resolution_time'] ?? null,
                    'past_due_date' => $data['past_due_date'] ?? null,
                    'private_note_id' => $note->id,
                ]);
            }
            DB::commit();

            return $claim;
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }
}

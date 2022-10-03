<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Models\TypeOfService;
use App\Models\PlaceOfService;
use App\Models\TypeForm;
use App\Models\ClaimStatus;
use App\Models\ClaimStatusClaim;
use App\Models\Claim;
use App\Models\ClaimEligibility;
use App\Models\ClaimFormP;
use App\Models\ClaimFormPService;
use App\Models\PrivateNote;
use App\Models\Patient;

class ClaimRepository
{
    /**
     * @param array $data
     * @return claim|Model
     */
    public function createClaim(array $data) {
        try {
            DB::beginTransaction();
            $newCode = 1;
            $targetModel = Claim::select("id", "control_number")->orderBy('created_at', 'desc')->orderBy('id', 'desc')->first();
            
            $newCode += ($targetModel) ? (int)$targetModel->control_number : 0;
            $newCode = str_pad($newCode, 9, "0", STR_PAD_LEFT);

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"] ?? null;
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            if (isset($data["format"])) {
                $typeFormat = TypeForm::find($data["format"]);
                if (isset($typeFormat)) {
                    if ($typeFormat->form == '837P') {
                        $model = ClaimFormP::class;
                        if (isset($data['claim_services'])) {
                            $claimForm = ClaimFormP::create([
                                'type_form_id' => $data['format'] ?? null,
                                'billing_company_id' => $billingCompany->id ?? $billingCompany
                            ]);
                            $claimForm->claimFormServices()->delete();
                            foreach ($data['claim_services'] as $service) {
                                $service["claim_form_p_id"] = $claimForm->id;
                                ClaimFormPService::create($service);
                            }
                        }
                    } else {
                        $model = ClaimFormI::class;
                    }
                }
            }

            $claim = Claim::create([
                "control_number"         => $newCode,
                "company_id"             => $data["company_id"] ?? null,
                "facility_id"            => $data["facility_id"] ?? null,
                "patient_id"             => $data["patient_id"] ?? null,
                "health_professional_id" => $data["health_professional_id"] ?? null,
                "claim_formattable_type" => $model ?? null,
                "claim_formattable_id"   => $claimForm->id ?? null,
            ]);

            if (isset($data['diagnoses'])) {
                $claim->diagnoses()->detach();
                foreach ($data['diagnoses'] as $diagnosis) {
                    $claim->diagnoses()->attach($diagnosis['diagnosis_id'], ['item' => $diagnosis['item']]);
                }
            }

            if (isset($data['insurance_policies'])) {
                $claim->insurancePolicies()->sync($data['insurance_policies']);
            }

            if (isset($data['private_note'])) {
                $claimStatus = ClaimStatus::whereStatus('Draft')->first();
                $claimStatusClaim = ClaimStatusClaim::create([
                    'claim_id'        => $claim->id,
                    'claim_status_id' => $claimStatus->id,
                ]);
                PrivateNote::create([
                    'publishable_type'   => ClaimStatusClaim::class,
                    'publishable_id'     => $claimStatusClaim->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'note'               => $data['private_note']
                ]);
            }

            DB::commit();
            return $claim;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    /**
     * @return claim[]|Collection
     */
    public function getAllClaims() {
        $claims = Claim::with([
            "company",
            "patient" => function ($query) {
                $query->with("user.profile");
            }
        ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        return is_null($claims) ? null : $claims;
    }

    /**
     * @param int $id
     * @return claim|Builder|Model|object|null
     */
    public function getOneclaim(int $id) {
        $claim = claim::with([
            "diagnoses",
            "insurancePolicies",
            "claimFormattable"
        ])->whereId($id)->first();

        return !is_null($claim) ? $claim : null;
    }

    /**
     * @param array $data
     * @param int $id
     * @return claim|Builder|Model|object|null
     */
    public function updateClaim(array $data, int $id) {
        try {
            DB::beginTransaction();
            $claim = Claim::find($id);

            $claimForm = $claim->claimFormattable;
            $claimForm->claimFormServices()->delete();
            $claimForm->delete();

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"] ?? null;
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            if (isset($data["format"])) {
                $typeFormat = TypeForm::find($data["format"]);
                if (isset($typeFormat)) {
                    if ($typeFormat->form == '837P') {
                        $model = ClaimFormP::class;
                        if (isset($data['claim_services'])) {
                            $claimForm = ClaimFormP::create([
                                'type_form_id' => $data['format'],
                                'billing_company_id' => $billingCompany->id ?? $billingCompany
                            ]);
                            foreach ($data['claim_services'] as $service) {
                                $service["claim_form_p_id"] = $claimForm->id;
                                ClaimFormPService::create($service);
                            }
                        }
                    } else {
                        $model = ClaimFormI::class;
                    }
                }
            }

            $claim->update([
                "company_id"             => $data["company_id"] ?? null,
                "facility_id"            => $data["facility_id"] ?? null,
                "patient_id"             => $data["patient_id"] ?? null,
                "health_professional_id" => $data["health_professional_id"] ?? null,
                "claim_formattable_type" => $model ?? null,
                "claim_formattable_id"   => $claimForm->id ?? null,
            ]);

            if (isset($data['diagnoses'])) {
                $claim->diagnoses()->detach();
                foreach ($data['diagnoses'] as $diagnosis) {
                    $claim->diagnoses()->attach($diagnosis['diagnosis_id'], ['item' => $diagnosis['item']]);
                }
            }

            if (isset($data['insurance_policies'])) {
                $claim->insurancePolicies()->sync($data['insurance_policies']);
            }

            if (isset($data['private_note'])) {
                $claimStatus = ClaimStatus::whereStatus('Draft')->first();
                $claimStatusClaim = ClaimStatusClaim::firstOrCreate([
                    'claim_id'        => $claim->id,
                    'claim_status_id' => $claimStatus->id,
                ]);
                PrivateNote::updateOrCreate([
                    'publishable_type'   => ClaimStatusClaim::class,
                    'publishable_id'     => $claimStatusClaim->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany
                ], [
                    'note'               => $data['private_note'],
                ]);
            }

            DB::commit();
            return Claim::whereId($id)->first();
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    public function getListTypeOfServices() {
        return getList(TypeOfService::class, ['code', '-', 'name']);
    }

    public function getListPlaceOfServices() {
        return getList(PlaceOfService::class, ['code', '-', 'name']);
    }

    public function getListRevCenters() {
        return getList(RevCenter::class, 'code');
    }

    public function getListTypeFormats() {
        return getList(TypeForm::class, 'form');
    }

    public function getListStatus() {
        return getList(ClaimStatus::class, 'status');
    }

    public function getSecurityAuthorizationAccessToken() {
        try {
            $response = Http::acceptJson()->post('https://sandbox.apigw.changehealthcare.com/apip/auth/v2/token', [
                'client_id'     => '7ULJqHZb91y2zP3lgD4xQ3A3jACdmPTF',
                'client_secret' => 'EBPadsDKoOuEoOWv',
                'grant_type'    => 'client_credentials'
            ]);
            $responseData = json_decode($response->body());
            return $responseData;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function checkEligibility($token, $id) {
        try {
            $claim = Claim::with(["patient", "company", "claimFormattable", "claimFormattable.claimFormServices.typeOfService"])->find($id);
            $patient = Patient::with(["insurancePolicies", "user.profile"])->find($claim->patient_id);
            $insurancePolicies = [];

            foreach ($patient->insurancePolicies ?? [] as $insurancePolicy) {
                $newCode = 1;
                $targetModel = ClaimEligibility::select("id", "control_number")->orderBy('created_at', 'desc')->orderBy('id', 'desc')->first();
                
                $newCode += ($targetModel) ? (int)$targetModel->control_number : 0;
                $newCode = str_pad($newCode, 9, "0", STR_PAD_LEFT);

                $encounter = [];
                $serviceCodes = [];

                foreach ($claim->claimFormattable->claimFormServices ?? [] as $service) {
                    $encounter["beginningDateOfService"] = str_replace("-", "", $service->from_service);
                    $encounter["endDateOfService"] = str_replace("-", "", $service->to_service);
                    array_push($serviceCodes, $service->typeOfService->code);
                }
                $encounter["serviceTypeCodes"] = $serviceCodes;

                $data = [
                    'controlNumber'           => $newCode,
                    'tradingPartnerServiceId' => $insurancePolicy->insurancePlan->insuranceCompany->code ?? null,
                    'provider' => [
                        'organizationName'        => $claim->company->name ?? null,
                        'npi'                     => $claim->company->npi ?? null,
                        'serviceProviderNumber'   => $claim->company->sevices_number ?? null,
                        'providerCode'            => $claim->company->code ?? null,
                        'referenceIdentification' => $claim->company->reference_identification ?? null
                    ],
                    'subscriber' => [
                        'memberId'    => $insurancePolicy->subscriber->member_id ?? null,
                        'firstName'   => $insurancePolicy->subscriber->first_name ?? $patient->user->profile->first_name,
                        'lastName'    => $insurancePolicy->subscriber->last_name ?? $patient->user->profile->last_name,
                        'gender'      => $insurancePolicy->subscriber ? null : strtoupper($patient->user->profile->sex),
                        'dateOfBirth' => $insurancePolicy->subscriber ? null : str_replace("-", "", $patient->user->profile->date_of_birth),
                        'ssn'         => $insurancePolicy->subscriber->ssn ?? $patient->user->profile->ssn,
                        'idCard'      => $insurancePolicy->subscriber->id_card ?? null
                    ],
                    'dependents' => [
                        [
                            'firstName'   => $patient->user->profile->first_name,
                            'lastName'    => $patient->user->profile->last_name,
                            'gender'      => strtoupper($patient->user->profile->sex),
                            'dateOfBirth' => str_replace("-", "", $patient->user->profile->date_of_birth),
                            'groupNumber' => $insurancePolicy->subscriber->group_number ?? null
                        ]
                    ],
                    'encounter' => $encounter
                ];
                $response = Http::withToken($token)->acceptJson()->post('https://sandbox.apigw.changehealthcare.com/medicalnetwork/eligibility/v3', $data);
                $responseData = json_decode($response->body());
                if (isset($responseData->errors)) return $responseData;

                $claimEligibility = ClaimEligibility::updateOrCreate([
                    "control_number"       => $newCode,
                    "company_id"           => $claim->company_id,
                    "patient_id"           => $patient->id,
                    "subscriber_id"        => $insurancePolicy->subscriber->id ?? null,
                    "insurance_policy_id"  => $insurancePolicy->id,
                    "insurance_company_id" => $insurancePolicy->insurance_company_id
                ]);
                $insurancePolicy['claim_eligibility'] = $claimEligibility ?? null;
                array_push($insurancePolicies, $insurancePolicy);
            }
            return $insurancePolicies;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    public function claimValidation($token, $id) {
        try {
            $claim = claim::with([
                "diagnoses",
                "insurancePolicies",
                "claimFormattable"
            ])->whereId($id)->first();

            $response = Http::withToken($token)->acceptJson()->post('https://sandbox.apigw.changehealthcare.com/medicalnetwork/professionalclaims/v3/validation', [
                "controlNumber" => "000000001",
                "tradingPartnerServiceId" => "9496",
                "submitter" => [
                    "organizationName" => "REGIONAL PPO NETWORK",
                    "contactInformation" => [
                        "name" => "SUBMITTER CONTACT INFO",
                        "phoneNumber" => "123456789"
                    ]
                ],
                "receiver" => [
                    "organizationName" => "EXTRA HEALTHY INSURANCE"
                ],
                "subscriber" => [
                    "memberId" => "0000000001",
                    "paymentResponsibilityLevelCode" => "P",
                    "firstName" => "johnone",
                    "lastName" => "doeOne",
                    "gender" => "M",
                    "dateOfBirth" => "19800102",
                    "policyNumber" => "00001",
                    "address" => [
                        "address1" => "123 address1",
                        "city" => "city1",
                        "state" => "wa",
                        "postalCode" => "981010000"
                    ]
                ],
                "dependent" => [
                    "memberId" => "0000000002",
                    "paymentResponsibilityLevelCode" => "P",
                    "firstName" => "janeone",
                    "lastName" => "doeOne",
                    "gender" => "F",
                    "dateOfBirth" => "19800102",
                    "policyNumber" => "00002",
                    "relationshipToSubscriberCode" => "01",
                    "address" => [
                        "address1" => "123 address1",
                        "city" => "city1",
                        "state" => "wa",
                        "postalCode" => "981010000"
                    ]
                ],

                "providers" => [
                    [
                        "providerType" => "BillingProvider",
                        "npi" => "1760854442",
                        "employerId" => "123456789",
                        "organizationName" => "HAPPY DOCTORS GROUPPRACTICE",
                        "address" => [
                            "address1" => "000 address1",
                            "city" => "city2",
                            "state" => "tn",
                            "postalCode" => "372030000"
                        ],
                        "contactInformation" => [
                            "name" => "janetwo doetwo",
                            "phoneNumber" => "0000000001"
                        ]
                    ],
                    [
                        "providerType" => "ReferringProvider",
                        "npi" => "1942788757",
                        "firstName" => "johntwo",
                        "lastName" => "doetwo",
                        "employerId" => "123456"
                    ],
                    [
                        "providerType" => "RenderingProvider",
                        "npi" => "1942788757",
                        "firstName" => "janetwo",
                        "lastName" => "doetwo",
                        "middleName" => "middletwo",
                        "ssn" => "000000000"
                    ]
                ],
                "claimInformation" => [
                    "claimFilingCode" => "CI",
                    "patientControlNumber" => "12345",
                    "claimChargeAmount" => "28.75",
                    "placeOfServiceCode" => "11",
                    "claimFrequencyCode" => "1",
                    "signatureIndicator" => "Y",
                    "planParticipationCode" => "A",
                    "benefitsAssignmentCertificationIndicator" => "Y",
                    "releaseInformationCode" => "Y",
                    "claimSupplementalInformation" => [
                        "repricedClaimNumber" => "00001",
                        "claimNumber" => "12345"
                    ],
                    "healthCareCodeInformation" => [
                        [
                            "diagnosisTypeCode" => "BK",
                            "diagnosisCode" => "496"
                        ],
                        [
                            "diagnosisTypeCode" => "BF",
                            "diagnosisCode" => "25000"
                        ]
                    ],
                    "serviceFacilityLocation" => [
                        "organizationName" => "HAPPY DOCTORS GROUP",
                        "address" => [
                            "address1" => "000 address1",
                            "city" => "city2",
                            "state" => "tn",
                            "postalCode" => "372030000"
                        ]
                    ],
                    "serviceLines" => [
                        [
                            "serviceDate" => "20050514",
                            "professionalService" => [
                                "procedureIdentifier" => "HC",
                                "lineItemChargeAmount" => "25",
                                "procedureCode" => "E0570",
                                "measurementUnit" => "UN",
                                "serviceUnitCount" => "1",
                                "compositeDiagnosisCodePointers" => [
                                    "diagnosisCodePointers" => ["1","2"]
                                ]
                            ]
                        ],
                        [
                            "serviceDate" => "20050514",
                            "professionalService" => [
                                "procedureIdentifier" => "HC",
                                "lineItemChargeAmount" => "3.75",
                                "procedureCode" => "A7003",
                                "measurementUnit" => "UN",
                                "serviceUnitCount" => "1",
                                "compositeDiagnosisCodePointers" => [
                                    "diagnosisCodePointers" => ["1" ]
                                ]
                            ]

                        ]
                    ]
                ]
            ]);
            $responseData = json_decode($response->body());
            return $responseData;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }
}

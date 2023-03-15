<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Facades\Pagination;
use App\Mail\GenerateNewPassword;
use App\Models\InsurancePlan;
use App\Models\InsurancePolicy;
use App\Models\InsurancePolicyType;
use App\Models\BillingCompany;
use App\Models\Company;
use App\Models\PatientConditionRelated;
use App\Models\Patient;
use App\Models\PatientPrivate;
use App\Models\PrivateNote;
use App\Models\PublicNote;
use App\Models\Profile;
use App\Models\SocialMedia;
use App\Models\SocialNetwork;
use App\Models\Address;
use App\Models\AddressType;
use App\Models\Contact;
use App\Models\Marital;
use App\Models\MaritalStatus;
use App\Models\Guarantor;
use App\Models\Employment;
use App\Models\EmergencyContact;
use App\Models\Subscriber;
use App\Models\User;
use App\Models\Injury;
use App\Roles\Models\Role;
use App\Models\TypeCatalog;

use function PHPSTORM_META\map;

class PatientRepository
{
    /**
     * @param array $data
     * @return User|Model|null
     */
    public function createPatient(array $data) {
        try {
            DB::beginTransaction();

            /** Create Profile */
            $profile = Profile::firstOrCreate([
                "ssn"           => $data["profile"]["ssn"] ?? '',
            ], [
                "ssn"           => $data["profile"]["ssn"] ?? '',
                "first_name"    => $data["profile"]["first_name"],
                "middle_name"   => $data["profile"]["middle_name"] ?? '',
                "last_name"     => $data["profile"]["last_name"],
                "sex"           => $data["profile"]["sex"],
                "date_of_birth" => $data["profile"]["date_of_birth"]
            ]);

            if (isset($data["profile"]["social_medias"])) {
                $socialMedias = $profile->socialMedias;
                /** Delete socialMedia */
                foreach ($socialMedias as $socialMedia) {
                    $validated = false;
                    $socialNetwork = $socialMedia->SocialNetwork;
                    if (isset($socialNetwork)) {
                        foreach ($data["profile"]["social_medias"] as $socialM) {
                            if ($socialM['name'] == $socialNetwork->name) {
                                $validated = true;
                                break;
                            }
                        }
                    }
                    if (!$validated) $socialMedia->delete();
                }

                /** update or create new social medias */
                foreach ($data["profile"]["social_medias"] as $socialMedia) {
                    $socialNetwork = SocialNetwork::whereName($socialMedia["name"])->first();
                    if (isset($socialNetwork)) {
                        SocialMedia::updateOrCreate([
                            "profile_id"        => $profile->id,
                            "social_network_id" => $socialNetwork->id
                        ], [
                            "link" => $socialMedia["link"]
                        ]);
                    }
                }
            }

            /** Create User */
            $user = User::firstOrCreate([
                "email"      => $data['contact']['email'],
            ], [
                "usercode"   => generateNewCode("US", 5, date("y"), User::class, "usercode"),
                "email"      => $data['contact']['email'],
                "language"   => $data['language'] ?? 'en',
                "userkey"    => encrypt(uniqid("", true)),
                "profile_id" => $profile->id
            ]);

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            /** Attach billing company */
            $user->billingCompanies()->sync($billingCompany->id ?? $billingCompany);
            
            /** Create Contact */
            if (isset($data['contact'])) {
                $data["contact"]["contactable_id"]     = $user->id;
                $data["contact"]["contactable_type"]   = User::class;
                $data["contact"]["billing_company_id"] = $billingCompany->id ?? $billingCompany;
                Contact::firstOrCreate([
                    "contactable_id"     => $user->id,
                    "contactable_type"   => User::class,
                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                ], $data["contact"]);
            }

            /** Create Address */
            if (isset($data['addresses'])) {
                foreach ($data['addresses'] as $address) {
                    $address["addressable_id"]     = $user->id;
                    $address["addressable_type"]   = User::class;
                    $address["billing_company_id"] = $billingCompany->id ?? $billingCompany;
                    Address::firstOrCreate([
                        "addressable_id"     => $user->id,
                        "addressable_type"  => User::class,
                        "billing_company_id" => $billingCompany->id ?? $billingCompany,
                    ], $address);
                }
            }

            /** Create Patient */
            $patient = Patient::firstOrCreate([
                "user_id"           => $user->id
            ], [
                "code"              => generateNewCode("PA", 5, date("y"), Patient::class, "code"),
                "driver_license"    => $data["driver_license"] ?? '',
                "marital_status_id" => $data["marital_status_id"] ?? null,
                "user_id"           => $user->id
            ]);

            if (is_null($patient->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $patient->billingCompanies()->attach($billingCompany->id ?? $billingCompany, [
                    'save_as_draft' => $data["save_as_draft"] ?? false
                ]);
            } else {
                $patient->billingCompanies()->updateExistingPivot(
                    $billingCompany->id ?? $billingCompany,
                    [
                        'status' => true,
                        'save_as_draft' => $data["save_as_draft"] ?? false
                    ]
                );
            }

            if (isset($data['public_note'])) {
                /** PublicNote */
                PublicNote::updateOrCreate([
                    'publishable_type' => Patient::class,
                    'publishable_id'   => $patient->id,
                ], [
                    'note'             => $data['public_note'],
                ]);
            }

            if (isset($data['private_note'])) {
                /** PrivateNote */
                PrivateNote::firstOrCreate([
                    'publishable_type'   => Patient::class,
                    'publishable_id'     => $patient->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'publishable_type'   => Patient::class,
                    'publishable_id'     => $patient->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'note'               => $data['private_note'],
                ]);
            }

            /** Create Marital */
            if (isset($data['marital']['spuse_name'])) {
                $data["marital"]["patient_id"] = $patient->id;
                $marital = Marital::firstOrCreate([
                    "patient_id" => $patient->id,
                ], $data["marital"]);
            }

            /** Create Guarantor */
            if (isset($data['guarantor']['name'])) {
                $data["guarantor"]["patient_id"] = $patient->id;
                $guarantor = Guarantor::firstOrCreate([
                    "patient_id" => $patient->id,
                ], $data["guarantor"]);
            }

            /** Create Employment */
            if (isset($data["employments"])) {
                foreach ($data["employments"] as $employment) {
                    $employment["patient_id"] = $patient->id;
                    Employment::firstOrCreate([
                        "patient_id" => $patient->id,
                    ], $employment);
                }
            }

            /** Emergency Contacts */
            if (isset($data["emergency_contacts"])) {
                $emergencyContacts = $patient->emergencyContacts;
                /** Delete energencyContact */
                foreach ($emergencyContacts as $emergencyContact) {
                    $validated = false;
                    foreach ($data["emergency_contacts"] as $emergencyC) {
                        if ($emergencyC['name'] == $emergencyContact->name) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) $emergencyContact->delete();
                }

                /** update or create new emergency contact */
                foreach ($data["emergency_contacts"] as $emergencyContact) {
                    EmergencyContact::updateOrCreate([
                        "name"       => $emergencyContact["name"],
                        "patient_id" => $patient->id
                    ], [
                        "name"            => $emergencyContact["name"],
                        "cellphone"       => $emergencyContact["cellphone"],
                        "relationship_id" => $emergencyContact["relationship_id"],
                        "patient_id"      => $patient->id
                    ]);
                }
            }

            /** Company */
            if (isset($data["company_id"])) {
                /** Attached patient to company */
                $company = Company::find($data["company_id"]);
                if (is_null($patient->companies()->find($company->id))) {
                    $patient->companies()->attach($company->id, [
                        'med_num' => $data["company_med_num"] ?? '',
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    ]);
                }
            }

            /** Insurance Policies */
            if (isset($data["insurance_policies"])) {
                $insurancePlans = $patient->insurancePlans;
                /** Detach Insurance plan */
                foreach ($insurancePlans as $insurancePlan) {
                    $validated = false;
                    foreach ($data["insurance_policies"] as $insurancePolicy) {
                        if ($insurancePolicy['insurance_plan'] == $insurancePlan->id) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) $patient->insurancePlans()->detach($insurancePlan->id);
                }

                /** Attach new insurance plan*/
                foreach ($data["insurance_policies"] as $insurance_policy) {

                    /** Attached patient to insurance plan */
                    $insurancePlan = InsurancePlan::find($insurance_policy["insurance_plan"]);

                    $insurancePolicy = InsurancePolicy::updateOrCreate([
                        'policy_number'     => $insurance_policy["policy_number"],
                        'insurance_plan_id' => $insurancePlan->id
                    ], [
                        'group_number'             => $insurance_policy["group_number"] ?? '',
                        'eff_date'                 => $insurance_policy["eff_date"],
                        'end_date'                 => $insurance_policy["end_date"] ?? null,
                        'insurance_policy_type_id' => $insurance_policy["insurance_policy_type_id"] ?? null,
                        'type_responsibility_id'   => $insurance_policy["type_responsibility_id"],
                        'release_info'             => $insurance_policy["release_info"],
                        'assign_benefits'          => $insurance_policy["assign_benefits"]

                    ]);

                    /** Attach insurance policy to patient */
                    if (is_null($patient->insurancePolicies()->find($insurancePolicy->id))) {
                        $patient->insurancePolicies()->attach($insurancePolicy->id, [
                            'own_insurance' => $insurance_policy["own_insurance"]
                        ]);
                    } else {
                        $patient->insurancePolicies()->updateExistingPivot($insurancePolicy->id, [
                            'own_insurance' => $insurance_policy["own_insurance"]
                        ]);
                    }
                    
                    if (is_null($patient->insurancePlans()->find($insurancePlan->id))) {
                        $patient->insurancePlans()->attach($insurancePlan->id);
                    }

                    if ($insurance_policy["own_insurance"] == false) {

                        /** The subscriber is searched for each billing company */

                        $subscriber = Subscriber::firstOrCreate([
                            "ssn"         => $insurance_policy["subscriber"]["ssn"],
                            "first_name" => upperCaseWords($insurance_policy["subscriber"]["first_name"]),
                            "last_name" => upperCaseWords($insurance_policy["subscriber"]["last_name"]),
                            "date_of_birth" => $insurance_policy["subscriber"]["date_of_birth"] ?? null
                        ], [
                            "first_name" => $insurance_policy["subscriber"]["first_name"],
                            "last_name" => $insurance_policy["subscriber"]["last_name"],
                            "date_of_birth" => $insurance_policy["subscriber"]["date_of_birth"] ?? null,
                            "relationship_id" => $insurance_policy["subscriber"]["relationship_id"] ?? null,
                        ]);

                        if (isset($subscriber)) {
                            /** Create Contact */
                            if (isset($insurance_policy["subscriber"]['contact'])) {
                                Contact::updateOrCreate([
                                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                                    "contactable_id"     => $subscriber->id,
                                    "contactable_type"   => Subscriber::class
                                ], $insurance_policy["subscriber"]["contact"]);
                            }

                            /** Create Address */
                            if (isset($insurance_policy["subscriber"]['address'])) {
                                Address::updateOrCreate([
                                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                                    "addressable_id"     => $subscriber->id,
                                    "addressable_type"   => Subscriber::class
                                ], $insurance_policy["subscriber"]["address"]);
                            }
                            /** Attached patient to subscriber */
                            if (is_null($patient->subscribers()->find($subscriber->id))) {
                                $patient->subscribers()->attach($subscriber->id);
                            }
                            
                            /** Attached subscriber to insurance plan */
                            /**if (is_null($subscriber->insurancePlans()->find($insurance_policy["insurance_plan"]))) {
                                $subscriber->insurancePlans()->attach($insurance_policy["insurance_plan"]);
                            }*/

                            /** Attached patient to subscriber */
                            if (is_null($insurancePolicy->subscribers()->find($subscriber->id))) {
                                $insurancePolicy->subscribers()->attach($subscriber->id);
                            }
                        }
                    }
                }

                /**if (isset($data['injuries'])) {
                    foreach ($data['injuries'] as $injury) {
                        $patientInjury = Injury::updateOrCreate(
                            [
                                'diag_date'    => $injury['diag_date'],
                                'diagnosis_id' => $injury['diagnosis_id'],
                                'type_diag_id' => $injury['type_diag_id'],
                            ],
                            [
                                'diag_date'    => $injury['diag_date'],
                                'diagnosis_id' => $injury['diagnosis_id'],
                                'type_diag_id' => $injury['type_diag_id'],
                            ]
                        );
                        if (isset($injury['public_note'])) {
                            /** PublicNote
                            PublicNote::create([
                                'publishable_type' => Injury::class,
                                'publishable_id'   => $patientInjury->id,
                                'note'             => $injury['public_note'],
                            ]);
                        }
                        if (isset($patientInjury)) {
                            if (is_null($patient->injuries()->find($patientInjury->id))) {
                                $patient->injuries()->attach($patientInjury->id);
                            }
                        }
                    }
                }*/
            }
            if ($user && $patient) {
                $rolePatient = Role::where('slug', 'patient')->first();
                $user->attachRole($rolePatient);
                
                if ($user->token == '') {
                    $token = encrypt($user->id . "@#@#$" . $user->email);
                    $user->token = $token;
                    $user->save();
                } else {
                    $token = $user->token;
                }

                \Mail::to($user->email)->send(
                    new GenerateNewPassword(
                        $profile->first_name . ' ' . $profile->last_name,
                        $user->email,
                        \Crypt::decrypt($user->userkey),
                        env('URL_FRONT') . "/#/newCredentials?mcctoken=" . $token
                    )
                );
            } else {
                DB::rollBack();
                return null;
            }


            DB::commit();
            return $patient;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param int $id
     * @return Patient|Builder|Model|object|null
     */
    public function getOnePatient(int $id) {
        $patient = Patient::with([
            "user" => function ($query) {
                $query->with(["profile" => function ($q) {
                    $q->with("socialMedias");
                }, "roles", "addresses", "contacts", "billingCompanies"]);
            },
            "maritalStatus",
            "marital",
            "insurancePolicies",
            "insurancePlans" => function ($query) {
                $query->with([
                    "insuranceCompany"
                ]);
            },
            "billingCompanies",
            "guarantor",
            "emergencyContacts",
            "employments",
            "publicNote",
            "privateNotes"
        ])->find($id);
        
        if (auth()->user()->hasRole('superuser')) {
            $dataCompany = $patient->companies;
            $dataClaim = $patient->claims()->with(
                [
                    "company" => function ($query) {
                        $query->with('nicknames');
                    },
                ])->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                ->paginate(Pagination::itemsPerPage());
            $dataPolicies = $patient->insurancePolicies()
                ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                ->paginate(Pagination::itemsPerPage());
        } else {
            $billingCompany = auth()->user()->billingCompanies->first();
            $dataCompany = $patient->companies()
                ->wherePivot('billing_company_id', $billingCompany->id)
                ->get();
            $dataClaim = $patient->claims()
                ->with([
                    "company" => function ($query) use ($billingCompany){
                        $query->with([
                            "nicknames" => function ($q) use ($billingCompany) {
                                $q->where('billing_company_id', $billingCompany->id);
                            }
                        ]);
                    },
                ])->whereHas('claimFormattable', function ($query) use ($billingCompany) {
                    $query->where('billing_company_id', $billingCompany->id);
                })->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                ->paginate(Pagination::itemsPerPage());
            $dataPolicies = $patient->insurancePolicies()
                ->whereHas('insurancePlan.billingCompanies', function ($query) use ($billingCompany) {
                    $query->where('billing_company_id', $billingCompany->id ?? $billingCompany);
                })->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                ->paginate(Pagination::itemsPerPage());
        }

        $companyRecords = [];
        foreach ($dataCompany as $company) {
            array_push($companyRecords, [
                'billing_company_id' => $company->pivot->billing_company_id,
                'company_id'         => $company->id,
                'med_num'            => $company->pivot->med_num,
                'company'            => $company->name,
                'billing_company'    => $company->billingCompanies()
                    ->find($company->pivot->billing_company_id)->name ?? null,
            ]);
        }

        $claimRecords = [
            'data'          => $dataClaim->items(),
            'numberOfPages' => $dataClaim->lastPage(),
            'count'         => $dataClaim->total()
        ];

        $dataPolicies->getCollection()->transform(function ($patient_policy) {
            return [
                'billing_company_id' => $patient_policy->pivot->billing_company_id,
                'billing_company' => BillingCompany::find($patient_policy->pivot->billing_company_id)->name ?? '',
                "id"                       => $patient_policy->id,
                "policy_number"            => $patient_policy->policy_number,
                "group_number"             => $patient_policy->group_number,
                "insurance_company_id"     => $patient_policy->insurancePlan->insurance_company_id ?? '',
                "insurance_company"        => ($patient_policy->insurancePlan->insuranceCompany->payer_id ?? '') . ' - ' . $patient_policy->insurancePlan->insuranceCompany->name ?? '',
                "insurance_plan_id"        => $patient_policy->insurance_plan_id ?? '',
                "insurance_plan"           => $patient_policy->insurancePlan->name ?? '',
                "type_responsibility_id"   => $patient_policy->type_responsibility_id ?? '',
                "type_responsibility"      => $patient_policy->typeResponsibility->code ?? '',
                "insurance_policy_type_id" => $patient_policy->insurance_policy_type_id ?? '',
                "insurance_policy_type"    => $patient_policy->insurancePolicyType->description ?? '',
                "eligibility"              => $patient_policy->claimLastEligibility->claimEligibilityStatus ?? null,
                "status"                   => $patient_policy->pivot->status ?? false,
                "eff_date"                 => $patient_policy->eff_date,
                "end_date"                 => $patient_policy->end_date,
                "assign_benefits"          => $patient_policy->assign_benefits ?? false,
                "release_info"             => $patient_policy->release_info ?? false,
                "own_insurance"            => $patient_policy->pivot->own_insurance ?? false,
                "subscriber"               => $patient_policy_subscriber ?? null,
            ];
        });
        $policiesRecords = [
            'data'          => $dataPolicies->items(),
            'numberOfPages' => $dataPolicies->lastPage(),
            'count'         => $dataPolicies->total()
        ];

        $record = [
            "id"                => $patient->id,
            "code"              => $patient->code,
            "profile"           => [
                "ssn"           => $patient->user->profile->ssn ?? '',
                "first_name"    => $patient->user->profile->first_name ?? '',
                "middle_name"   => $patient->user->profile->middle_name ?? '',
                "last_name"     => $patient->user->profile->last_name ?? '',
                "date_of_birth" => $patient->user->profile->date_of_birth ?? '',
                "sex"           => $patient->user->profile->sex ?? '',
            ],
            "driver_license"    => $patient->driver_license ?? '',
            "language"          => $patient->user->language ?? '',
            "companies"         => $companyRecords ?? null,
            "claims"            => $claimRecords ?? null,
            "insurance_policies" => $policiesRecords ?? null,

            "created_at"        => $patient->created_at,
            "updated_at"        => $patient->updated_at,
            "last_modified"     => $patient->last_modified,
            "public_note"       => isset($patient->publicNote) ? $patient->publicNote->note : null,
        ];

        $record['billing_companies'] = [];
        foreach ($patient->billingCompanies as $billingCompany) {
            $addresses = Address::where([
                "addressable_id"     => $patient->user->id,
                "addressable_type"   => User::class,
                "billing_company_id" => $billingCompany->id ?? $billingCompany
            ])->get();
            $contact = Contact::where([
                "contactable_id"     => $patient->user->id,
                "contactable_type"   => User::class,
                "billing_company_id" => $billingCompany->id ?? $billingCompany
            ])->first();
            $private_note = PrivateNote::where([
                "publishable_id"     => $patient->id,
                "publishable_type"   => Patient::class,
                "billing_company_id" => $billingCompany->id ?? $billingCompany
            ])->first();
            $companies = $patient->companies()->where('billing_company_id', $billingCompany->id ?? $billingCompany)->get();

            $insurance_policies = $patient->insurancePolicies()->whereHas('insurancePlan.billingCompanies', function ($query) use ($billingCompany) {
                $query->where('billing_company_id', $billingCompany->id ?? $billingCompany);
            })->get();

            /** Change to private data */
            $guarantor = $patient->guarantor;
            $emergency_contacts = $patient->emergencyContacts;
            $employments = $patient->employments;
            $social_medias = $patient->user->profile->socialMedias;

            if (isset($social_medias)) {
                $patient_social_medias = [];
                foreach ($social_medias as $social_media) {
                    array_push($patient_social_medias, [
                        "link" => $social_media->link,
                        "social_network" => $social_media->socialNetwork->name ?? '',
                        "social_network_id" => $social_media->social_network_id
                    ]);
                }
            };

            if (isset($guarantor)) {
                $patient_guarantor = [
                    "name" => $guarantor->name,
                    "phone" => $guarantor->phone,
                ];
            };
            if (isset($emergency_contacts)) {
                $patient_emergency_contacts = [];
                foreach ($emergency_contacts as $emergency_contact) {
                    array_push($patient_emergency_contacts, [
                        "name" => $emergency_contact->name,
                        "cellphone" => $emergency_contact->cellphone,
                        "relationship_id" => $emergency_contact->relationship_id,
                        "relationship" => $emergency_contact->relationship->description,
                    ]);
                }
            };

            if (isset($employments)) {
                $patient_employments = [];
                foreach ($employments as $employment) {
                    array_push($patient_employments, [
                        "employer_name" => $employment->employer_name,
                        "employer_address" => $employment->employer_address,
                        "employer_phone" => $employment->employer_phone,
                        "position" => $employment->position
                    ]);
                }
            };

            if (isset($addresses)) {
                $patient_addresses = [];
                foreach ($addresses as $address) {
                    array_push($patient_addresses, [
                        "zip"                      => $address->zip,
                        "city"                     => $address->city,
                        "state"                    => $address->state,
                        "address"                  => $address->address,
                        "country"                  => $address->country,
                        "address_type_id"          => $address->address_type_id,
                        "address_type"             => $address->addressType->name ?? '',
                        "country_subdivision_code" => $address->country_subdivision_code
                    ]);
                }
            };

            if (isset($contact)) {
                $patient_contact = [
                    "fax"          => $contact->fax,
                    "email"        => $contact->email,
                    "phone"        => $contact->phone,
                    "mobile"       => $contact->mobile,
                    "contact_name" => $contact->contact_name,
                ];
            };

            if (isset($companies)) {
                $patient_companies = [];
                foreach ($companies as $patient_company) {
                    array_push($patient_companies, [
                        "company_id" => $patient_company->id,
                        "company"    => $patient_company->name,
                        "med_num"    => $patient_company->pivot->med_num ?? '',
                    ]);
                }
            }

            if (isset($insurance_policies)) {
                $patient_policies = [];
                foreach ($insurance_policies as $patient_policy) {
                    $patient_policy_subscriber = [];
                    $subscriber = $patient_policy->subscribers->first();
                    if (isset($subscriber)) {
                        $address = Address::where([
                            "addressable_id"     => $subscriber->id,
                            "addressable_type"   => Subscriber::class,
                            "billing_company_id" => $billingCompany->id ?? $billingCompany
                        ])->first();
                        $contact = Contact::where([
                            "contactable_id"     => $subscriber->id,
                            "contactable_type"   => Subscriber::class,
                            "billing_company_id" => $billingCompany->id ?? $billingCompany
                        ])->first();
                        if (isset($address)) {
                            $subscriber_address = [
                                "zip"                      => $address->zip,
                                "city"                     => $address->city,
                                "state"                    => $address->state,
                                "address"                  => $address->address,
                                "country"                  => $address->country,
                                "address_type_id"          => $address->address_type_id,
                                "address_type"             => $address->addressType->name ?? '',
                                "country_subdivision_code" => $address->country_subdivision_code
                            ];
                        };

                        if (isset($contact)) {
                            $subscriber_contact = [
                                "fax"          => $contact->fax,
                                "email"        => $contact->email,
                                "phone"        => $contact->phone,
                                "mobile"       => $contact->mobile,
                                "contact_name" => $contact->contact_name,
                            ];
                        };
                        array_push($patient_policy_subscriber, [
                            "ssn" => $subscriber->ssn,
                            "first_name" => $subscriber->first_name,
                            "last_name"  => $subscriber->last_name,
                            "date_of_birth" => $subscriber->date_of_birth,
                            "relationship_id" => $subscriber->relationship_id,
                            "relationship" => $subscriber->relationship->description ?? '',
                            "address"         => isset($subscriber_address) ? $subscriber_address : null,
                            "contact"           => isset($subscriber_contact) ? $subscriber_contact : null,
                        ]);
                    }

                    array_push($patient_policies, [
                        "id"                       => $patient_policy->id,
                        "policy_number"            => $patient_policy->policy_number,
                        "group_number"             => $patient_policy->group_number,
                        "insurance_company_id"     => $patient_policy->insurancePlan->insurance_company_id ?? '',
                        "insurance_company"        => ($patient_policy->insurancePlan->insuranceCompany->payer_id ?? '') . ' - ' . $patient_policy->insurancePlan->insuranceCompany->name ?? '',
                        "insurance_plan_id"        => $patient_policy->insurance_plan_id ?? '',
                        "insurance_plan"           => $patient_policy->insurancePlan->name ?? '',
                        "type_responsibility_id"   => $patient_policy->type_responsibility_id ?? '',
                        "type_responsibility"      => $patient_policy->typeResponsibility->code ?? '',
                        "insurance_policy_type_id" => $patient_policy->insurance_policy_type_id ?? '',
                        "insurance_policy_type"    => $patient_policy->insurancePolicyType->description ?? '',
                        "eligibility"              => $patient_policy->claimLastEligibility->claimEligibilityStatus ?? null,
                        "status"                   => $patient_policy->pivot->status ?? false,
                        "eff_date"                 => $patient_policy->eff_date,
                        "end_date"                 => $patient_policy->end_date,
                        "assign_benefits"          => $patient_policy->assign_benefits ?? false,
                        "release_info"             => $patient_policy->release_info ?? false,
                        "own_insurance"            => $patient_policy->pivot->own_insurance ?? false,
                        "subscriber"               => $patient_policy_subscriber ?? null,
                    ]);
                }
            }

            array_push($record['billing_companies'], [
                "id"   => $billingCompany->id,
                "name" => $billingCompany->name,
                "code" => $billingCompany->code,
                "abbreviation" => $billingCompany->abbreviation,
                "private_patient" => [
                    "marital_status_id" => $patient->marital_status_id,
                    "marital_status"    => $patient->maritalStatus->name,
                    "marital"           => ($patient->maritalStatus->name ?? '' == 'Married') ? [
                        "spuse_name"       => $patient->marital->spuse_name ?? '',
                        "spuse_work"       => $patient->marital->spuse_work ?? '',
                        "spuse_work_phone" => $patient->marital->spuse_work_phone ?? '',
                    ] : null,
                    "companies"          => isset($patient_companies) ? $patient_companies : null,
                    "insurance_policies" => isset($patient_policies) ? $patient_policies : null,
                    "need_guardian"      => isset($patient_guarantor) ? true : false,
                    "guarantor"          => isset($patient_guarantor) ? $patient_guarantor : null,
                    "emergency_contacts" => isset($patient_emergency_contacts) ? $patient_emergency_contacts : [],
                    "employments"        => isset($patient_employments) ? $patient_employments : [],
                    "social_medias"      => isset($patient_social_medias) ? $patient_social_medias : [],
                    "status"             => $billingCompany->pivot->status ?? false,
                    "private_note"       => $private_note->note ?? '',
                    "addresses"          => isset($patient_addresses) ? $patient_addresses : null,
                    "contact"            => isset($patient_contact) ? $patient_contact : null,
                ]
            ]);
        }

        return !is_null($record) ? $record : null;
        return !is_null($patient) ? $patient : null;
    }

    /**
     * @param string $ssn
     * @return Patient|Builder|Model|object|null
     */
    public function getBySsn(string $ssn) {
        $patientId = Patient::whereHas("user", function ($query) use ($ssn) {
                $query->whereHas("profile", function ($q) use ($ssn) {
                    $q->where('ssn', $ssn);
                });
            })->first();
        $id = $patientId->id ?? null;

        $patient = Patient::with([
            "user" => function ($query) use ($ssn){
                $query->with(["profile" => function ($q) use ($ssn) {
                    $q->where('ssn', $ssn)
                      ->with("socialMedias");
                }, "roles", "addresses", "contacts", "billingCompanies"]);
            },
            "maritalStatus",
            "marital",
            "guarantor",
            "employments",
            "companies",
            "emergencyContacts",
            "publicNote",
            "privateNotes",
            "insurancePolicies",
            "insurancePlans" => function ($query) {
                $query->with([
                    "insuranceCompany"
                ]);
            }
        ])->find($id);

        if(is_null($patient)) return null;

        return $patient;
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllPatient() {
        return Patient::with([
            "user" => function ($query) {
                $query->with(["profile" => function ($q) {
                    $q->with("socialMedias");
                }, "roles", "addresses", "contacts", "billingCompanies"]);
            },
            "maritalStatus",
            //"marital",
            //"guarantor",
            "employments",
            "companies",
            "emergencyContacts",
            //"publicNote",
            "privateNotes",
            "insurancePolicies",
            "billingCompanies",
            "insurancePlans" => function ($query) {
                $query->with("insuranceCompany");
            }
        ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
    }

    public function getServerAllPatient(Request $request) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = Patient::with([
                "user" => function ($query) {
                    $query->with(["profile" => function ($q) {
                        $q->with("socialMedias");
                    }, "roles", "addresses", "contacts", "billingCompanies"]);
                },
                "marital",
                "guarantor",
                "employments",
                "companies",
                "emergencyContacts",
                "publicNote",
                "privateNotes",
                "insurancePolicies",
                "insurancePlans" => function ($query) {
                    $query->with("insuranceCompany");
                }
            ]);
        } else {
            $data = Patient::with([
                "user" => function ($query) {
                    $query->with(["profile" => function ($q) {
                        $q->with("socialMedias");
                    }, "roles", "addresses", "contacts",
                    "billingCompanies"
                    ]);
                },
                "marital",
                "guarantor",
                "employments",
                "companies",
                "emergencyContacts",
                "publicNote",
                "privateNotes",
                "insurancePolicies",
                "billingCompanies",
                "insurancePlans" => function ($query) {
                    $query->with("insuranceCompany");
                }
            ]);
        }
        
        if (!empty($request->query('query')) && $request->query('query')!=="{}") {
            $data = $data->search($request->query('query'));
        }
        
        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'billingcompany')) {
                $data = $data->orderBy(
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'patients.billing_company_id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } /**elseif (str_contains($request->sortBy, 'email')) {
                $data = $data->orderBy(
                    Contact::select('email')->whereColumn('contats.id', 'companies.billing_company_id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } */else {
                $data = $data->orderBy($request->sortBy, (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            }
        } else {
            $data = $data->orderBy("created_at", "desc")->orderBy("id", "asc");
        }

        $data = $data->paginate($request->itemsPerPage ?? 5);

        return response()->json([
            'data'          => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count'         => $data->total()
        ], 200);
    }

    /**
     * @param array $data
     * @param int $id
     * @return Patient|Builder|Model|object|null
     */
    public function updatePatient(array $data, int $id) {
        try {
            DB::beginTransaction();

            $patient = Patient::find($id);
            $user = $patient->user;
            
            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            /** Update Patient */
            $patient->update([
                "driver_license"    => $data["driver_license"],
                "marital_status_id" => $data["marital_status_id"] ?? null,
                "user_id"           => $user->id
            ]);

            if (is_null($patient->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $patient->billingCompanies()->attach($billingCompany->id ?? $billingCompany, [
                    'save_as_draft' => $data["save_as_draft"] ?? false
                ]);
            } else {
                $patient->billingCompanies()->updateExistingPivot(
                    $billingCompany->id ?? $billingCompany,
                    [
                        'status' => true,
                        'save_as_draft' => $data["save_as_draft"] ?? false
                    ]
                );
            }
            $user->billingCompanies()->sync($billingCompany->id ?? $billingCompany);

            if (isset($data['public_note'])) {
                /** PublicNote */
                PublicNote::updateOrCreate([
                    'publishable_type' => Patient::class,
                    'publishable_id'   => $patient->id,
                ], [
                    'note'             => $data['public_note'],
                ]);
            }

            if (isset($data['private_note'])) {
                /** PrivateNote */
                PrivateNote::updateOrCreate([
                    'publishable_type'   => Patient::class,
                    'publishable_id'     => $patient->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'note'               => $data['private_note'],
                ]);
            }

            /** Update User */
            $user->update([
                "email"    => $data['contact']['email'],
                "language" => $data['language'],
            ]);

            /** Create Profile */
            $profile = $user->profile;
            $profile->update([
                "first_name"    => $data["profile"]["first_name"],
                "middle_name"   => $data["profile"]["middle_name"],
                "last_name"     => $data["profile"]["last_name"],
                "sex"           => $data["profile"]["sex"],
                "date_of_birth" => $data["profile"]["date_of_birth"]
            ]);

            if (isset($data["profile"]["social_medias"])) {
                $socialMedias = $profile->socialMedias;
                /** Delete socialMedia */
                foreach ($socialMedias as $socialMedia) {
                    $validated = false;
                    $socialNetwork = $socialMedia->SocialNetwork;
                    if (isset($socialNetwork)) {
                        foreach ($data["profile"]["social_medias"] as $socialM) {
                            if ($socialM['name'] == $socialNetwork->name) {
                                $validated = true;
                                break;
                            }
                        }
                    }
                    if (!$validated) $socialMedia->delete();
                }

                /** update or create new social medias */
                foreach ($data["profile"]["social_medias"] as $socialMedia) {
                    $socialNetwork = SocialNetwork::whereName($socialMedia["name"])->first();
                    if (isset($socialNetwork)) {
                        SocialMedia::updateOrCreate([
                            "profile_id"        => $profile->id,
                            "social_network_id" => $socialNetwork->id
                        ], [
                            "link" => $socialMedia["link"]
                        ]);
                    }
                }
            }
            
            /** Create Contact */
            if (isset($data['contact'])) {
                Contact::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                    "contactable_id"     => $user->id,
                    "contactable_type"   => User::class
                ], $data['contact']);
            }

            if (isset($data['addresses'])) {
                foreach ($data['addresses'] as $address) {
                    Address::updateOrCreate([
                        "billing_company_id" => $billingCompany->id ?? $billingCompany,
                        "addressable_id"     => $user->id,
                        "addressable_type"   => User::class
                    ], $address);
                }
            }

            /** Create Marital */
            if (isset($data['marital']['spuse_name'])) {
                Marital::updateOrCreate([
                    "patient_id" => $patient->id
                ], $data["marital"]);
            }

            /** Create Guarantor */
            if (isset($data['guarantor']['name'])) {
                Guarantor::updateOrCreate([
                    "patient_id" => $patient->id
                ], $data["guarantor"]);
            }

            /** Create Employment */
            if (isset($data["employments"])) {
                $patient->employments()->delete();
                foreach ($data["employments"] as $employment) {
                    $employment["patient_id"] = $patient->id;
                    Employment::create($employment);
                }
            }

            /** Emergency Contacts */
            if (isset($data["emergency_contacts"])) {
                $emergencyContacts = $patient->emergencyContacts;
                /** Delete energencyContact */
                foreach ($emergencyContacts as $emergencyContact) {
                    $validated = false;
                    foreach ($data["emergency_contacts"] as $emergencyC) {
                        if ($emergencyC['name'] == $emergencyContact->name) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) $emergencyContact->delete();
                }

                /** update or create new emergency contact */
                foreach ($data["emergency_contacts"] as $emergencyContact) {
                    EmergencyContact::updateOrCreate([
                        "name"       => $emergencyContact["name"],
                        "patient_id" => $patient->id
                    ], [
                        "name"         => $emergencyContact["name"],
                        "cellphone"    => $emergencyContact["cellphone"],
                        "relationship_id" => $emergencyContact["relationship_id"],
                        "patient_id"   => $patient->id
                    ]);
                }
            }

            /** Insurance Policies */
            if (isset($data["insurance_policies"])) {
                $insurancePlans = $patient->insurancePlans;
                /** Detach Insurance plan */
                foreach ($insurancePlans as $insurancePlan) {
                    $validated = false;
                    foreach ($data["insurance_policies"] as $insurancePolicy) {
                        if ($insurancePolicy['insurance_plan'] == $insurancePlan->id) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) $patient->insurancePlans()->detach($insurancePlan->id);
                }

                /** Attach new insurance plan*/
                foreach ($data["insurance_policies"] as $insurance_policy) {
                    /** Attached patient to insurance plan */
                    $insurancePlan = InsurancePlan::find($insurance_policy["insurance_plan"]);

                    $insurancePolicy = InsurancePolicy::updateOrCreate([
                        'policy_number'     => $insurance_policy["policy_number"],
                        'insurance_plan_id' => $insurancePlan->id
                    ], [
                        'group_number'             => $insurance_policy["group_number"] ?? '',
                        'eff_date'                 => $insurance_policy["eff_date"],
                        'end_date'                 => $insurance_policy["end_date"] ?? '',
                        'insurance_policy_type_id' => $insurance_policy["insurance_policy_type_id"] ?? null,
                        'type_responsibility_id'   => $insurance_policy["type_responsibility_id"],
                        'release_info'             => $insurance_policy["release_info"],
                        'assign_benefits'          => $insurance_policy["assign_benefits"]

                    ]);

                    /** Attach insurance policy to patient */
                    if (is_null($patient->insurancePolicies()->find($insurancePolicy->id))) {
                        $patient->insurancePolicies()->attach($insurancePolicy->id, [
                            'own_insurance' => $insurance_policy["own_insurance"]
                        ]);
                    } else {
                        $patient->insurancePolicies()->updateExistingPivot($insurancePolicy->id, [
                            'own_insurance' => $insurance_policy["own_insurance"]
                        ]);
                    }
                    
                    if (is_null($patient->insurancePlans()->find($insurancePlan->id))) {
                        $patient->insurancePlans()->attach($insurancePlan->id);
                    }

                    if ($insurance_policy["own_insurance"] == false) {

                        /** The subscriber is searched for each billing company */
                        $subscriber = Subscriber::firstOrCreate([
                            "ssn"         => $insurance_policy["subscriber"]["ssn"],
                            "first_name" => upperCaseWords($insurance_policy["subscriber"]["first_name"]),
                            "last_name" => upperCaseWords($insurance_policy["subscriber"]["last_name"]),
                            "date_of_birth" => $insurance_policy["subscriber"]["date_of_birth"]
                        ], [
                            "first_name" => $insurance_policy["subscriber"]["first_name"],
                            "last_name" => $insurance_policy["subscriber"]["last_name"],
                            "date_of_birth" => $insurance_policy["subscriber"]["date_of_birth"],
                            "relationship_id" => $insurance_policy["subscriber"]["relationship_id"],
                        ]);

                        if (isset($subscriber)) {
                            /** Create Contact */
                            if (isset($insurance_policy["subscriber"]['contact'])) {
                                Contact::updateOrCreate([
                                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                                    "contactable_id"     => $subscriber->id,
                                    "contactable_type"   => Subscriber::class
                                ], $insurance_policy["subscriber"]["contact"]);
                            }

                            /** Create Address */
                            if (isset($insurance_policy["subscriber"]['address'])) {
                                Address::updateOrCreate([
                                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                                    "addressable_id"     => $subscriber->id,
                                    "addressable_type"   => Subscriber::class
                                ], $insurance_policy["subscriber"]["address"]);
                            }
                            /** Attached patient to subscriber */
                            if (is_null($patient->subscribers()->find($subscriber->id))) {
                                $patient->subscribers()->attach($subscriber->id);
                            }
                            
                            /** Attached subscriber to insurance plan */
                            /**if (is_null($subscriber->insurancePlans()->find($insurance_policy["insurance_plan"]))) {
                                $subscriber->insurancePlans()->attach($insurance_policy["insurance_plan"]);
                            }*/

                            /** Attached patient to subscriber */
                            if (is_null($insurancePolicy->subscribers()->find($subscriber->id))) {
                                $insurancePolicy->subscribers()->attach($subscriber->id);
                            }
                        }
                    }
                }
            }

            /**if (isset($data['injuries'])) {
                $injuries = $patient->injuries;
                /** Delete injuries
                foreach ($injuries as $injury) {
                    $validated = false;
                    foreach ($data["injuries"] as $injuryP) {
                        if (($injuryP['diag_date'] == $injury->diag_date) &&
                            ($injuryP['diagnosis_id'] == $injury->diagnosis_id) &&
                            ($injuryP['type_diag_id'] == $injury->type_diag_id)) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) $injury->delete();
                }
                foreach ($data['injuries'] as $injury) {
                    $patientInjury = Injury::updateOrCreate(
                        [
                            'diag_date'    => $injury['diag_date'],
                            'diagnosis_id' => $injury['diagnosis_id'],
                            'type_diag_id' => $injury['type_diag_id'],
                        ],
                        [
                            'diag_date'    => $injury['diag_date'],
                            'diagnosis_id' => $injury['diagnosis_id'],
                            'type_diag_id' => $injury['type_diag_id'],
                        ]
                    );
                    if (isset($injury['public_note'])) {
                        /** PublicNote
                        PublicNote::create([
                            'publishable_type' => Injury::class,
                            'publishable_id'   => $patientInjury->id,
                            'note'             => $injury['public_note'],
                        ]);
                    }
                    if (isset($patientInjury)) {
                        if (is_null($patient->injuries()->find($patientInjury->id))) {
                            $patient->injuries()->attach($patientInjury->id);
                        }
                    }
                }
            }*/

            DB::commit();
            return $this->getOnePatient($id);
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllSubscribers(string $ssn) {
        $patient = Patient::whereHas('user', function ($query) use ($ssn) {
            $query->whereHas('profile', function ($q) use ($ssn) {
                $q->where('ssn', $ssn);
            });
        })->with(['subscribers' => function ($query) {
            $query->with('addresses', 'contacts');
        }])->first();

        return $patient->subscribers ?? [];
    }

    /**
     * @param bool $status
     * @param int $id
     * @return bool|int|null
     */
    public function changeStatus(bool $status, int $id) {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        $patient = Patient::find($id);
        if (is_null($patient->billingCompanies()->find($billingCompany->id))) {
            $patient->billingCompanies()->attach($billingCompany->id);
            return $patient;
        } else {
            return $patient->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }

    /**
     * @param PatientUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function addPolicy(array $data, int $id)
    {
        try {
            DB::beginTransaction();

            $patient = Patient::find($id);
            if (!auth()->user()->hasRole('superuser')) {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            /** Attached patient to insurance plan */
            $insurancePlan = InsurancePlan::find($data["insurance_plan"]);

            $insurancePolicy = InsurancePolicy::updateOrCreate([
                'policy_number'     => $data["policy_number"],
                'insurance_plan_id' => $insurancePlan->id
            ], [
                'group_number'             => $data["group_number"] ?? '',
                'eff_date'                 => $data["eff_date"],
                'end_date'                 => $data["end_date"] ?? '',
                'insurance_policy_type_id' => $data["insurance_policy_type_id"] ?? null,
                'type_responsibility_id'   => $data["type_responsibility_id"],
                'release_info'             => $data["release_info"],
                'assign_benefits'          => $data["assign_benefits"]

            ]);

            /** Attach insurance policy to patient */
            if (is_null($patient->insurancePolicies()
                ->wherePivot('billing_company_id', $billingCompany->id ?? $data['billing_company_id'])
                ->find($insurancePolicy->id))) {
                $patient->insurancePolicies()->attach($insurancePolicy->id, [
                    'own_insurance'      => $data["own_insurance"],
                    'billing_company_id' => $billingCompany->id ?? $data['billing_company_id'],
                ]);
            }
            
            if (is_null($patient->insurancePlans()->find($insurancePlan->id))) {
                $patient->insurancePlans()->attach($insurancePlan->id);
            }

            if ($data["own_insurance"] == false) {

                /** The subscriber is searched for each billing company */
                $subscriber = Subscriber::firstOrCreate([
                    "ssn"         => $data["subscriber"]["ssn"],
                    "first_name" => upperCaseWords($data["subscriber"]["first_name"]),
                    "last_name" => upperCaseWords($data["subscriber"]["last_name"]),
                    "date_of_birth" => $data["subscriber"]["date_of_birth"]
                ], [
                    "first_name" => $data["subscriber"]["first_name"],
                    "last_name" => $data["subscriber"]["last_name"],
                    "date_of_birth" => $data["subscriber"]["date_of_birth"],
                    "relationship_id" => $data["subscriber"]["relationship_id"],
                ]);

                if (isset($subscriber)) {
                    /** Create Contact */
                    if (isset($data["subscriber"]['contact'])) {
                        Contact::updateOrCreate([
                            "billing_company_id" => $billingCompany->id ?? $data['billing_company_id'],
                            "contactable_id"     => $subscriber->id,
                            "contactable_type"   => Subscriber::class
                        ], $data["subscriber"]["contact"]);
                    }

                    /** Create Address */
                    if (isset($data["subscriber"]['address'])) {
                        Address::updateOrCreate([
                            "billing_company_id" => $billingCompany->id ?? $data['billing_company_id'],
                            "addressable_id"     => $subscriber->id,
                            "addressable_type"   => Subscriber::class
                        ], $data["subscriber"]["address"]);
                    }
                    /** Attached patient to subscriber */
                    if (is_null($patient->subscribers()->find($subscriber->id))) {
                        $patient->subscribers()->attach($subscriber->id);
                    }
                    
                    /** Attached subscriber to insurance plan */
                    /**if (is_null($subscriber->insurancePlans()->find($data["insurance_plan"]))) {
                        $subscriber->insurancePlans()->attach($data["insurance_plan"]);
                    }*/

                    /** Attached insurance policy to subscriber */
                    if (is_null($insurancePolicy->subscribers()->find($subscriber->id))) {
                        $insurancePolicy->subscribers()->attach($subscriber->id);
                    }
                }
            }

            DB::commit();
            return $patient->insurancePolicies()->find($insurancePolicy->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    public function removePolicy(int $insurance_policy_id, int $patient_id)
    {
        $patient = Patient::find($patient_id);
        $insurancePolicy = InsurancePolicy::find($insurance_policy_id);

        if (count($insurancePolicy->patients) > 1) {
            $insurancePolicy->patients()->detach($patient_id);
        } else {
            $patient = $insurancePolicy->patients()->find($patient_id);
            /** Detach Insurance policy */
            if ($patient) {
                $insurancePolicy->patients()->detach();
                $insurancePolicy->subscribers()->detach();
                $insurancePolicy->delete();
            }
        }
        return $patient->insurancePolicies ?? [];
    }

    public function changeStatusPolicy(array $data, int $insurance_policy_id, int $patient_id)
    {
        $patient = Patient::find($patient_id);
        if (!auth()->user()->hasRole('superuser')) {
            $billingCompany = auth()->user()->billingCompanies->first();
        }
        if (!is_null($patient->insurancePolicies()
            ->wherePivot('billing_company_id', $billingCompany->id ?? $data['billing_company_id'])
            ->find($insurance_policy_id))) {
            return $patient->insurancePolicies()
                ->wherePivot('billing_company_id', $billingCompany->id ?? $data['billing_company_id'])
                ->updateExistingPivot($insurance_policy_id, [
                'status' => $data['status'] ?? false,
            ]);
        } else {
            return null;
        }
    }

    public function editPolicy(array $data, int $insurance_policy_id, int $patient_id)
    {
        $patient = Patient::find($patient_id);
        $insurancePolicy = InsurancePolicy::find($insurance_policy_id);
        $insurancePlan = InsurancePlan::find($data["insurance_plan"]);

        if (!auth()->user()->hasRole('superuser')) {
            $billingCompany = auth()->user()->billingCompanies->first();
        }

        $insurancePolicy->update([
            'policy_number'     => $data["policy_number"],
            'insurance_plan_id' => $insurancePlan->id,
            'group_number'      => $data["group_number"] ?? '',
            'eff_date'          => $data["eff_date"],
            'end_date'          => $data["end_date"] ?? '',
            'insurance_policy_type_id' => $data["insurance_policy_type_id"] ?? null,
            'type_responsibility_id'   => $data["type_responsibility_id"],
            'release_info'      => $data["release_info"],
            'assign_benefits'   => $data["assign_benefits"],
        ]);

        /** Attach insurance policy to patient */
        if (is_null($patient->insurancePolicies()
            ->wherePivot('billing_company_id', $billingCompany->id ?? $data['billing_company_id'])
            ->find($insurancePolicy->id))) {
            $patient->insurancePolicies()->attach($insurancePolicy->id, [
                'own_insurance'      => $data["own_insurance"],
                'billing_company_id' => $billingCompany->id ?? $data['billing_company_id'],
            ]);
        } else {
            $patient->insurancePolicies()
                ->wherePivot('billing_company_id', $billingCompany->id ?? $data['billing_company_id'])
                ->updateExistingPivot($insurancePolicy->id, [
                    'own_insurance' => $data["own_insurance"],
            ]);
        }

        if ($data["own_insurance"] == false) {

            /** The subscriber is searched for each billing company */
            $subscriber = Subscriber::firstOrCreate([
                "ssn"         => $data["subscriber"]["ssn"],
                "first_name" => upperCaseWords($data["subscriber"]["first_name"]),
                "last_name" => upperCaseWords($data["subscriber"]["last_name"]),
                "date_of_birth" => $data["subscriber"]["date_of_birth"]
            ], [
                "first_name" => $data["subscriber"]["first_name"],
                "last_name" => $data["subscriber"]["last_name"],
                "date_of_birth" => $data["subscriber"]["date_of_birth"],
                "relationship_id" => $data["subscriber"]["relationship_id"],
            ]);

            if (isset($subscriber)) {
                /** Create Contact */
                if (isset($data["subscriber"]['contact'])) {
                    Contact::updateOrCreate([
                        "billing_company_id" => $billingCompany->id ?? $data['billing_company_id'],
                        "contactable_id"     => $subscriber->id,
                        "contactable_type"   => Subscriber::class
                    ], $data["subscriber"]["contact"]);
                }

                /** Create Address */
                if (isset($data["subscriber"]['address'])) {
                    Address::updateOrCreate([
                        "billing_company_id" => $billingCompany->id ?? $data['billing_company_id'],
                        "addressable_id"     => $subscriber->id,
                        "addressable_type"   => Subscriber::class
                    ], $data["subscriber"]['address']);
                }
                /** Attached patient to subscriber */
                if (is_null($patient->subscribers()->find($subscriber->id))) {
                    $patient->subscribers()->attach($subscriber->id);
                }
                
                /** Attached subscriber to insurance plan */
                /**if (is_null($subscriber->insurancePlans()->find($data["insurance_plan"]))) {
                    $subscriber->insurancePlans()->attach($data["insurance_plan"]);
                }*/

                /** Attached patient to subscriber */
                if (is_null($insurancePolicy->subscribers()->find($subscriber->id))) {
                    $insurancePolicy->subscribers()->attach($subscriber->id);
                }
            }
        }
        $insurancePolicy = $patient->insurancePolicies()->find($insurance_policy_id);
        return $insurancePolicy;
    }

    public function getPolicy(int $insurance_policy_id, int $patient_id)
    {
        $patient = Patient::find($patient_id);
        $insurancePolicy = $patient->insurancePolicies()->find($insurance_policy_id);
        $subscriber = $insurancePolicy->subscribers->first();
        if (isset($subscriber)) {
            $address = Address::where([
                "addressable_id"     => $subscriber->id,
                "addressable_type"   => Subscriber::class,
                "billing_company_id" => $insurancePolicy->pivot->billing_company_id
            ])->first();
            $contact = Contact::where([
                "contactable_id"     => $subscriber->id,
                "contactable_type"   => Subscriber::class,
                "billing_company_id" => $insurancePolicy->pivot->billing_company_id
            ])->first();
            if (isset($address)) {
                $subscriber_address = [
                    "zip"                      => $address->zip,
                    "city"                     => $address->city,
                    "state"                    => $address->state,
                    "address"                  => $address->address,
                    "country"                  => $address->country,
                    "address_type_id"          => $address->address_type_id,
                    "address_type"             => $address->addressType->name ?? '',
                    "country_subdivision_code" => $address->country_subdivision_code
                ];
            };

            if (isset($contact)) {
                $subscriber_contact = [
                    "fax"          => $contact->fax,
                    "email"        => $contact->email,
                    "phone"        => $contact->phone,
                    "mobile"       => $contact->mobile,
                    "contact_name" => $contact->contact_name,
                ];
            };
        }
        $record = [
            'billing_company_id' => $insurancePolicy->pivot->billing_company_id,
            'billing_company' => BillingCompany::find($insurancePolicy->pivot->billing_company_id)->name ?? '',
            "id"                       => $insurancePolicy->id,
            "policy_number"            => $insurancePolicy->policy_number,
            "group_number"             => $insurancePolicy->group_number,
            "insurance_company_id"     => $insurancePolicy->insurancePlan->insurance_company_id ?? '',
            "insurance_company"        => ($insurancePolicy->insurancePlan->insuranceCompany->payer_id ?? '') . ' - ' . $insurancePolicy->insurancePlan->insuranceCompany->name ?? '',
            "insurance_plan_id"        => $insurancePolicy->insurance_plan_id ?? '',
            "insurance_plan"           => $insurancePolicy->insurancePlan->name ?? '',
            "type_responsibility_id"   => $insurancePolicy->type_responsibility_id ?? '',
            "type_responsibility"      => $insurancePolicy->typeResponsibility->code ?? '',
            "insurance_policy_type_id" => $insurancePolicy->insurance_policy_type_id ?? '',
            "insurance_policy_type"    => $insurancePolicy->insurancePolicyType->description ?? '',
            "claim_last_eligibility"   => $insurancePolicy->claimLastEligibility->claimEligibilityStatus ?? null,
            "status"                   => $insurancePolicy->pivot->status ?? false,
            "eff_date"                 => $insurancePolicy->eff_date,
            "end_date"                 => $insurancePolicy->end_date,
            "assign_benefits"          => $insurancePolicy->assign_benefits ?? false,
            "release_info"             => $insurancePolicy->release_info ?? false,
            "own_insurance"            => $insurancePolicy->pivot->own_insurance ?? false,
            "subscriber"               => isset($subscriber) ? [
                "ssn" => $subscriber->ssn,
                "first_name" => $subscriber->first_name,
                "last_name"  => $subscriber->last_name,
                "date_of_birth" => $subscriber->date_of_birth,
                "relationship_id" => $subscriber->relationship_id,
                "relationship" => $subscriber->relationship->description ?? '',
                "address"         => isset($subscriber_address) ? $subscriber_address : null,
                "contact"           => isset($subscriber_contact) ? $subscriber_contact : null,
            ] : null,
        ];
        return !is_null($record)
                ? $record
                : null;
    }

    public function getPolicies(Request $request, int $patient_id)
    {
        $patient = Patient::with("insurancePolicies")->find($patient_id);
        
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = $patient->insurancePolicies()
                ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                ->paginate(Pagination::itemsPerPage());
        } else {
            $data = $patient->insurancePolicies()
                ->wherePivot('billing_company_id', $bC)
                ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                ->paginate(Pagination::itemsPerPage());
        }

        $data->getCollection()->transform(fn ($policy) => [
            'billing_company_id' => $policy->pivot->billing_company_id,
            'billing_company' => BillingCompany::find($policy->pivot->billing_company_id)->name ?? '',
            "id"                       => $policy->id,
            "policy_number"            => $policy->policy_number,
            "group_number"             => $policy->group_number,
            "insurance_company_id"     => $policy->insurancePlan->insurance_company_id ?? '',
            "insurance_company"        => ($policy->insurancePlan->insuranceCompany->payer_id ?? '') . ' - ' . $policy->insurancePlan->insuranceCompany->name ?? '',
            "insurance_plan_id"        => $policy->insurance_plan_id ?? '',
            "insurance_plan"           => $policy->insurancePlan->name ?? '',
            "type_responsibility_id"   => $policy->type_responsibility_id ?? '',
            "type_responsibility"      => $policy->typeResponsibility->code ?? '',
            "insurance_policy_type_id" => $policy->insurance_policy_type_id ?? '',
            "insurance_policy_type"    => $policy->insurancePolicyType->description ?? '',
            "eligibility"              => $policy->claimLastEligibility->claimEligibilityStatus ?? null,
            "status"                   => $policy->pivot->status ?? false,
            "eff_date"                 => $policy->eff_date,
            "end_date"                 => $policy->end_date,
            "assign_benefits"          => $policy->assign_benefits ?? false,
            "release_info"             => $policy->release_info ?? false,
            "own_insurance"            => $policy->pivot->own_insurance ?? false,
            "subscriber"               => $policy_subscriber ?? null,
        ]);

        return response()->json([
            'data'          => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count'         => $data->total()
        ], 200);
    }

    public function getList(Request $request) {
        $records = [];
        $billingCompanyId = $request->billing_company_id ?? null;
        $companyId = $request->company_id ?? null;

        if (auth()->user()->hasRole('superuser')) {
            $billingCompany = $billingCompanyId;
        } else {
            $billingCompany = auth()->user()->billingCompanies->first();
        }

        $patients = Patient::with('user.profile');

        if (isset($billingCompany)) {
            $patients = $patients->whereHas('billingCompanies', function ($query) use ($billingCompany) {
                $query->where('billing_company_id', $billingCompany->id ?? $billingCompany)
                      ->where('billing_company_patient.status', true);
            });
        }
        if (isset($companyId)) {
            $patients = $patients->whereHas('companies', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            });
        }
        $patients = $patients->get();

        foreach ($patients as $patient) {
            array_push($records, [
                'id'   => $patient->id,
                'name' => $patient->code . ' - ' .
                          $patient->user->profile->first_name . ' ' .
                          substr($patient->user->profile->middle_name, 0, 1) . ' ' .
                          $patient->user->profile->last_name
            ]);
        }

        return $records;
    }

    public function getListMaritalStatus() {
        try {
            return getList(MaritalStatus::class);
        } catch (\Exception $e) {
            return [];
        }
    }
    
    public function getListAddressType() {
        try {
            return getList(AddressType::class);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListInsurancePolicyType() {
        try {
            return getList(InsurancePolicyType::class);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListRelationship() {
        try {
            return getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => 'Patient relationship']]);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListResponsibilityType() {
        try {
            return getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => 'Responsibility type']]);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function search(Request $request) {
        $date_of_birth = $request->date_of_birth ?? '';
        $first_name = upperCaseWords($request->first_name ?? '');
        $last_name = upperCaseWords($request->last_name ?? '');
        $ssn = $request->ssn ?? '';
        $ssnFormated = substr($ssn, 0,1) . '-' . substr($ssn, 1, strlen($ssn));

        $patients = Patient::with([
            "user" => function ($query) {
                $query->with(["profile" => function ($q) {
                    $q->with("socialMedias");
                }, "roles", "addresses", "contacts", "billingCompanies"]);
            },
            "maritalStatus",
            "marital",
            "companies",
            "insurancePolicies",
            "insurancePlans" => function ($query) {
                $query->with([
                    "insuranceCompany"
                ]);
            },
            "guarantor",
            "emergencyContacts",
            "employments",
            "publicNote",
            "privateNotes"
        ])->whereHas('user.profile', function ($query) use ($ssn, $ssnFormated, $date_of_birth, $first_name, $last_name) {
            $query->whereDateOfBirth($date_of_birth)
                  ->where("first_name", "ilike", "%{$first_name}%")
                  ->where("last_name", "ilike", "%{$last_name}%")
                  ->where("ssn", "ilike", "%{$ssn}")
                  ->orWhere("ssn", "ilike", "%{$ssnFormated}");
        })->get();

        return (count($patients) == 0) ? null : $patients;
    }

    public function addCompanies(array $data, int $id)
    {
        try {
            DB::beginTransaction();
            $patient = Patient::find($id);
            
            if (auth()->user()->hasRole('superuser')) {
                $companies = $patient->companies()->get();
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
                $companies = $patient->companies()
                                     ->where('billing_company_id', $billingCompany->id ?? $billingCompany)
                                     ->get();
            }

            /** Detach Company */
            foreach ($companies as $company) {
                $validated = false;
                foreach ($data as $dataCompany) {
                    if (($dataCompany["company_id"] == $company->id) &&
                        ($company->pivot->billing_company_id == ($billingCompany->id ?? $dataCompany["billing_company_id"]))) {
                        $validated = true;
                        break;
                    }
                }
                if (!$validated) $patient->companies()->detach($company->id);
            }

            /** Attached patient to company */
            foreach ($data as $dataCompany) {
                $company = Company::find($dataCompany["company_id"]);

                if (isset($company)) {
                    if (is_null($patient->companies()->find($company->id))) {
                        $patient->companies()->attach($company->id, [
                            'med_num' => $dataCompany["med_num"] ?? '',
                            'billing_company_id' => $billingCompany->id ?? $dataCompany["billing_company_id"],
                        ]);
                    } else {
                        $patient->companies()->updateExistingPivot($company->id, [
                            'med_num' => $dataCompany["med_num"],
                            'billing_company_id' => $billingCompany->id ?? $dataCompany["billing_company_id"],
                        ]);
                    }
                }
            }

            if (auth()->user()->hasRole('superuser')) {
                $dataCompany = $patient->companies;
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
                $dataCompany = $patient->companies()
                    ->wherePivot('billing_company_id', $billingCompany->id)
                    ->get();
            }
    
            $companyRecords = [];
            foreach ($dataCompany as $company) {
                array_push($companyRecords, [
                    'billing_company_id' => $company->pivot->billing_company_id,
                    'company_id'         => $company->id,
                    'med_num'            => $company->pivot->med_num,
                    'company'            => $company->name,
                    'billing_company'    => $company->billingCompanies()
                        ->find($company->pivot->billing_company_id)->name ?? null,
                ]);
            }

            DB::commit();
            return $companyRecords;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }
}

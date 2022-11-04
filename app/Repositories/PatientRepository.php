<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Mail\GenerateNewPassword;
use App\Models\InsurancePlan;
use App\Models\InsurancePolicy;
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
use App\Models\Contact;
use App\Models\Marital;
use App\Models\Guarantor;
use App\Models\Employment;
use App\Models\EmergencyContact;
use App\Models\Subscriber;
use App\Models\User;
use App\Roles\Models\Role;

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
                "ssn" => $data["profile"]["ssn"]
            ], [
                "ssn"           => $data["profile"]["ssn"],
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

            /** Create User */
            $user = User::create([
                "usercode"   => generateNewCode("US", 5, date("Y"), User::class, "usercode"),
                "email"      => $data['contact']['email'],
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
                Contact::create($data["contact"]);
            }

            /** Create Address */
            if (isset($data['address'])) {
                $data["address"]["addressable_id"]     = $user->id;
                $data["address"]["addressable_type"]   = User::class;
                $data["address"]["billing_company_id"] = $billingCompany->id ?? $billingCompany;
                Address::create($data["address"]);
            }

            /** Create Patient */
            $patient = Patient::create([
                "code"           => generateNewCode("PA", 5, date("Y"), Patient::class, "code"),
                "driver_license" => $data["driver_license"],
                "user_id"        => $user->id
            ]);

            if (is_null($patient->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $patient->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
            } else {
                $patient->billingCompanies()->updateExistingPivot(
                    $billingCompany->id ?? $billingCompany,
                    [
                        'status' => true
                    ]
                );
            }

            if (isset($data['public_note'])) {
                /** PublicNote */
                PublicNote::create([
                    'publishable_type' => Patient::class,
                    'publishable_id'   => $patient->id,
                    'note'             => $data['public_note'],
                ]);
            }

            if (isset($data['private_note'])) {
                /** PrivateNote */
                PrivateNote::create([
                    'publishable_type'   => Patient::class,
                    'publishable_id'     => $patient->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'note'               => $data['private_note'],
                ]);
            }

            /** Create PatienPrivate */
            if (isset($data['patient_private'])) {
                $data["patient_private"]["patient_id"] = $patient->id;
                $data["patient_private"]["billing_company_id"] = $billingCompany->id ?? $billingCompany;
                $patient_private = PatientPrivate::create($data["patient_private"]);
            }

            /** Create PatienConditionRelated */
            if (isset($data['patient_condition_related'])) {
                $data["patient_condition_related"]["patient_id"] = $patient->id;
                $patient_condition = PatientConditionRelated::create($data["patient_condition_related"]);
            }

            /** Create Marital */
            if (isset($data['marital']['spuse_name'])) {
                $data["marital"]["patient_id"] = $patient->id;
                $marital = Marital::create($data["marital"]);
            }

            /** Create Guarantor */
            if (isset($data['guarantor']['name'])) {
                $data["guarantor"]["patient_id"] = $patient->id;
                $guarantor = Guarantor::create($data["guarantor"]);
            }

            /** Create Employment */
            if (isset($data["employments"])) {
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
                        "relationship" => $emergencyContact["relationship"],
                        "patient_id"   => $patient->id
                    ]);
                }
            }

            /** Company */
            if (isset($data["companies"])) {
                /** Attached patient to company */
                foreach ($data["companies"] as $dataCompany) {
                    $company = Company::find($dataCompany);

                    if (is_null($patient->companies()->find($company->id))) {
                        $patient->companies()->attach($company->id);
                    }
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
                        'group_number'    => $insurance_policy["group_number"] ?? '',
                        'eff_date'        => $insurance_policy["eff_date"],
                        'end_date'        => $insurance_policy["end_date"] ?? '',
                        'release_info'    => $insurance_policy["release_info"],
                        'assign_benefits' => $insurance_policy["assign_benefits"]

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
                            "ssn"         => $insurance_policy["subscriber"]["ssn"]
                        ], [
                            "first_name" => $insurance_policy["subscriber"]["first_name"],
                            "last_name" => $insurance_policy["subscriber"]["last_name"]
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
            if ($user && $patient) {
                $rolePatient = Role::where('slug', 'patient')->first();
                $user->attachRole($rolePatient);
                
                $token = encrypt($user->id . "@#@#$" . $user->email);
                $user->token = $token;
                $user->save();

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
            "marital",
            "guarantor",
            "employments",
            "patientPrivate",
            "companies",
            "patientConditionRelated",
            "emergencyContacts",
            "publicNote",
            "privateNotes",
            "insurancePolicies",
            "insurancePlans" => function ($query) use ($id) {
                $query->with([
                    "insuranceCompany"
                ]);
            }
        ])->find($id);

        if(is_null($patient)) return null;

        return $patient;
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
            "marital",
            "guarantor",
            "employments",
            "patientPrivate",
            "companies",
            "patientConditionRelated",
            "emergencyContacts",
            "publicNote",
            "privateNotes",
            "insurancePolicies",
            "insurancePlans" => function ($query) use ($id) {
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
            "marital",
            "guarantor",
            "employments",
            "patientPrivate",
            "companies",
            "patientConditionRelated",
            "emergencyContacts",
            "publicNote",
            "privateNotes",
            "insurancePolicies",
            "insurancePlans" => function ($query) {
                $query->with("insuranceCompany");
            }
        ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
    }

    public function getServerAllPatient(Request $request) {
        $sortBy   = $request->sortBy ?? 'id';
        $sortDesc = $request->sortDesc ?? false;
        $page = $request->page ?? 1;
        $itemsPerPage = $request->itemsPerPage ?? 5;
        $search = $request->search ?? '';

        $records = Patient::with([
            "user" => function ($query) {
                $query->with(["profile" => function ($q) {
                    $q->with("socialMedias");
                }, "roles", "addresses", "contacts", "billingCompanies"]);
            },
            "marital",
            "guarantor",
            "employments",
            "patientPrivate",
            "companies",
            "patientConditionRelated",
            "emergencyContacts",
            "publicNote",
            "privateNotes",
            "insurancePolicies",
            "insurancePlans" => function ($query) {
                $query->with("insuranceCompany");
            }
        ])->orderBy("created_at", "desc")->orderBy("id", "asc")->paginate($itemsPerPage);

        return response()->json([
            'pagination'  => [
                'total'       => $records->total(),
                'currentPage' => $records->currentPage(),
                'perPage'     => $records->perPage(),
                'lastPage'    => $records->lastPage()
            ],
            'items' =>  $records->items()
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
                "driver_license" => $data["driver_license"],
                "user_id"        => $user->id
            ]);

            if (is_null($patient->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $patient->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
            } else {
                $patient->billingCompanies()->updateExistingPivot(
                    $billingCompany->id ?? $billingCompany,
                    [
                        'status' => true
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

            /** Update PatienPrivate */
            if (isset($data['patient_private'])) {
                $patient_private = $patient->patientPrivate;
                $patient_private->update($data["patient_private"]);
            }

            /** Update PatienPrivate */
            if (isset($data['patient_condition_related'])) {
                $patient_condition = $patient->patientConditionRelated;
                $patient_condition->update($data["patient_condition_related"]);
            }

            /** Update User */
            $user->update([
                "email" => $data['contact']['email'],
            ]);

            /** Create Profile */
            $profile = $user->profile;
            $profile->update([
                "ssn"           => $data["profile"]["ssn"],
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

            if (isset($data['address'])) {
                Address::updateOrCreate([
                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                    "addressable_id"     => $user->id,
                    "addressable_type"   => User::class
                ], $data["address"]);
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
                        "relationship" => $emergencyContact["relationship"],
                        "patient_id"   => $patient->id
                    ]);
                }
            }

            /** Company */
            if (isset($data["companies"])) {
                $companies = $patient->companies()->whereHas('billingCompanies', function ($query) use ($billingCompany) {
                    $query->where('billing_company_id', $billingCompany->id ?? $billingCompany);
                })->get();
                
                /** Detach Company */
                foreach ($companies as $company) {
                    $validated = false;
                    foreach ($data["companies"] as $dataCompany) {
                        if ($dataCompany == $company->id) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) $patient->companies()->detach($company->id);
                }

                /** Attached patient to company */
                foreach ($data["companies"] as $dataCompany) {
                    $company = Company::find($dataCompany);

                    if (is_null($patient->companies()->find($company->id))) {
                        $patient->companies()->attach($company->id);
                    }
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
                        'group_number'    => $insurance_policy["group_number"] ?? '',
                        'eff_date'        => $insurance_policy["eff_date"],
                        'end_date'        => $insurance_policy["end_date"] ?? '',
                        'release_info'    => $insurance_policy["release_info"],
                        'assign_benefits' => $insurance_policy["assign_benefits"]

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
                            "ssn"         => $insurance_policy["subscriber"]["ssn"]
                        ], [
                            "first_name" => $insurance_policy["subscriber"]["first_name"],
                            "last_name" => $insurance_policy["subscriber"]["last_name"]
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

            DB::commit();
            return $patient;
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
            $billingCompany = $patient->user->billingCompanies->first();

            /** Attached patient to insurance plan */
            $insurancePlan = InsurancePlan::find($data["insurance_plan"]);

            $insurancePolicy = InsurancePolicy::updateOrCreate([
                'policy_number'     => $data["policy_number"],
                'insurance_plan_id' => $insurancePlan->id
            ], [
                'group_number'    => $data["group_number"] ?? '',
                'eff_date'        => $data["eff_date"],
                'end_date'        => $data["end_date"] ?? '',
                'release_info'    => $data["release_info"],
                'assign_benefits' => $data["assign_benefits"],

            ]);

            /** Attach insurance policy to patient */
            if (is_null($patient->insurancePolicies()->find($insurancePolicy->id))) {
                $patient->insurancePolicies()->attach($insurancePolicy->id, [
                    'own_insurance' => $data["own_insurance"]
                ]);
            }
            
            if (is_null($patient->insurancePlans()->find($insurancePlan->id))) {
                $patient->insurancePlans()->attach($insurancePlan->id);
            }

            if ($data["own_insurance"] == false) {

                /** The subscriber is searched for each billing company */
                $subscriber = Subscriber::firstOrCreate([
                    "ssn"         => $data["subscriber"]["ssn"]
                ], [
                    "first_name" => $data["subscriber"]["first_name"],
                    "last_name" => $data["subscriber"]["last_name"]
                ]);

                if (isset($subscriber)) {
                    /** Create Contact */
                    if (isset($data["subscriber"]['contact'])) {
                        Contact::updateOrCreate([
                            "billing_company_id" => $billingCompany->id ?? $billingCompany,
                            "contactable_id"     => $subscriber->id,
                            "contactable_type"   => Subscriber::class
                        ], $data["subscriber"]["contact"]);
                    }

                    /** Create Address */
                    if (isset($data["subscriber"]['address'])) {
                        Address::updateOrCreate([
                            "billing_company_id" => $billingCompany->id ?? $billingCompany,
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

                    /** Attached patient to subscriber */
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

    public function editPolicy(array $data, int $insurance_policy_id, int $patient_id)
    {
        $patient = Patient::find($patient_id);
        $billingCompany = $patient->user->billingCompanies->first();
        $insurancePolicy = InsurancePolicy::find($insurance_policy_id);
        $insurancePlan = InsurancePlan::find($data["insurance_plan"]);

        $insurancePolicy->update([
            'policy_number'     => $data["policy_number"],
            'insurance_plan_id' => $insurancePlan->id,
            'group_number'      => $data["group_number"] ?? '',
            'eff_date'          => $data["eff_date"],
            'end_date'          => $data["end_date"] ?? '',
            'release_info'      => $data["release_info"],
            'assign_benefits'   => $data["assign_benefits"],
        ]);

        /** Attach insurance policy to patient */
        if (is_null($patient->insurancePolicies()->find($insurancePolicy->id))) {
            $patient->insurancePolicies()->attach($insurancePolicy->id, [
                'own_insurance' => $data["own_insurance"]
            ]);
        } else {
            $patient->insurancePolicies()->updateExistingPivot($insurancePolicy->id, [
                'own_insurance' => $data["own_insurance"]
            ]);
        }

        if ($data["own_insurance"] == false) {

            /** The subscriber is searched for each billing company */
            $subscriber = Subscriber::firstOrCreate([
                "ssn"                => $data["subscriber"]["ssn"]
            ], [
                "first_name" => $data["subscriber"]["first_name"],
                "last_name"  => $data["subscriber"]["last_name"]
            ]);

            if (isset($subscriber)) {
                /** Create Contact */
                if (isset($data["subscriber"]['contact'])) {
                    Contact::updateOrCreate([
                        "billing_company_id" => $billingCompany->id ?? $billingCompany,
                        "contactable_id"     => $subscriber->id,
                        "contactable_type"   => Subscriber::class
                    ], $data["subscriber"]["contact"]);
                }

                /** Create Address */
                if (isset($data["subscriber"]['address'])) {
                    Address::updateOrCreate([
                        "billing_company_id" => $billingCompany->id ?? $billingCompany,
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
        return $insurancePolicy;
    }

    public function getPolicies(int $patient_id)
    {
        $patient = Patient::with("insurancePolicies")->find($patient_id);
        $insurancePolicies = $patient->insurancePolicies ?? [];
        return $insurancePolicies;
    }
}

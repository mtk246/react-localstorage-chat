<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Mail\GenerateNewPassword;
use App\Models\InsurancePlan;
use App\Models\BillingCompany;
use App\Models\Patient;
use App\Models\PatientPrivate;
use App\Models\PrivateNote;
use App\Models\PublicNote;
use App\Models\Profile;
use App\Models\SocialMedia;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Marital;
use App\Models\Guarantor;
use App\Models\Employment;
use App\Models\EmergencyContact;
use App\Models\Suscriber;
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
                    foreach ($data["profile"]["social_medias"] as $socialM) {
                        if ($socialM['name'] == $socialMedia->name) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) $socialMedia->delete();
                }

                /** update or create new social medias */
                foreach ($data["profile"]["social_medias"] as $socialMedia) {
                    SocialMedia::updateOrCreate([
                        "name"       => $socialMedia["name"],
                        "profile_id" => $profile->id
                    ], [
                        "name" => $socialMedia["name"],
                        "link" => $socialMedia["link"],
                        "profile_id" => $profile->id
                    ]);
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
                "driver_license" => $data["driver_license"],
                "user_id"        => $user->id
            ]);

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

            /** Create Marital */
            if (isset($data['marital'])) {
                $data["marital"]["patient_id"] = $patient->id;
                $marital = Marital::create($data["marital"]);
            }

            /** Create Guarantor */
            if (isset($data['guarantor'])) {
                $data["guarantor"]["patient_id"] = $patient->id;
                $guarantor = Guarantor::create($data["guarantor"]);
            }

            /** Create Employment */
            if (isset($data['employment'])) {
                $data["employment"]["patient_id"] = $patient->id;
                $employment = Employment::create($data["employment"]);
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
                    if (!$validated) $patient->insurancePlan()->detach($insurancePlan->id);
                }

                /** Attach new insurance plan*/
                foreach ($data["insurance_policies"] as $insurancePolicy) {

                    /** Attached patient to insurance plan */
                    $insurancePlan = InsurancePlan::find($insurancePolicy["insurance_plan"]);

                    if (is_null($patient->insurancePlans()->find($insurancePlan->id))) {
                        $patient->insurancePlans()->attach($insurancePlan->id, [
                            'own_insurance' => $insurancePolicy["own_insurance"]
                        ]);
                    } else {
                        $patient->insurancePlans()->updateExistingPivot($insurancePlan->id, [
                            'own_insurance' => $insurancePolicy["own_insurance"]
                        ]);
                    }
                    if ($insurancePolicy["own_insurance"] == false) {

                        /** The subscriber is searched for each billing company */
                        $suscriber = Suscriber::firstOrCreate([
                            "ssn"                => $insurancePolicy["suscriber"]["ssn"],
                            "billing_company_id" => $billingCompany->id ?? $billingCompany
                        ], [
                            "first_name" => $insurancePolicy["suscriber"]["first_name"],
                            "last_name" => $insurancePolicy["suscriber"]["last_name"]
                        ]);

                        if (isset($suscriber)) {
                            /** Create Contact */
                            if (isset($insurancePolicy["suscriber"]['contact'])) {
                                $insurancePolicy["suscriber"]["contact"]["contactable_id"]     = $suscriber->id;
                                $insurancePolicy["suscriber"]["contact"]["contactable_type"]   = Suscriber::class;
                                $insurancePolicy["suscriber"]["contact"]["billing_company_id"] = $billingCompany->id ?? $billingCompany;
                                Contact::create($insurancePolicy["suscriber"]["contact"]);
                            }

                            /** Create Address */
                            if (isset($insurancePolicy["suscriber"]['address'])) {
                                $insurancePolicy["suscriber"]["address"]["addressable_id"]     = $suscriber->id;
                                $insurancePolicy["suscriber"]["address"]["addressable_type"]   = Suscriber::class;
                                $insurancePolicy["suscriber"]["address"]["billing_company_id"] = $billingCompany->id ?? $billingCompany;
                                Address::create($insurancePolicy["suscriber"]["address"]);
                            }
                            /** Attached patient to suscriber */
                            if (is_null($patient->suscribers()->find($suscriber->id))) {
                                $patient->suscribers()->attach($suscriber->id);
                            }
                            
                            /** Attached suscriber to insurance plan */
                            if (is_null($suscriber->insurancePlans()->find($insurancePolicy["insurance_plan"]))) {
                                $suscriber->insurancePlans()->attach($insurancePolicy["insurance_plan"]);
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
                        env('URL_FRONT') . "/newPassword?mcctoken=" . $token
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
                $query->with("profile", "roles", "addresses", "contacts");
            },
            "marital",
            "guarantor",
            "employment",
            "patientPrivate",
            "emergencyContacts",
            "publicNotes",
            "privateNotes",
            "insurancePlans" => function ($query) {
                $query->with("suscribers");
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
                $query->with("profile", "roles", "addresses", "contacts");
            }, "publicNotes", "privateNotes"
        ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
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
                    foreach ($data["profile"]["social_medias"] as $socialM) {
                        if ($socialM['name'] == $socialMedia->name) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) $socialMedia->delete();
                }

                /** update or create new social medias */
                foreach ($data["profile"]["social_medias"] as $socialMedia) {
                    SocialMedia::updateOrCreate([
                        "name"       => $socialMedia["name"],
                        "profile_id" => $profile->id
                    ], [
                        "name" => $socialMedia["name"],
                        "link" => $socialMedia["link"],
                        "profile_id" => $profile->id
                    ]);
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
            if (isset($data['marital'])) {
                Marital::updateOrCreate([
                    "patient_id" => $patient->id
                ], $data["marital"]);
            }

            /** Create Guarantor */
            if (isset($data['guarantor'])) {
                Guarantor::updateOrCreate([
                    "patient_id" => $patient->id
                ], $data["guarantor"]);
            }

            /** Create Employment */
            if (isset($data['employment'])) {
                Employment::updateOrCreate([
                    "patient_id" => $patient->id
                ], $data["employment"]);
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
                    if (!$validated) $patient->insurancePlan()->detach($insurancePlan->id);
                }

                /** Attach new insurance plan*/
                foreach ($data["insurance_policies"] as $insurancePolicy) {

                    /** Attached patient to insurance plan */
                    $insurancePlan = InsurancePlan::find($insurancePolicy["insurance_plan"]);

                    if (is_null($patient->insurancePlans()->find($insurancePlan->id))) {
                        $patient->insurancePlans()->attach($insurancePlan->id, [
                            'own_insurance' => $insurancePolicy["own_insurance"]
                        ]);
                    } else {
                        $patient->insurancePlans()->updateExistingPivot($insurancePlan->id, [
                            'own_insurance' => $insurancePolicy["own_insurance"]
                        ]);
                    }
                    if ($insurancePolicy["own_insurance"] == false) {

                        /** The subscriber is searched for each billing company */
                        $suscriber = Suscriber::updateOrCreate([
                            "ssn"                => $insurancePolicy["suscriber"]["ssn"],
                            "billing_company_id" => $billingCompany->id ?? $billingCompany
                        ], [
                            "first_name" => $insurancePolicy["suscriber"]["first_name"],
                            "last_name" => $insurancePolicy["suscriber"]["last_name"]
                        ]);

                        if (isset($suscriber)) {
                            /** Create Contact */
                            if (isset($insurancePolicy["suscriber"]['contact'])) {
                                Contact::updateOrCreate([
                                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                                    "contactable_id"     => $suscriber->id,
                                    "contactable_type"   => Suscriber::class
                                ], $insurancePolicy["suscriber"]['contact']);
                            }

                            if (isset($insurancePolicy["suscriber"]['address'])) {
                                Address::updateOrCreate([
                                    "billing_company_id" => $billingCompany->id ?? $billingCompany,
                                    "addressable_id"     => $suscriber->id,
                                    "addressable_type"   => User::class
                                ], $insurancePolicy["suscriber"]["address"]);
                            }
                            /** Attached patient to suscriber */
                            if (is_null($patient->suscribers()->find($suscriber->id))) {
                                $patient->suscribers()->attach($suscriber->id);
                            }
                            
                            /** Attached suscriber to insurance plan */
                            if (is_null($suscriber->insurancePlans()->find($insurancePolicy["insurance_plan"]))) {
                                $suscriber->insurancePlans()->attach($insurancePolicy["insurance_plan"]);
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
    public function getAllSuscribers(string $ssn) {
        $patient = Patient::whereHas('user', function ($query) use ($ssn) {
            $query->whereHas('profile', function ($q) use ($ssn) {
                $q->where('ssn', $ssn);
            });
        })->with(['suscribers' => function ($query) {
            $query->with('addresses', 'contacts');
        }])->first();

        return $patient->suscribers ?? [];
    }
}

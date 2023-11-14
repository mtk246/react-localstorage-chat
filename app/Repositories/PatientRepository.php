<?php

namespace App\Repositories;

use App\Enums\User\RoleType;
use App\Enums\User\UserType;
use App\Facades\Pagination;
use App\Http\Resources\Claim\ClaimBodyResource;
use App\Mail\GenerateNewPassword;
use App\Models\Address;
use App\Models\AddressType;
use App\Models\BillingCompany;
use App\Models\Claims\ClaimEligibilityStatus;
use App\Models\Company;
use App\Models\Contact;
use App\Models\EmergencyContact;
use App\Models\Employment;
use App\Models\Guarantor;
use App\Models\InsurancePlan;
use App\Models\InsurancePolicy;
use App\Models\Marital;
use App\Models\MaritalStatus;
use App\Models\Patient;
use App\Models\Patient\Membership;
use App\Models\PrivateNote;
use App\Models\Profile;
use App\Models\PublicNote;
use App\Models\SocialMedia;
use App\Models\SocialNetwork;
use App\Models\Subscriber;
use App\Models\TypeCatalog;
use App\Models\User;
use App\Roles\Models\Role;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Laravel\Scout\Builder as ScoutBuilder;
use Meilisearch\Endpoints\Indexes;
use App\Events\User\StoreEvent;

class PatientRepository
{
    /**
     * @return User|Model|null
     */
    public function createPatient(array $data)
    {
        try {
            DB::beginTransaction();
            $billingCompany = Gate::allows('is-admin')
                ? $data['billing_company_id']
                : Auth::User()->billing_company_id;

            if (isset($data['patient_id'])) {
                $patient = Patient::query()->find($data['patient_id']);
                $user = isset($data['id'])
                    ? User::find($data['id'])
                    : $patient->profile?->user;

                $profile = $patient->profile;
            } elseif (isset($data['id'])) {
                $user = User::find($data['id']);
                $profile = $user->profile;
            }

            if (!isset($profile)) {
                /** Create Profile */
                $profile = Profile::create([
                    'ssn' => $data['profile']['ssn'] ?? null,
                    'first_name' => $data['profile']['first_name'],
                    'middle_name' => $data['profile']['middle_name'] ?? '',
                    'last_name' => $data['profile']['last_name'],
                    'sex' => $data['profile']['sex'],
                    'name_suffix_id' => $data['profile']['name_suffix_id'] ?? null,
                    'date_of_birth' => $data['profile']['date_of_birth'],
                    'deceased_date' => $data['profile']['deceased_date'] ?? null,
                    'language' => $data['language'] ?? 'en',
                ]);
            } else {
                $profile->update([
                    'first_name' => $data['profile']['first_name'],
                    'middle_name' => $data['profile']['middle_name'] ?? '',
                    'last_name' => $data['profile']['last_name'],
                    'sex' => $data['profile']['sex'],
                    'name_suffix_id' => $data['profile']['name_suffix_id'] ?? null,
                    'date_of_birth' => $data['profile']['date_of_birth'],
                    'deceased_date' => $data['profile']['deceased_date'] ?? null,
                    'language' => $data['language'] ?? 'en',
                ]);
            }

            if (isset($data['profile']['social_medias']) && !empty(filter_array_empty($data['profile']['social_medias']))) {
                $socialMedias = $profile->socialMedias()->where('billing_company_id', $billingCompany)->get();
                /* Delete socialMedia */
                foreach ($socialMedias as $socialMedia) {
                    $validated = false;
                    $socialNetwork = $socialMedia->SocialNetwork;
                    if (isset($socialNetwork)) {
                        foreach ($data['profile']['social_medias'] as $socialM) {
                            if ($socialM['name'] == $socialNetwork->name) {
                                $validated = true;
                                break;
                            }
                        }
                    }
                    if (!$validated) {
                        $socialMedia->delete();
                    }
                }

                /* update or create new social medias */
                foreach ($data['profile']['social_medias'] as $socialMedia) {
                    $socialNetwork = SocialNetwork::whereName($socialMedia['name'])->first();
                    if (isset($socialNetwork)) {
                        SocialMedia::updateOrCreate([
                            'profile_id' => $profile->id,
                            'social_network_id' => $socialNetwork->id,
                            'billing_company_id' => $billingCompany,
                        ], [
                            'link' => $socialMedia['link'],
                        ]);
                    }
                }
            }

            /* Create Contact */
            if (isset($data['contact'])) {
                $data['contact']['contactable_id'] = $profile->id;
                $data['contact']['contactable_type'] = Profile::class;
                $data['contact']['billing_company_id'] = $billingCompany;
                Contact::firstOrCreate([
                    'contactable_id' => $profile->id,
                    'contactable_type' => Profile::class,
                    'billing_company_id' => $billingCompany,
                ], $data['contact']);
            }

            /* Create Patient */
            if (!isset($patient)) {
                $patient = Patient::query()->create([
                    'code' => generateNewCode('PA', 5, date('Y'), Patient::class, 'code'),
                    'driver_license' => $data['driver_license'] ?? '',
                    'marital_status_id' => $data['marital_status_id'] ?? null,
                    'profile_id' => $profile->id,
                ]);
            }

            /* Create Address */
            if (isset($data['addresses'])) {
                foreach ($data['addresses'] as $addressData) {
                    $addressData['addressable_id'] = $profile->id;
                    $addressData['addressable_type'] = Profile::class;
                    $addressData['billing_company_id'] = $billingCompany;
                    $address = Address::query()->firstOrCreate([
                        'address_type_id' => $addressData['address_type_id'] ?? null,
                        'addressable_id' => $profile->id,
                        'addressable_type' => Profile::class,
                        'billing_company_id' => $billingCompany,
                    ], $addressData);

                    if ($addressData['main_address'] ?? false) {
                        $patient->update([
                            'main_address_id' => $address->id,
                        ]);
                    }
                }
            }

            if (is_null($patient->billingCompanies()->find($billingCompany))) {
                $patient->billingCompanies()->attach($billingCompany->id ?? $billingCompany, [
                    'status' => true,
                    'save_as_draft' => $data['save_as_draft'] ?? false,
                ]);
            } else {
                $patient->billingCompanies()->updateExistingPivot(
                    $billingCompany,
                    [
                        'status' => true,
                        'save_as_draft' => $data['save_as_draft'] ?? false,
                    ]
                );
            }

            $role = Role::whereBillingCompanyId($billingCompany->id ?? $billingCompany)
                ->whereType(RoleType::PATIENT->value)
                ->exists()
                    ? Role::whereBillingCompanyId($billingCompany->id ?? $billingCompany)
                        ->whereType(RoleType::PATIENT->value)
                        ->first()
                    : Role::whereBillingCompanyId(null)
                        ->whereType(RoleType::PATIENT->value)
                        ->first();

            $patient->billingCompanies()
                ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)
                ->first()
                ->membership
                ->roles()
                ->syncWithPivotValues($role->id, ['rollable_type' => Membership::class]);

            /* Create User */
            if (((bool) $data['create_user']) && !isset($user)) {
                if(isset($profile->user)) {
                    throw new \Exception('Cannot create user because it already exists for another billing company');
                }

                $user = User::firstOrCreate([
                    'email' => $data['contact']['email'],
                ],[
                    'usercode' => generateNewCode('US', 5, date('Y'), User::class, 'usercode'),
                    'userkey' => encrypt(uniqid('', true)),
                    'profile_id' => $profile->id,
                    'type' => UserType::PATIENT,
                    'billing_company_id' => $billingCompany,
                ]);
            }

            /* Attach billing company to user */
            if (isset($user)) {
                $user->billingCompanies()->syncWithoutDetaching($billingCompany);;
            }

            if (isset($data['public_note'])) {
                /* PublicNote */
                PublicNote::updateOrCreate([
                    'publishable_type' => Patient::class,
                    'publishable_id' => $patient->id,
                ], [
                    'note' => $data['public_note'],
                ]);
            }

            if (isset($data['private_note'])) {
                /* PrivateNote */
                PrivateNote::firstOrCreate([
                    'publishable_type' => Patient::class,
                    'publishable_id' => $patient->id,
                    'billing_company_id' => $billingCompany,
                ], [
                    'publishable_type' => Patient::class,
                    'publishable_id' => $patient->id,
                    'billing_company_id' => $billingCompany,
                    'note' => $data['private_note'],
                ]);
            }

            /* Create Marital */
            if (isset($data['marital']['spuse_name'])) {
                $data['marital']['patient_id'] = $patient->id;
                $marital = Marital::firstOrCreate([
                    'patient_id' => $patient->id,
                    'billing_company_id' => $billingCompany,
                ], $data['marital']);
            }

            /* Create Guarantor */
            if (isset($data['guarantor']['name'])) {
                $data['guarantor']['patient_id'] = $patient->id;
                $guarantor = Guarantor::firstOrCreate([
                    'patient_id' => $patient->id,
                    'billing_company_id' => $billingCompany,
                ], $data['guarantor']);
            }

            /* Create Employment */
            collect($data['employments'])->filter()->each(function($employment) use($patient, $billingCompany) {
                $employment['patient_id'] = $patient->id;
                $employment['billing_company_id'] = $billingCompany;
                Employment::firstOrCreate($employment);
            });

            /* Emergency Contacts */
            if (isset($data['emergency_contacts']) && !empty(filter_array_empty($data['emergency_contacts']))) {
                $emergencyContacts = $patient->emergencyContacts()->where('billing_company_id', $billingCompany)->get();
                /* Delete energencyContact */
                foreach ($emergencyContacts as $emergencyContact) {
                    $validated = false;
                    foreach ($data['emergency_contacts'] as $emergencyC) {
                        if ($emergencyC['name'] == $emergencyContact->name) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) {
                        $emergencyContact->delete();
                    }
                }

                /* update or create new emergency contact */
                foreach ($data['emergency_contacts'] as $emergencyContact) {
                    EmergencyContact::updateOrCreate([
                        'name' => $emergencyContact['name'] ?? null,
                        'patient_id' => $patient->id,
                        'billing_company_id' => $billingCompany,
                    ], [
                        'name' => $emergencyContact['name'] ?? null,
                        'cellphone' => $emergencyContact['cellphone'] ?? null,
                        'relationship_id' => $emergencyContact['relationship_id'] ?? null,
                        'patient_id' => $patient->id,
                    ]);
                }
            }

            /* Company */
            if (isset($data['company_id'])) {
                /** Attached patient to company */
                $company = Company::find($data['company_id']);
                if (is_null($patient->companies()->find($company->id))) {
                    $patient->companies()->attach($company->id, [
                        'med_num' => $data['company_med_num'] ?? '',
                        'billing_company_id' => $billingCompany,
                    ]);
                }
            }
            if (isset($user) && $patient) {

                if ('' == $user->token) {
                    $token = encrypt($user->id.'@#@#$'.$user->email);
                    $user->token = $token;
                    $user->save();
                    \Mail::to($user->email)->send(
                        new GenerateNewPassword(
                            $profile->first_name.' '.$profile->last_name,
                            $user->email,
                            Crypt::decrypt($user->userkey),
                            env('URL_FRONT').'/#/newCredentials?mcctoken='.$token
                        )
                    );
                }
            }

            DB::commit();

            event(new StoreEvent($user, $user->userkey));

            return $this->getOnePatient($patient->id);
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * @return Patient|Builder|Model|object|null
     */
    public function getOnePatient(int $id)
    {
        $patient = Patient::query()->find($id);

        if (Gate::allows('is-admin')) {
            $dataCompany = $patient->companies;
            $dataClaim = $patient->claims()->with(
                [
                    'billingCompany',
                    'claimStatusClaims',
                    'status',
                    'demographicInformation' => function ($query) {
                        $query->with([
                            'company' => function ($query) {
                                $query->with('nicknames');
                            },
                        ]);
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
                    'billingCompany',
                    'claimStatusClaims',
                    'status',
                    'demographicInformation.company' => function ($query) use ($billingCompany) {
                        $query->with([
                            'nicknames' => function ($q) use ($billingCompany) {
                                $q->where('billing_company_id', $billingCompany->id);
                            },
                        ]);
                    },
                ])->where('billing_company_id', $billingCompany->id)
                ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                ->paginate(Pagination::itemsPerPage());
            $dataPolicies = $patient->insurancePolicies()
                ->where('billing_company_id', $billingCompany->id ?? $billingCompany)
                ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                ->paginate(Pagination::itemsPerPage());
        }

        $companyRecords = [];
        foreach ($dataCompany as $company) {
            array_push($companyRecords, [
                'billing_company_id' => $company->pivot->billing_company_id,
                'company_id' => $company->id ?? '',
                'med_num' => $company->pivot->med_num ?? '',
                'company' => $company->name ?? '',
                'billing_company' => $company->billingCompanies()
                    ->find($company->pivot->billing_company_id)->name ?? '',
            ]);
        }

        $claimRecords = ClaimBodyResource::collection($dataClaim)->resource;

        $dataPolicies->getCollection()->transform(function (InsurancePolicy $patient_policy) {
            return [
                'id' => $patient_policy->id,
                'billing_company_id' => $patient_policy->billing_company_id,
                'billing_company' => BillingCompany::find($patient_policy->billing_company_id)->name ?? '',
                'policy_number' => $patient_policy->policy_number,
                'group_number' => $patient_policy->group_number,
                'insurance_company_id' => $patient_policy->insurancePlan->insurance_company_id ?? '',
                'insurance_company' => ($patient_policy
                    ->insurancePlan
                    ->insuranceCompany
                    ->abbreviations
                    ?->where('billing_company_id', $patient_policy->billing_company_id)
                    ->first()
                    ?->abbreviation ?? ''
                ).' - '.$patient_policy->insurancePlan->insuranceCompany->name ?? '',
                'insurance_plan_id' => $patient_policy->insurance_plan_id ?? '',
                'insurance_plan' => ($patient_policy
                    ->insurancePlan
                    ->abbreviations
                    ?->where('billing_company_id', $patient_policy->billing_company_id)
                    ->first()
                    ?->abbreviation ?? ''
                ).' - '.$patient_policy->insurancePlan->name ?? '',
                'insurance_plan_code' => $patient_policy->insurancePlan->code ?? '',
                'type_responsibility_id' => $patient_policy->type_responsibility_id ?? '',
                'type_responsibility' => $patient_policy->typeResponsibility->code ?? '',
                'insurance_policy_type_id' => $patient_policy->insurance_policy_type_id ?? '',
                'insurance_policy_type' => $patient_policy->insurancePolicyType->description ?? '',
                'eligibility' => $patient_policy->claimLastEligibility->claimEligibilityStatus ?? ClaimEligibilityStatus::query()
                    ->where('status', 'Unknow')
                    ->first(),
                'status' => $patient_policy->status ?? false,
                'eff_date' => $patient_policy->eff_date ?? '',
                'end_date' => $patient_policy->end_date ?? '',
                'assign_benefits' => $patient_policy->assign_benefits ?? false,
                'release_info' => $patient_policy->release_info ?? false,
                'own' => $patient_policy->own ?? false,
                'subscriber' => $patient_policy_subscriber ?? null,
            ];
        });
        $policiesRecords = [
            'data' => $dataPolicies->items(),
            'numberOfPages' => $dataPolicies->lastPage(),
            'count' => $dataPolicies->total(),
        ];

        $record = [
            'id' => $patient->id,
            'code' => $patient->code,
            'has_user' => isset($patient->user),
            'user' => $patient->user,
            'profile' => [
                'avatar' => $patient->profile->avatar ?? null,
                'ssn' => $patient->profile->ssn ?? '',
                'name_suffix_id' => $patient->profile->name_suffix_id ?? '',
                'name_suffix' => $patient->profile->nameSuffix->description ?? '',
                'first_name' => $patient->profile->first_name ?? '',
                'middle_name' => $patient->profile->middle_name ?? '',
                'last_name' => $patient->profile->last_name ?? '',
                'date_of_birth' => $patient->profile->date_of_birth ?? '',
                'sex' => $patient->profile->sex ?? '',
                'deceased' => $patient->profile->deceased ?? false,
                'deceased_date' => $patient->profile->deceased_date,
                'language' => $patient->profile->language ?? '',
            ],
            'driver_license' => $patient->driver_license ?? '',
            'companies' => $companyRecords ?? null,
            'claims' => $claimRecords ?? null,
            'insurance_policies' => $policiesRecords ?? null,

            'created_at' => $patient->created_at,
            'updated_at' => $patient->updated_at,
            'last_modified' => $patient->last_modified,
            'public_note' => isset($patient->publicNote) ? $patient->publicNote->note : null,
        ];

        $record['billing_companies'] = [];
        foreach ($patient->billingCompanies as $billingCompany) {
            $addresses = Address::query()->where([
                'addressable_id' => $patient->profile->id,
                'addressable_type' => Profile::class,
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ])->get();
            $contact = Contact::where([
                'contactable_id' => $patient->profile->id,
                'contactable_type' => Profile::class,
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ])->first();
            $private_note = PrivateNote::where([
                'publishable_id' => $patient->id,
                'publishable_type' => Patient::class,
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ])->first();
            $companies = $patient->companies()->where('billing_company_id', $billingCompany->id ?? $billingCompany)->get();

            $insurance_policies = $patient->insurancePolicies()
                ->where('billing_company_id', $billingCompany->id ?? $billingCompany)->get();

            $marital = $patient->maritals()
                ->where('billing_company_id', $billingCompany->id ?? $billingCompany)->first();
            $guarantor = $patient->guarantors()
                ->where('billing_company_id', $billingCompany->id ?? $billingCompany)->first();
            $emergency_contacts = $patient->emergencyContacts()
                ->where('billing_company_id', $billingCompany->id ?? $billingCompany)->get();
            $employments = $patient->employments()
                ->where('billing_company_id', $billingCompany->id ?? $billingCompany)->get();
            $social_medias = $patient->profile->socialMedias()
            ->where('billing_company_id', $billingCompany->id ?? $billingCompany)->get();

            if (isset($social_medias)) {
                $patient_social_medias = [];
                foreach ($social_medias as $social_media) {
                    array_push($patient_social_medias, [
                        'link' => $social_media->link,
                        'social_network' => $social_media->socialNetwork->name ?? '',
                        'social_network_id' => $social_media->social_network_id,
                    ]);
                }
            }

            if (isset($marital)) {
                $patient_marital = [
                    'spuse_name' => $marital->spuse_name ?? '',
                    'spuse_work' => $marital->spuse_work ?? '',
                    'spuse_work_phone' => $marital->spuse_work_phone ?? '',
                ];
            }
            if (isset($guarantor)) {
                $patient_guarantor = [
                    'name' => $guarantor->name ?? '',
                    'phone' => $guarantor->phone ?? '',
                ];
            }
            if (isset($emergency_contacts)) {
                $patient_emergency_contacts = [];
                foreach ($emergency_contacts as $emergency_contact) {
                    array_push($patient_emergency_contacts, [
                        'name' => $emergency_contact->name ?? '',
                        'cellphone' => $emergency_contact->cellphone ?? '',
                        'relationship_id' => $emergency_contact->relationship_id ?? '',
                        'relationship' => $emergency_contact->relationship?->description ?? '',
                    ]);
                }
            }

            if (isset($employments)) {
                $patient_employments = [];
                foreach ($employments as $employment) {
                    array_push($patient_employments, [
                        'employer_name' => $employment->employer_name ?? '',
                        'employer_address' => $employment->employer_address ?? '',
                        'employer_phone' => $employment->employer_phone ?? '',
                        'position' => $employment->position ?? '',
                    ]);
                }
            }

            if (isset($addresses)) {
                $patient_addresses = [];
                foreach ($addresses as $address) {
                    array_push($patient_addresses, [
                        'zip' => $address->zip,
                        'city' => $address->city,
                        'state' => $address->state,
                        'address' => $address->address,
                        'apt_suite' => $address->apt_suite ?? '',
                        'country' => $address->country ?? '',
                        'main_address' => $address->id == $patient->main_address_id,
                        'address_type_id' => $address->address_type_id,
                        'address_type' => $address->addressType->name ?? '',
                        'country_subdivision_code' => $address->country_subdivision_code ?? '',
                    ]);
                }
            }

            if (isset($contact)) {
                $patient_contact = [
                    'fax' => $contact->fax ?? '',
                    'email' => $contact->email,
                    'phone' => $contact->phone ?? '',
                    'mobile' => $contact->mobile ?? '',
                    'contact_name' => $contact->contact_name ?? '',
                ];
            }

            if (isset($companies)) {
                $patient_companies = [];
                foreach ($companies as $patient_company) {
                    array_push($patient_companies, [
                        'company_id' => $patient_company->id,
                        'company' => $patient_company->name,
                        'med_num' => $patient_company->pivot->med_num ?? '',
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
                            'addressable_id' => $subscriber->id,
                            'addressable_type' => Subscriber::class,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ])->first();
                        $contact = Contact::where([
                            'contactable_id' => $subscriber->id,
                            'contactable_type' => Subscriber::class,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ])->first();
                        if (isset($address)) {
                            $subscriber_address = [
                                'zip' => $address->zip,
                                'city' => $address->city,
                                'state' => $address->state,
                                'address' => $address->address,
                                'country' => $address->country,
                                'address_type_id' => $address->address_type_id,
                                'address_type' => $address->addressType->name ?? '',
                                'country_subdivision_code' => $address->country_subdivision_code ?? '',
                            ];
                        }

                        if (isset($contact)) {
                            $subscriber_contact = [
                                'fax' => $contact->fax ?? '',
                                'email' => $contact->email ?? '',
                                'phone' => $contact->phone ?? '',
                                'mobile' => $contact->mobile ?? '',
                                'contact_name' => $contact->contact_name ?? '',
                            ];
                        }
                        array_push($patient_policy_subscriber, [
                            'id' => $subscriber->id,
                            'ssn' => $subscriber->ssn ?? '',
                            'sex' => $subscriber->sex,
                            'first_name' => $subscriber->first_name,
                            'last_name' => $subscriber->last_name,
                            'date_of_birth' => $subscriber->date_of_birth,
                            'name_suffix_id' => $subscriber->name_suffix_id,
                            'name_suffix' => $subscriber->nameSuffix?->description ?? '',
                            'relationship_id' => $subscriber->relationship_id,
                            'relationship' => $subscriber->relationship?->description ?? '',
                            'address' => isset($subscriber_address) ? $subscriber_address : null,
                            'contact' => isset($subscriber_contact) ? $subscriber_contact : null,
                        ]);
                    }

                    array_push($patient_policies, [
                        'id' => $patient_policy->id,
                        'policy_number' => $patient_policy->policy_number,
                        'group_number' => $patient_policy->group_number,
                        'insurance_company_id' => $patient_policy->insurancePlan->insurance_company_id ?? '',
                        'insurance_company' => ($patient_policy->insurancePlan->insuranceCompany->payer_id ?? '').' - '.$patient_policy->insurancePlan->insuranceCompany->name ?? '',
                        'insurance_plan_id' => $patient_policy->insurance_plan_id ?? '',
                        'insurance_plan' => $patient_policy->insurancePlan->name ?? '',
                        'insurance_plan_code' => $patient_policy->insurancePlan->code ?? '',
                        'insurance_plan_nickname' => $patient_policy->insurancePlan->nicknames()?->where('billing_company_id', $patient_policy->billing_company_id)?->nickname ?? '',
                        'type_responsibility_id' => $patient_policy->type_responsibility_id ?? '',
                        'type_responsibility' => $patient_policy->typeResponsibility->code ?? '',
                        'insurance_policy_type_id' => $patient_policy->insurance_policy_type_id ?? '',
                        'insurance_policy_type' => $patient_policy->insurancePolicyType->description ?? '',
                        'eligibility' => $patient_policy->claimLastEligibility->claimEligibilityStatus ?? ClaimEligibilityStatus::query()
                            ->where('status', 'Unknow')
                            ->first(),
                        'status' => $patient_policy->status ?? false,
                        'eff_date' => $patient_policy->eff_date ?? '',
                        'end_date' => $patient_policy->end_date ?? '',
                        'assign_benefits' => $patient_policy->assign_benefits ?? false,
                        'release_info' => $patient_policy->release_info ?? false,
                        'own' => $patient_policy->own ?? false,
                        'subscriber' => $patient_policy_subscriber ?? null,
                    ]);
                }
            }

            array_push($record['billing_companies'], [
                'id' => $billingCompany->id,
                'name' => $billingCompany->name,
                'code' => $billingCompany->code,
                'abbreviation' => $billingCompany->abbreviation,
                'private_patient' => [
                    'marital_status_id' => $patient->marital_status_id,
                    'marital_status' => $patient->maritalStatus?->name ?? '',
                    'marital' => (($patient->maritalStatus->name ?? '' === 'Married') && isset($patient_marital))
                        ? $patient_marital : null,
                    'companies' => isset($patient_companies) ? $patient_companies : null,
                    'insurance_policies' => isset($patient_policies) ? $patient_policies : null,
                    'need_guardian' => isset($patient_guarantor) ? true : false,
                    'guarantor' => isset($patient_guarantor) ? $patient_guarantor : null,
                    'emergency_contacts' => isset($patient_emergency_contacts) ? $patient_emergency_contacts : [],
                    'employments' => isset($patient_employments) ? $patient_employments : [],
                    'social_medias' => isset($patient_social_medias) ? $patient_social_medias : [],
                    'status' => $billingCompany->membership->status ?? false,
                    'private_note' => $private_note->note ?? '',
                    'addresses' => isset($patient_addresses) ? $patient_addresses : null,
                    'contact' => isset($patient_contact) ? $patient_contact : null,
                ],
            ]);
        }

        return !is_null($record) ? $record : null;
    }

    /**
     * @return Patient|Builder|Model|object|null
     */
    public function getBySsn(string $ssn)
    {
        $patientId = Patient::whereHas('user', function ($query) use ($ssn) {
            $query->whereHas('profile', function ($q) use ($ssn) {
                $q->where('ssn', $ssn);
            });
        })->first();
        $id = $patientId->id ?? null;

        $patient = Patient::with([
            'user' => function ($query) use ($ssn) {
                $query->with(['profile' => function ($q) use ($ssn) {
                    $q->where('ssn', $ssn)
                      ->with(['socialMedias', 'addresses', 'contacts']);
                }, 'billingCompanies']);
            },
            'maritalStatus',
            'marital',
            'guarantor',
            'employments',
            'companies',
            'emergencyContacts',
            'publicNote',
            'privateNotes',
            'insurancePolicies',
            'insurancePlans' => function ($query) {
                $query->with([
                    'insuranceCompany',
                ]);
            },
        ])->find($id);

        if (is_null($patient)) {
            return null;
        }

        return $patient;
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllPatient()
    {
        return Patient::with([
            'user' => function ($query) {
                $query->with(['profile' => function ($q) {
                    $q->with(['socialMedias', 'addresses', 'contacts']);
                }, 'billingCompanies']);
            },
            'maritalStatus',
            // "marital",
            // "guarantor",
            'employments',
            'companies',
            'emergencyContacts',
            // "publicNote",
            'privateNotes',
            'insurancePolicies',
            'billingCompanies',
            'insurancePlans' => function ($query) {
                $query->with('insuranceCompany');
            },
        ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
    }

    public function getServerAllPatient(Request $request)
    {
        $config = config('scout.meilisearch.index-settings.'.Patient::class.'.sortableAttributes');

        /** @var Builder|Patient $data */
        $data = Patient::search($request->query('query') ?? '',
            function (Indexes $searchEngine, string $query, array $options) use ($request, $config) {
                $options['attributesToSearchOn'] = [
                    'profile.first_name',
                    'profile.middle_name',
                    'profile.last_name',
                    'profile.date_of_birth',
                    'abbreviations.abbreviation',
                ];

                if (isset($request->sortBy) && in_array($request->sortBy, $config)){
                    $options['sort'] = [$request->sortBy.':'.Pagination::sortDesc()];
                }

                return $searchEngine->search($query, $options);
            }
        )
        ->when(
            Gate::denies('is-admin'),
            function (ScoutBuilder $query) {
                $bC = auth()->user()->billing_company_id ?? null;

                $query->where('billingCompanies.id', $bC)->query(fn (Builder $query) => $query
                    ->with([
                        'user',
                        'user.billingCompanies',
                        'profile',
                        'profile.socialMedias',
                        'profile.addresses',
                        'profile.contacts',
                        'employments',
                        'companies',
                        'emergencyContacts',
                        'publicNote',
                        'privateNotes',
                        'insurancePolicies',
                        'billingCompanies' => function ($query) use ($bC) {
                            $query->where('billing_company_id', $bC);
                        },
                        'insurancePlans',
                        'insurancePlans.insuranceCompany',
                    ])
                );
            },
            fn (ScoutBuilder $query) => $query->query(fn (Builder $query) => $query
                ->with([
                    'user',
                    'user.billingCompanies',
                    'profile',
                    'profile.socialMedias',
                    'profile.addresses',
                    'profile.contacts',
                    'employments',
                    'companies',
                    'emergencyContacts',
                    'publicNote',
                    'privateNotes',
                    'insurancePolicies',
                    'billingCompanies',
                    'insurancePlans',
                    'insurancePlans.insuranceCompany',
                ])
            ),
        );

        $data = $data->paginate($request->itemsPerPage ?? 10);

        return response()->json([
            'data' => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count' => $data->total(),
        ], 200);
    }

    /**
     * @return Patient|Builder|Model|object|null
     */
    public function updatePatient(array $data, int $id)
    {
        try {
            DB::beginTransaction();

            $patient = Patient::query()->find($id);
            $user = $patient->user;
            $profile = $patient->profile;

            $billingCompany = Gate::allows('is-admin')
                ? $data['billing_company_id']
                : auth()->user()->billingCompanies->first();

            /* Update Patient */
            $patient->update([
                'driver_license' => $data['driver_license'],
                'marital_status_id' => $data['marital_status_id'] ?? null,
                'profile_id' => $profile->id,
            ]);

            if (is_null($patient->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $patient->billingCompanies()->attach($billingCompany->id ?? $billingCompany, [
                    'save_as_draft' => $data['save_as_draft'] ?? false,
                ]);
            } else {
                $patient->billingCompanies()->updateExistingPivot(
                    $billingCompany->id ?? $billingCompany,
                    [
                        'status' => true,
                        'save_as_draft' => $data['save_as_draft'] ?? false,
                    ]
                );
            }

            if (isset($data['public_note'])) {
                /* PublicNote */
                PublicNote::updateOrCreate([
                    'publishable_type' => Patient::class,
                    'publishable_id' => $patient->id,
                ], [
                    'note' => $data['public_note'],
                ]);
            }

            if (isset($data['private_note'])) {
                /* PrivateNote */
                PrivateNote::updateOrCreate([
                    'publishable_type' => Patient::class,
                    'publishable_id' => $patient->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'note' => $data['private_note'],
                ]);
            }

            /* Create User */
            if (((bool) $data['create_user']) && !isset($user)) {
                $user = User::query()->create([
                    'usercode' => generateNewCode('US', 5, date('Y'), User::class, 'usercode'),
                    'email' => $data['contact']['email'],
                    'userkey' => encrypt(uniqid('', true)),
                    'profile_id' => $profile->id,
                ]);
            }

            /* Update User */
            if ($user) {
                $user->billingCompanies()->sync($billingCompany->id ?? $billingCompany);
            }

            /* Create Profile */
            $profile->update([
                'ssn' => $data['profile']['ssn'],
                'first_name' => $data['profile']['first_name'],
                'middle_name' => $data['profile']['middle_name'],
                'last_name' => $data['profile']['last_name'],
                'sex' => $data['profile']['sex'],
                'name_suffix_id' => $data['profile']['name_suffix_id'] ?? null,
                'date_of_birth' => $data['profile']['date_of_birth'],
                'deceased_date' => $data['profile']['deceased_date'] ?? null,
                'language' => $data['language'] ?? 'en',
            ]);

            if (isset($data['profile']['social_medias']) && !empty(filter_array_empty($data['profile']['social_medias']))) {
                $socialMedias = $profile->socialMedias()
                    ->where('billing_company_id', $billingCompany->id ?? $billingCompany)->get();
                /* Delete socialMedia */
                foreach ($socialMedias as $socialMedia) {
                    $validated = false;
                    $socialNetwork = $socialMedia->SocialNetwork;
                    if (isset($socialNetwork)) {
                        foreach ($data['profile']['social_medias'] as $socialM) {
                            if ($socialM['name'] == $socialNetwork->name) {
                                $validated = true;
                                break;
                            }
                        }
                    }
                    if (!$validated) {
                        $socialMedia->delete();
                    }
                }

                /* update or create new social medias */
                foreach ($data['profile']['social_medias'] as $socialMedia) {
                    $socialNetwork = SocialNetwork::whereName($socialMedia['name'])->first();
                    if (isset($socialNetwork)) {
                        SocialMedia::updateOrCreate([
                            'profile_id' => $profile->id,
                            'social_network_id' => $socialNetwork->id,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ], [
                            'link' => $socialMedia['link'],
                        ]);
                    }
                }
            }

            /* Create Contact */
            if (isset($data['contact'])) {
                Contact::updateOrCreate([
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'contactable_id' => $profile->id,
                    'contactable_type' => Profile::class,
                ], $data['contact']);
            }

            if (isset($data['addresses'])) {
                $addresses = collect($data['addresses'])
                    ->map(function ($address) use ($billingCompany, $profile, $patient) {
                        $addressId = Address::query()->updateOrCreate([
                            'address_type_id' => $address['address_type_id'] ?? null,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                            'addressable_id' => $profile->id,
                            'addressable_type' => Profile::class,
                        ], $address)->id;

                        if ($address['main_address'] ?? false) {
                            $patient->update([
                                'main_address_id' => $addressId,
                            ]);
                        }
                        return $addressId;
                    });

                Address::query()
                    ->where('billing_company_id', $billingCompany->id ?? $billingCompany)
                    ->where('addressable_id', $profile->id)
                    ->where('addressable_type', Profile::class)
                    ->whereNotIn('id', $addresses->toArray())
                    ->delete();
            }

            /* Create Marital */
            if (isset($data['marital']['spuse_name'])) {
                Marital::updateOrCreate([
                    'patient_id' => $patient->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], $data['marital']);
            }

            /* Create Guarantor */
            if (isset($data['guarantor']['name'])) {
                Guarantor::updateOrCreate([
                    'patient_id' => $patient->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], $data['guarantor']);
            }

            /* Create Employment */
            $patient->employments()
                ->where('billing_company_id', $billingCompany->id ?? $billingCompany)
                ->delete();

            collect($data['employments'])
                ->filter(fn($employment) => !empty($employment) && !empty($employment['employer_name']))
                ->each(function($employment) use($patient, $billingCompany) {
                    $employment['patient_id'] = $patient->id;
                    $employment['billing_company_id'] = $billingCompany->id ?? $billingCompany;
                    Employment::create($employment);
                });

            /* Emergency Contacts */
            $patient->emergencyContacts()->delete();

            if (isset($data['emergency_contacts']) && !empty(filter_array_empty($data['emergency_contacts']))) {
                $emergencyContacts = $patient->emergencyContacts()
                    ->where('billing_company_id', $billingCompany->id ?? $billingCompany)->get();
                /* Delete energencyContact */
                foreach ($emergencyContacts as $emergencyContact) {
                    $validated = false;
                    foreach ($data['emergency_contacts'] as $emergencyC) {
                        if ($emergencyC['name'] == $emergencyContact->name) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) {
                        $emergencyContact->delete();
                    }
                }

                /* update or create new emergency contact */
                foreach ($data['emergency_contacts'] as $emergencyContact) {
                    EmergencyContact::updateOrCreate([
                        'name' => $emergencyContact['name'] ?? null,
                        'patient_id' => $patient->id,
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    ], [
                        'name' => $emergencyContact['name'] ?? null,
                        'cellphone' => $emergencyContact['cellphone'] ?? null,
                        'relationship_id' => $emergencyContact['relationship_id'] ?? null,
                        'patient_id' => $patient->id,
                    ]);
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

            throw $e;
        }
    }

    /**
     * @return Builder[]|Collection
     */
    public function getAllSubscribers(array $data)
    {
        $patient_id = $data['patient_id'];
        $billingCompany = !Gate::allows('is-admin')
            ? auth()->user()->billingCompanies->first()
            : $data['billing_company_id'] ?? null;
        $patient = Patient::find($patient_id);
        $subscribers = [];
        foreach ($patient->subscribers ?? [] as $subscriber) {
            $subscriber_address = null;
            $subscriber_contact = null;
            if (isset($subscriber)) {
                $address = Address::where([
                    'addressable_id' => $subscriber->id,
                    'addressable_type' => Subscriber::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ])->first();
                $contact = Contact::where([
                    'contactable_id' => $subscriber->id,
                    'contactable_type' => Subscriber::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ])->first();
                if (isset($address)) {
                    $subscriber_address = [
                        'zip' => $address->zip,
                        'city' => $address->city,
                        'state' => $address->state,
                        'address' => $address->address,
                        'country' => $address->country,
                        'address_type_id' => $address->address_type_id,
                        'address_type' => $address->addressType->name ?? '',
                    ];
                }

                if (isset($contact)) {
                    $subscriber_contact = [
                        'fax' => $contact->fax,
                        'email' => $contact->email,
                        'phone' => $contact->phone,
                        'mobile' => $contact->mobile,
                        'contact_name' => $contact->contact_name,
                    ];
                }
                array_push($subscribers, [
                    'id' => $subscriber->id,
                    'ssn' => $subscriber->ssn,
                    'first_name' => $subscriber->first_name,
                    'last_name' => $subscriber->last_name,
                    'sex' => $subscriber->sex,
                    'name_suffix_id' => $subscriber->name_suffix_id,
                    'name_suffix' => $subscriber->nameSuffix->description ?? '',
                    'date_of_birth' => $subscriber->date_of_birth,
                    'relationship_id' => $subscriber->relationship_id,
                    'relationship' => $subscriber->relationship->description ?? '',
                    'address' => isset($subscriber_address) ? $subscriber_address : null,
                    'contact' => isset($subscriber_contact) ? $subscriber_contact : null,
                ]);
            }
        }

        return $subscribers ?? [];
    }

    /**
     * @return bool|int|null
     */
    public function changeStatus(bool $status, int $id)
    {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) {
            return null;
        }

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
     *
     * @return JsonResponse
     */
    public function addPolicy(array $data, int $id)
    {
        try {
            DB::beginTransaction();

            $patient = Patient::find($id);
            if (!Gate::allows('is-admin')) {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            /** Attached patient to insurance plan */
            $insurancePlan = InsurancePlan::find($data['insurance_plan']);

            $insurancePolicy = InsurancePolicy::create([
                'own' => $data['own_insurance'] ?? false,
                'policy_number' => $data['policy_number'],
                'group_number' => $data['group_number'] ?? '',
                'eff_date' => $data['eff_date'] ?? null,
                'end_date' => $data['end_date'] ?? null,
                'insurance_policy_type_id' => $data['insurance_policy_type_id'] ?? null,
                'type_responsibility_id' => $data['type_responsibility_id'],
                'release_info' => $data['release_info'],
                'assign_benefits' => $data['assign_benefits'],
                'patient_id' => $patient->id,
                'insurance_plan_id' => $insurancePlan->id,
                'billing_company_id' => $billingCompany->id ?? $data['billing_company_id'],
            ]);

            if (is_null($patient->insurancePlans()->find($insurancePlan->id))) {
                $patient->insurancePlans()->attach($insurancePlan->id);
            }

            if (false == $data['own_insurance']) {
                /** The subscriber is searched for each billing company */
                $subscriber = Subscriber::updateOrCreate([
                    'id' => $data['subscriber']['id'] ?? null,
                ], [
                    'ssn' => $data['subscriber']['ssn'],
                    'sex' => upperCaseWords($data['subscriber']['sex'] ?? ''),
                    'first_name' => upperCaseWords($data['subscriber']['first_name']),
                    'last_name' => upperCaseWords($data['subscriber']['last_name']),
                    'name_suffix_id' => $data['subscriber']['name_suffix_id'] ?? null,
                    'date_of_birth' => $data['subscriber']['date_of_birth'],
                    'relationship_id' => $data['subscriber']['relationship_id'],
                ]);

                if (isset($subscriber)) {
                    /* Create Contact */
                    if (isset($data['subscriber']['contact'])) {
                        Contact::updateOrCreate([
                            'billing_company_id' => $billingCompany->id ?? $data['billing_company_id'],
                            'contactable_id' => $subscriber->id,
                            'contactable_type' => Subscriber::class,
                        ], $data['subscriber']['contact']);
                    }

                    /* Create Address */
                    if (isset($data['subscriber']['address'])) {
                        Address::updateOrCreate([
                            'billing_company_id' => $billingCompany->id ?? $data['billing_company_id'],
                            'addressable_id' => $subscriber->id,
                            'addressable_type' => Subscriber::class,
                        ], $data['subscriber']['address']);
                    }
                    /* Attached patient to subscriber */
                    if (is_null($patient->subscribers()->find($subscriber->id))) {
                        $patient->subscribers()->attach($subscriber->id);
                    }

                    /* Attached insurance policy to subscriber */
                    if (is_null($insurancePolicy->subscribers()->find($subscriber->id))) {
                        $insurancePolicy->subscribers()->attach($subscriber->id);
                    }
                }
            }

            DB::commit();

            return $this->getOnePatient($patient->id);
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    public function changeStatusPolicy(array $data, int $insurance_policy_id, int $patient_id)
    {
        $insurancePolicy = InsurancePolicy::find($insurance_policy_id);
        if (isset($insurancePolicy)) {
            $insurancePolicy->status = $data['status'];
            $insurancePolicy->save();
        }

        return !is_null($insurancePolicy) ? $insurancePolicy : null;
    }

    public function editPolicy(array $data, int $insurance_policy_id, int $patient_id)
    {
        $patient = Patient::find($patient_id);
        $insurancePolicy = InsurancePolicy::find($insurance_policy_id);

        if (!Gate::allows('is-admin')) {
            $billingCompany = auth()->user()->billingCompanies->first();
        }

        $insurancePolicy->update([
            'policy_number' => $data['policy_number'],
            'insurance_plan_id' => $data['insurance_plan'],
            'group_number' => $data['group_number'] ?? '',
            'eff_date' => $data['eff_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'insurance_policy_type_id' => $data['insurance_policy_type_id'] ?? null,
            'type_responsibility_id' => $data['type_responsibility_id'],
            'release_info' => $data['release_info'],
            'assign_benefits' => $data['assign_benefits'],
            'billing_company_id' => $billingCompany->id ?? $data['billing_company_id'],
            'own' => $data['own_insurance'],
        ]);

        if (false == $data['own_insurance']) {
            /** The subscriber is searched for each billing company */
            $subscriber = Subscriber::updateOrCreate([
                'id' => $data['subscriber']['id'] ?? null,
            ], [
                'first_name' => upperCaseWords($data['subscriber']['first_name']),
                'last_name' => upperCaseWords($data['subscriber']['last_name']),
                'sex' => upperCaseWords($data['subscriber']['sex'] ?? ''),
                'name_suffix_id' => $data['subscriber']['name_suffix_id'] ?? null,
                'date_of_birth' => $data['subscriber']['date_of_birth'],
                'relationship_id' => $data['subscriber']['relationship_id'],
            ]);

            if (isset($subscriber)) {
                /* Create Contact */
                if (isset($data['subscriber']['contact'])) {
                    Contact::updateOrCreate([
                        'billing_company_id' => $billingCompany->id ?? $data['billing_company_id'],
                        'contactable_id' => $subscriber->id,
                        'contactable_type' => Subscriber::class,
                    ], $data['subscriber']['contact']);
                }

                /* Create Address */
                if (isset($data['subscriber']['address'])) {
                    Address::updateOrCreate([
                        'billing_company_id' => $billingCompany->id ?? $data['billing_company_id'],
                        'addressable_id' => $subscriber->id,
                        'addressable_type' => Subscriber::class,
                    ], $data['subscriber']['address']);
                }
                /* Attached patient to subscriber */
                if (is_null($patient->subscribers()->find($subscriber->id))) {
                    $patient->subscribers()->attach($subscriber->id);
                }

                /* Attached patient to subscriber */
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
        $insurancePolicy = InsurancePolicy::find($insurance_policy_id);
        $subscriber = $insurancePolicy->subscribers->first();
        if (isset($subscriber)) {
            $address = Address::query()->where([
                'addressable_id' => $subscriber->id,
                'addressable_type' => Subscriber::class,
                'billing_company_id' => $insurancePolicy->billing_company_id,
            ])->first();
            $contact = Contact::where([
                'contactable_id' => $subscriber->id,
                'contactable_type' => Subscriber::class,
                'billing_company_id' => $insurancePolicy->billing_company_id,
            ])->first();
            if (isset($address)) {
                $subscriber_address = [
                    'zip' => $address->zip,
                    'city' => $address->city,
                    'state' => $address->state,
                    'address' => $address->address,
                    'country' => $address->country,
                    'address_type_id' => $address->address_type_id ?? '',
                    'address_type' => $address->addressType->name ?? '',
                    'country_subdivision_code' => $address->country_subdivision_code ?? '',
                    'apt_suite' => $address->apt_suite ?? '',
                ];
            }

            if (isset($contact)) {
                $subscriber_contact = [
                    'fax' => $contact->fax ?? '',
                    'email' => $contact->email ?? '',
                    'phone' => $contact->phone ?? '',
                    'mobile' => $contact->mobile ?? '',
                    'contact_name' => $contact->contact_name ?? '',
                ];
            }
        }
        $record = [
            'billing_company_id' => $insurancePolicy->billing_company_id,
            'billing_company' => BillingCompany::find($insurancePolicy->billing_company_id)->name ?? '',
            'id' => $insurancePolicy->id,
            'policy_number' => $insurancePolicy->policy_number,
            'group_number' => $insurancePolicy->group_number,
            'insurance_company_id' => $insurancePolicy->insurancePlan->insurance_company_id ?? '',
            'insurance_company' => ($insurancePolicy->insurancePlan->insuranceCompany->payer_id ?? '').' - '.$insurancePolicy->insurancePlan->insuranceCompany->name ?? '',
            'insurance_plan_id' => $insurancePolicy->insurance_plan_id ?? '',
            'insurance_plan' => $insurancePolicy->insurancePlan->name ?? '',
            'insurance_plan_code' => $insurancePolicy->insurancePlan->code ?? '',
            'insurance_plan_nickname' => $insurancePolicy->insurancePlan->nicknames()?->where('billing_company_id', $insurancePolicy->billing_company_id)?->nickname ?? '',
            'type_responsibility_id' => $insurancePolicy->type_responsibility_id ?? '',
            'type_responsibility' => $insurancePolicy->typeResponsibility->code ?? '',
            'insurance_policy_type_id' => $insurancePolicy->insurance_policy_type_id ?? '',
            'insurance_policy_type' => $insurancePolicy->insurancePolicyType->description ?? '',
            'claim_last_eligibility' => $insurancePolicy->claimLastEligibility->claimEligibilityStatus ?? null,
            'status' => $insurancePolicy->status ?? false,
            'eff_date' => $insurancePolicy->eff_date ?? '',
            'end_date' => $insurancePolicy->end_date ?? '',
            'assign_benefits' => $insurancePolicy->assign_benefits ?? false,
            'release_info' => $insurancePolicy->release_info ?? false,
            'own_insurance' => $insurancePolicy->own ?? false,
            'subscriber' => isset($subscriber) ? [
                'id' => $subscriber->id,
                'ssn' => $subscriber->ssn ?? '',
                'sex' => $subscriber->sex ?? '',
                'name_suffix_id' => $subscriber->name_suffix_id ?? '',
                'name_suffix' => $subscriber->nameSuffix?->description ?? '',
                'first_name' => $subscriber->first_name,
                'last_name' => $subscriber->last_name,
                'date_of_birth' => $subscriber->date_of_birth ?? '',
                'relationship_id' => $subscriber->relationship_id ?? '',
                'relationship' => $subscriber->relationship?->description ?? '',
                'address' => isset($subscriber_address) ? $subscriber_address : null,
                'contact' => isset($subscriber_contact) ? $subscriber_contact : null,
            ] : null,
        ];

        return !is_null($record)
                ? $record
                : null;
    }

    public function getPolicies(Request $request, int $patient_id)
    {
        $patient = Patient::with('insurancePolicies')->find($patient_id);

        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = $patient->insurancePolicies()
                ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                ->paginate(Pagination::itemsPerPage());
        } else {
            $data = $patient->insurancePolicies()
                ->where('billing_company_id', $bC)
                ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
                ->paginate(Pagination::itemsPerPage());
        }

        $data->getCollection()->transform(fn ($policy) => [
            'billing_company_id' => $policy->billing_company_id,
            'billing_company' => BillingCompany::find($policy->billing_company_id)->name ?? '',
            'id' => $policy->id,
            'policy_number' => $policy->policy_number,
            'group_number' => $policy->group_number,
            'insurance_company_id' => $policy->insurancePlan->insurance_company_id ?? '',
            'insurance_company' => ($policy
                ->insurancePlan
                ->insuranceCompany
                ->abbreviations
                ?->where('billing_company_id', $policy->billing_company_id)
                ->first()
                ?->abbreviation ?? ''
            ).' - '.$policy->insurancePlan->insuranceCompany->name ?? '',
            'insurance_plan_id' => $policy->insurance_plan_id ?? '',
            'insurance_plan' => ($policy
                ->insurancePlan
                ->abbreviations
                ?->where('billing_company_id', $policy->billing_company_id)
                ->first()
                ?->abbreviation ?? ''
            ).' - '.$policy->insurancePlan->name ?? '',
            'insurance_plan_code' => $policy->insurancePlan->code ?? '',
            'insurance_plan_nickname' => $policy->insurancePlan->nicknames()?->where('billing_company_id', $policy->billing_company_id)?->nickname ?? '',
            'type_responsibility_id' => $policy->type_responsibility_id ?? '',
            'type_responsibility' => $policy->typeResponsibility->code ?? '',
            'insurance_policy_type_id' => $policy->insurance_policy_type_id ?? '',
            'insurance_policy_type' => $policy->insurancePolicyType->description ?? '',
            'eligibility' => $policy->claimLastEligibility->claimEligibilityStatus ?? ClaimEligibilityStatus::query()
                ->where('status', 'Unknow')
                ->first(),
            'status' => $policy->status ?? false,
            'eff_date' => $policy->eff_date ?? '',
            'end_date' => $policy->end_date ?? '',
            'assign_benefits' => $policy->assign_benefits ?? false,
            'release_info' => $policy->release_info ?? false,
            'own_insurance' => $policy->own ?? false,
            'subscriber' => $policy_subscriber ?? null,
        ]);

        return response()->json([
            'data' => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count' => $data->total(),
        ], 200);
    }

    public function getList(Request $request)
    {
        $records = [];
        $billingCompanyId = $request->billing_company_id ?? null;
        $companyId = str_contains($request->company_id ?? '', '-')
            ? explode('-', $request->company_id ?? '')[0]
            : $request->company_id ?? null;

        $billingCompany = Gate::allows('is-admin')
            ? $billingCompanyId
            : auth()->user()->billingCompanies->first();

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
                'id' => $patient->id,
                'name' => $patient->code.' - '.
                          $patient->profile->first_name.' '.
                          substr($patient->profile->middle_name, 0, 1).' '.
                          $patient->profile->last_name,
            ]);
        }

        return $records;
    }

    public function getListMaritalStatus()
    {
        try {
            return getList(MaritalStatus::class);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListAddressType()
    {
        try {
            return getList(AddressType::class);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListInsurancePolicyType()
    {
        try {
            return [
                "general" => getList(TypeCatalog::class, ['description'], ['relationship' => 'type', 'where' => ['description' => 'Insurance policy type']]),
                "secondary" => getList(TypeCatalog::class, ['description'], ['relationship' => 'type', 'where' => ['description' => 'Medicare secondary policy']]),
            ];
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListRelationship()
    {
        try {
            return getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => 'Patient relationship']]);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListResponsibilityType()
    {
        try {
            return getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => 'Responsibility type']]);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListBillingCompanies(Request $request)
    {
        $patientId = $request->patient_id ?? null;
        $edit = $request->edit ?? 'false';

        if (is_null($patientId)) {
            return getList(BillingCompany::class, ['code', '-', 'name'], ['status' => true]);
        } else {
            $ids = [];
            $billingCompanies = Patient::find($patientId)->billingCompanies;
            foreach ($billingCompanies as $field) {
                array_push($ids, $field->id);
            }
            if ('true' == $edit) {
                return getList(BillingCompany::class, ['code', '-', 'name'], ['where' => ['status' => true], 'exists' => 'patients', 'whereHas' => ['relationship' => 'patients', 'where' => ['patient_id' => $patientId]]]);
            } else {
                return getList(BillingCompany::class, ['code', '-', 'name'], ['where' => ['status' => true], 'not_exists' => 'patients', 'orWhereHas' => ['relationship' => 'patients', 'where' => ['billing_company_id', $ids]]]);
            }
        }
    }

    public function search(Request $request)
    {

        $query = Patient::query()
            ->with(['profile', 'profile.user', 'profile.contacts', 'billingCompanies'])
            ->whereHas('profile', function ($query) use ($request) {
                $date_of_birth = $request->date_of_birth;
                $first_name = $request->first_name;
                $last_name = $request->last_name;
                $ssn = $request->ssn ?? '';
                $email = $request->email ?? '';

                return $query
                    ->when($date_of_birth, function ($query) use ($date_of_birth) {
                        return $query->whereDateOfBirth($date_of_birth);
                    })
                    ->when($first_name, function ($query) use ($first_name) {
                        return $query->whereRaw('LOWER(first_name) LIKE (?)', [
                            strtolower("%$first_name%")
                        ]);
                    })
                    ->when($last_name, function ($query) use ($last_name) {
                        return $query->whereRaw('LOWER(last_name) LIKE (?)', [
                            strtolower("%$last_name%")
                        ]);
                    })
                    ->when($ssn, function ($query) use ($ssn) {
                        $ssnFormated = substr($ssn, 0, 1).'-'.substr($ssn, 1, strlen($ssn));

                        return $query->where(function ($query) use ($ssn, $ssnFormated) {
                            $query
                                ->whereRaw('LOWER(ssn) LIKE (?)', [strtolower("%$ssn%")])
                                ->orWhereRaw('LOWER(ssn) LIKE (?)', [strtolower("%$ssnFormated")]);
                        });
                    })
                    ->when($email, function ($query) use ($email) {
                        return $query->whereHas('contacts', function ($query) use ($email) {
                            return $query->where('email', $email);
                        });
                    });
            });

        $users = $query->get()->map(function (Patient $patien) {
            $user = $patien->profile->user;
            $billingCompaniesRole = $user?->billingCompanies->map(function (BillingCompany $billingCompany) {
                return [
                    'id' => $billingCompany->id,
                    'name' => $billingCompany->name,
                ];
            })->toArray();


            $billingCompanies = BillingCompany::query()
                ->where('status', true)
                ->when(Gate::denies('is-admin'), function ($query) {
                    $billingCompaniesUser = auth()->user()->billingCompanies
                        ->take(1)
                        ->pluck('id')
                        ->toArray();

                    return $query->whereIn('billing_companies.id', $billingCompaniesUser ?? []);
                })
                ->whereNotIn(
                    'billing_companies.id',
                    $patien->billingCompanies->pluck('id')->toArray() ?? []
                )
                ->get()
                ->toArray();

            return [
                'id' => $user?->id,
                'email' => $user?->email,
                'profile_id' => $patien->profile_id,
                'patient_id' => $patien->id,
                'forbidden' => empty($billingCompanies)
                    ? ((Gate::check('is-admin'))
                        ? 'The patient has already been associated with all the billing companies registered'
                        : 'The Patient is already created')
                    : null,
                'profile' => [
                    'ssn' => $patien->profile->ssn,
                    'first_name' => $patien->profile->first_name,
                    'middle_name' => $patien->profile->middle_name,
                    'last_name' => $patien->profile->last_name,
                    'sex' => $patien->profile->sex,
                    'date_of_birth' => $patien->profile->date_of_birth,
                    'avatar' => $patien->profile->avatar,
                    'credit_score' => $patien->profile->credit_score,
                    'name_suffix_id' => $patien->profile->name_suffix_id,
                    'name_suffix' => $patien->profile->nameSuffix,
                    'contacs' => $patien->profile->contacts->map(function (Contact $query) {
                        $return['email'] = $query->email;

                        if (Gate::allows('is-admin')) {
                            $return['billing_company'] = $query->billingCompany;
                        }

                        return $return;
                    }),
                ],
                'language' => $user?->language,
                'billing_companies' => $billingCompaniesRole,
            ];
        })->toArray();

        return (0 == count($users)) ? null : $users;
    }

    public function addCompanies(array $data, int $id)
    {
        try {
            DB::beginTransaction();
            $patient = Patient::find($id);

            if (Gate::allows('is-admin')) {
                $companies = $patient->companies()->get();
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
                $companies = $patient->companies()
                                     ->where('billing_company_id', $billingCompany->id ?? $billingCompany)
                                     ->get();
            }

            /* Detach Company */
            foreach ($companies as $company) {
                $validated = false;
                foreach ($data as $dataCompany) {
                    if (($dataCompany['company_id'] == $company->id) &&
                        ($company->pivot->billing_company_id == ($billingCompany->id ?? $dataCompany['billing_company_id']))) {
                        $validated = true;
                        break;
                    }
                }
                if (!$validated) {
                    $patient->companies()->detach($company->id);
                }
            }

            /* Attached patient to company */
            foreach ($data as $dataCompany) {
                $company = Company::find($dataCompany['company_id']);

                if (isset($company)) {
                    if (is_null($patient->companies()->find($company->id))) {
                        $patient->companies()->attach($company->id, [
                            'med_num' => $dataCompany['med_num'] ?? '',
                            'billing_company_id' => $billingCompany->id ?? $dataCompany['billing_company_id'],
                        ]);
                    } else {
                        $patient->companies()->updateExistingPivot($company->id, [
                            'med_num' => $dataCompany['med_num'] ?? '',
                            'billing_company_id' => $billingCompany->id ?? $dataCompany['billing_company_id'],
                        ]);
                    }
                }
            }

            if (Gate::allows('is-admin')) {
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
                    'company_id' => $company->id,
                    'med_num' => $company->pivot->med_num,
                    'company' => $company->name,
                    'billing_company' => $company->billingCompanies()
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

<?php

namespace App\Repositories;

use App\Facades\Pagination;
use App\Http\Resources\Claim\ClaimBodyResource;
use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\Claims\ClaimEligibilityStatus;
use App\Models\Contact;
use App\Models\InsurancePolicy;
use App\Models\Patient;
use App\Models\PrivateNote;
use App\Models\Profile;
use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class DenialRepository
{
    /**
     * @return Denial|Builder|Model|object|null
     */
    public function getOneDenial(int $id)
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
}

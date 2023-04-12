<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\BillingCompany;
use App\Models\InsurancePlan;
use App\Models\InsurancePlanPrivate;
use App\Models\TypeCatalog;
use App\Models\PublicNote;
use App\Models\PrivateNote;
use App\Models\EntityAbbreviation;
use App\Models\EntityTimeFailed;
use App\Models\EntityNickname;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Copay;
use App\Models\ContractFee;
use App\Models\MacLocality;

class InsurancePlanRepository
{
    /**
     * @param array $data
     * @return null
     */
    public function createInsurancePlan(array $data) {
        try {
            DB::beginTransaction();
            $insurancePlan = InsurancePlan::where([
                'insurance_company_id' => $data['insurance_company_id'],
                'name'                 => $data['name'],
                'payer_id'             => $data['payer_id']
            ])->first();
            if (isset($insurancePlan)) {
                $insurancePlan->update([
                    'ins_type_id'          => $data['ins_type_id'],
                    'plan_type_id'         => $data['plan_type_id'] ?? null,
                    'accept_assign'        => $data['accept_assign'],
                    'pre_authorization'    => $data['pre_authorization'],
                    'file_zero_changes'    => $data['file_zero_changes'],
                    'referral_required'    => $data['referral_required'],
                    'accrue_patient_resp'  => $data['accrue_patient_resp'],
                    'require_abn'          => $data['require_abn'],
                    'pqrs_eligible'        => $data['pqrs_eligible'],
                    'allow_attached_files' => $data['allow_attached_files'],
                    'eff_date'             => $data['eff_date'],
                    'charge_using_id'      => $data['charge_using_id'] ?? null
                ]);
            } else {
                $insurancePlan = InsurancePlan::create([
                    'code'                 => generateNewCode('IP', 5, date('Y'), InsurancePlan::class, 'code'),
                    'name'                 => $data['name'],
                    'payer_id'             => $data['payer_id'],
                    'ins_type_id'          => $data['ins_type_id'],
                    'plan_type_id'         => $data['plan_type_id'] ?? null,
                    'accept_assign'        => $data['accept_assign'],
                    'pre_authorization'    => $data['pre_authorization'],
                    'file_zero_changes'    => $data['file_zero_changes'],
                    'referral_required'    => $data['referral_required'],
                    'accrue_patient_resp'  => $data['accrue_patient_resp'],
                    'require_abn'          => $data['require_abn'],
                    'pqrs_eligible'        => $data['pqrs_eligible'],
                    'allow_attached_files' => $data['allow_attached_files'],
                    'eff_date'             => $data['eff_date'],
                    'charge_using_id'      => $data['charge_using_id'] ?? null,
                    'insurance_company_id' => $data['insurance_company_id']
                ]);
            }

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            /** Attach billing company */
            $insurancePlan->billingCompanies()->attach($billingCompany->id ?? $billingCompany);

            InsurancePlanPrivate::create([
                'naic'                    => $data['naic'] ?? null,
                'format_professional_id'  => $data['format_professional_id'] ?? null,
                'format_cms_id'           => $data['format_cms_id'] ?? null,
                'format_institutional_id' => $data['format_institutional_id'] ?? null,
                'format_ub_id'            => $data['format_ub_id'] ?? null,
                'file_method_id'          => $data['file_method_id'] ?? null,
                'insurance_plan_id'       => $insurancePlan->id,
                'billing_company_id'      => $billingCompany->id ?? $billingCompany,
            ]);

            if (isset($data['time_failed']['days']) || isset($data['time_failed']['from_id'])) {
                EntityTimeFailed::create([
                    'days'               => $data['time_failed']['days'],
                    'from_id'            => $data['time_failed']['from_id'],
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'time_failable_id'   => $insurancePlan->id,
                    'time_failable_type' => InsurancePlan::class
                ]);
            }

            if (isset($data['nickname'])) {
                EntityNickname::create([
                    'nickname'           => $data['nickname'],
                    'nicknamable_id'     => $insurancePlan->id,
                    'nicknamable_type'   => InsurancePlan::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ]);
            }

            if (isset($data['abbreviation'])) {
                EntityAbbreviation::create([
                    'abbreviation'       => $data['abbreviation'],
                    'abbreviable_id'     => $insurancePlan->id,
                    'abbreviable_type'   => InsurancePlan::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ]);
            }

            if (isset($data['address']['address'])) {
                $data['address']['billing_company_id'] = $billingCompany->id ?? $billingCompany;
                $data['address']['addressable_id']     = $insurancePlan->id;
                $data['address']['addressable_type']   = InsurancePlan::class;
                Address::create($data['address']);
            }
            if (isset($data['contact']['email'])) {
                $data['contact']['billing_company_id'] = $billingCompany->id ?? $billingCompany;
                $data['contact']['contactable_id']     = $insurancePlan->id;
                $data['contact']['contactable_type']   = InsurancePlan::class;
                Contact::create($data['contact']);
            }

            if (isset($data['private_note'])) {
                PrivateNote::create([
                    'publishable_type'   => InsurancePlan::class,
                    'publishable_id'     => $insurancePlan->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'note'               => $data['private_note']
                ]);
            }

            if (isset($data['public_note'])) {
                PublicNote::create([
                    'publishable_type' => InsurancePlan::class,
                    'publishable_id'   => $insurancePlan->id,
                    'note'             => $data['public_note']
                ]);
            }
            DB::commit();
            return $insurancePlan;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param array $data
     * @param int $id
     * @return InsurancePlan|Builder|Model|object|null
     */
    public function updateInsurancePlan(array $data, int $id) {

        try {
            DB::beginTransaction();
            $insurancePlan = InsurancePlan::whereId($id)->first();

            $insurancePlan->update([
                'name'                 => $data['name'],
                'payer_id'             => $data['payer_id'],
                'ins_type_id'          => $data['ins_type_id'],
                'plan_type_id'         => $data['plan_type_id'],
                'accept_assign'        => $data['accept_assign'],
                'pre_authorization'    => $data['pre_authorization'],
                'file_zero_changes'    => $data['file_zero_changes'],
                'referral_required'    => $data['referral_required'],
                'accrue_patient_resp'  => $data['accrue_patient_resp'],
                'require_abn'          => $data['require_abn'],
                'pqrs_eligible'        => $data['pqrs_eligible'],
                'allow_attached_files' => $data['allow_attached_files'],
                'eff_date'             => $data['eff_date'],
                'charge_using_id'      => $data['charge_using_id']
            ]);

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }
            
            InsurancePlanPrivate::updateOrCreate([
                'insurance_plan_id'  => $insurancePlan->id,
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ], [
                'naic'                    => $data['naic'] ?? null,
                'format_professional_id'  => $data['format_professional_id'] ?? null,
                'format_cms_id'           => $data['format_cms_id'] ?? null,
                'format_institutional_id' => $data['format_institutional_id'] ?? null,
                'format_ub_id'            => $data['format_ub_id'] ?? null,
                'file_method_id'          => $data['file_method_id'] ?? null,
                'insurance_plan_id'       => $insurancePlan->id,
                'billing_company_id'      => $billingCompany->id ?? $billingCompany,
            ]);

            /** Attach billing company */
            if (is_null($insurancePlan->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $insurancePlan->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
            } else {
                $insurancePlan->billingCompanies()->updateExistingPivot($billingCompany->id ?? $billingCompany, [
                    'status' => true,
                ]);
            }

            if (isset($data['time_failed']['days']) || isset($data['time_failed']['from_id'])) {
                EntityTimeFailed::updateOrCreate([
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'time_failable_id'   => $insurancePlan->id,
                    'time_failable_type' => InsurancePlan::class
                ], [
                    'days'               => $data['time_failed']['days'],
                    'from_id'            => $data['time_failed']['from_id'],
                ]);
            }

            if (isset($data['nickname'])) {
                EntityNickname::updateOrCreate([
                    'nicknamable_id'     => $insurancePlan->id,
                    'nicknamable_type'   => InsurancePlan::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'nickname'           => $data['nickname'],
                ]);
            }

            if (isset($data['abbreviation'])) {
                EntityAbbreviation::updateOrCreate([
                    'abbreviable_id'     => $insurancePlan->id,
                    'abbreviable_type'   => InsurancePlan::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'abbreviation'       => $data['abbreviation'],
                ]);
            }

            if (isset($data['address']['address'])) {
                Address::updateOrCreate([
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'addressable_id'     => $insurancePlan->id,
                    'addressable_type'   => InsurancePlan::class,
                ],
                $data['address']);
            }
            if (isset($data['contact']['email'])) {
                Contact::updateOrCreate([
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'contactable_id'     => $insurancePlan->id,
                    'contactable_type'   => InsurancePlan::class,
                ], $data['contact']);
            }

            if (isset($data['private_note'])) {
                PrivateNote::updateOrCreate([
                    'publishable_type'   => InsurancePlan::class,
                    'publishable_id'     => $insurancePlan->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'note'               => $data['private_note']
                ]);
            }

            if (isset($data['public_note'])) {
                PublicNote::updateOrCreate([
                    'publishable_type'   => InsurancePlan::class,
                    'publishable_id'     => $insurancePlan->id,
                ], [
                    'note'               => $data['public_note']
                ]);
            }

            DB::commit();
            return $this->getOneInsurancePlan($id);
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param  int $id
     * @return InsurancePlan|Builder|Model|object|null
     */
    public function addToBillingCompany(int $id) {
        $insurancePlan = InsurancePlan::find($id);
        if (is_null($insurancePlan)) return null;
        
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        if (is_null($insurancePlan->billingCompanies()->find($billingCompany->id))) {
            $insurancePlan->billingCompanies()->attach($billingCompany->id);
        }
        return $insurancePlan;
    }

    /**
     * @param int $id
     * @return InsurancePlan|Builder|Model|object|null
     */
    public function getOneInsurancePlan(int $id) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $insurance = InsurancePlan::whereId($id)->first();
        } else {
            $insurance = InsurancePlan::whereId($id)->with([
                'billingCompanies' => function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                }
            ])->first();
        }

        $copaysFields = $this->getCopays($id);
        $contractFeesFields = $this->getContractFees($id);

        $record = [
            'id' => $insurance->id,
            'code' => $insurance->code,
            'name' => $insurance->name,
            'payer_id' => $insurance->payer_id,
            'accept_assign' => $insurance->accept_assign,
            'pre_authorization' => $insurance->pre_authorization,
            'file_zero_changes' => $insurance->file_zero_changes,
            'referral_required' => $insurance->referral_required,
            'accrue_patient_resp' => $insurance->accrue_patient_resp,
            'require_abn' => $insurance->require_abn,
            'pqrs_eligible' => $insurance->pqrs_eligible,
            'allow_attached_files' => $insurance->allow_attached_files,
            'ins_type_id' => $insurance->ins_type_id ?? '',
            'ins_type' => isset($insurance->insType) ? ($insurance->insType->code . ' - ' . $insurance->insType->description) : '',
            'plan_type_id' => $insurance->plan_type_id ?? '',
            'plan_type'    => isset($insurance->planType) ? ($insurance->planType->code . ' - ' . $insurance->planType->description) : '',
            'insurance_company_id' => $insurance->insurance_company_id,
            'insurance_company' => $insurance->insuranceCompany->name,
            'created_at' => $insurance->created_at,
            'updated_at' => $insurance->updated_at,
            'last_modified' => $insurance->last_modified,
            'public_note' => isset($insurance->publicNote) ? $insurance->publicNote->note : '',
            'copays' => $copaysFields,
            'contract_fees' => $contractFeesFields,
        ];
        $record['billing_companies'] = [];

        foreach ($insurance->billingCompanies as $billingCompany) {
            $abbreviation = EntityAbbreviation::where([
                'abbreviable_id'     => $insurance->id,
                'abbreviable_type'   => InsurancePlan::class,
                'billing_company_id' => $billingCompany->id ?? $billingCompany
            ])->first();
            $nickname = EntityNickname::where([
                'nicknamable_id'     => $insurance->id,
                'nicknamable_type'   => InsurancePlan::class,
                'billing_company_id' => $billingCompany->id ?? $billingCompany
            ])->first();
            $address = Address::where([
                'addressable_id'     => $insurance->id,
                'addressable_type'   => InsurancePlan::class,
                'billing_company_id' => $billingCompany->id ?? $billingCompany
            ])->first();
            $contact = Contact::where([
                'contactable_id'     => $insurance->id,
                'contactable_type'   => InsurancePlan::class,
                'billing_company_id' => $billingCompany->id ?? $billingCompany
            ])->first();
            $time_failed = EntityTimeFailed::where([
                'time_failable_id'   => $insurance->id,
                'time_failable_type' => InsurancePlan::class,
                'billing_company_id' => $billingCompany->id ?? $billingCompany
            ])->first();
            $private_note = PrivateNote::where([
                'publishable_id'     => $insurance->id,
                'publishable_type'   => InsurancePlan::class,
                'billing_company_id' => $billingCompany->id ?? $billingCompany
            ])->first();
            $private_insurance_plan = InsurancePlanPrivate::where([
                'insurance_plan_id'  => $insurance->id,
                'billing_company_id' => $billingCompany->id ?? $billingCompany
            ])->first();

            if (isset($address)) {
                $insurance_address = [
                    'zip'                      => $address->zip,
                    'city'                     => $address->city,
                    'state'                    => $address->state,
                    'address'                  => $address->address,
                    'country'                  => $address->country,
                    'address_type_id'          => $address->address_type_id,
                ];
            };

            if (isset($contact)) {
                $insurance_contact = [
                    'fax'          => $contact->fax,
                    'email'        => $contact->email,
                    'phone'        => $contact->phone,
                    'mobile'       => $contact->mobile,
                    'contact_name' => $contact->contact_name,
                ];
            };
            if (isset($time_failed)) {
                $insurance_plan_time_failed = [
                    'days'    => $time_failed->days,
                    'from'    => $time_failed->from,
                    'from_id' => $time_failed->from_id,
                ];
            }
            array_push($record['billing_companies'], [
                'id'   => $billingCompany->id,
                'name' => $billingCompany->name,
                'code' => $billingCompany->code,
                'abbreviation' => $billingCompany->abbreviation,
                'private_insurance_plan' => [
                    'naic'    => isset($private_insurance_plan) ? $private_insurance_plan->naic : '',
                    'format_professional_id'    => isset($private_insurance_plan) ? $private_insurance_plan->format_professional_id : '',
                    'format_professional'       => isset($private_insurance_plan->formatProfessional) ? $private_insurance_plan->formatProfessional->code : '',

                    'format_institutional_id'    => isset($private_insurance_plan) ? $private_insurance_plan->format_institutional_id : '',
                    'format_institutional'       => isset($private_insurance_plan->formatInstitutional) ? $private_insurance_plan->formatInstitutional->code : '',

                    'format_cms_id'    => isset($private_insurance_plan) ? $private_insurance_plan->format_cms_id : '',
                    'format_cms'       => isset($private_insurance_plan->formatCMS) ? $private_insurance_plan->formatCMS->code : '',
                    

                    'format_ub_id'    => isset($private_insurance_plan) ? $private_insurance_plan->format_ub_id : '',
                    'format_ub'       => isset($private_insurance_plan->formatUB) ? $private_insurance_plan->formatUB->code : '',

                    'file_method_id'    => isset($private_insurance_plan) ? $private_insurance_plan->file_method_id : '',
                    'file_method'       => isset($private_insurance_plan->fileMethod) ? ($private_insurance_plan->fileMethod->code . ' - ' . $private_insurance_plan->fileMethod->description) : '',
                    'eff_date' => $insurance->eff_date,
                    'charge_using_id' => $insurance->charge_using_id ?? '',
                    'charge_using'    => isset($insurance->chargeUsing) ? ($insurance->chargeUsing->code . ' - ' . $insurance->chargeUsing->description) : '',
                    'status'       => $billingCompany->pivot->status ?? false,
                    'edit_name'    => isset($nickname->nickname) ? true : false,
                    'nickname'     => $nickname->nickname ?? '',
                    'abbreviation' => $abbreviation->abbreviation ?? '',
                    'private_note' => $private_note->note ?? '',
                    'address' => isset($insurance_address) ? $insurance_address : null,
                    'contact' => isset($insurance_contact) ? $insurance_contact : null,
                    'insurance_plan_time_failed' => isset($insurance_plan_time_failed) ? $insurance_plan_time_failed : null
                ]
            ]);
        }

        return !is_null($insurance) ? $record : null;
    }

    /**
     * @return InsurancePlan[]|Collection
     */
    public function getAllInsurancePlan() {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $insurance = InsurancePlan::with([
                'nicknames',
                'publicNotes',
                'insuranceCompany'
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        } else {
            $insurance = InsurancePlan::whereHas('billingCompanies', function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                })->with([
                    'nicknames' => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    'publicNotes',
                    'insuranceCompany'
            ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        }

        return !is_null($insurance) ? $insurance : null;
    }

    public function getServerAllInsurancePlan(Request $request) {
        $insuranceCompanyId = $request->insurance_company_id ?? '';

        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = InsurancePlan::with([
                'nicknames',
                'abbreviations',
                'insType',
                'planType',
                'insuranceCompany',
                'billingCompanies'
            ]);
        } else {
            $data = InsurancePlan::whereHas('billingCompanies', function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                })->with([
                    'nicknames' => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    'abbreviations' => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    'billingCompanies' => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    'insType',
                    'planType',
                    'insuranceCompany'
            ]);
        }
        if ($insuranceCompanyId) {
            $data = $data->whereInsuranceCompanyId($insuranceCompanyId);
        }

        if (!empty($request->query('query')) && $request->query('query')!=='{}') {
            $data = $data->search($request->query('query'));
        }
        
        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'billingcompany')) {
                $data = $data->orderBy(
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'insurance_companies.billing_company_id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } /**elseif (str_contains($request->sortBy, 'email')) {
                $data = $data->orderBy(
                    Contact::select('email')->whereColumn('contats.id', 'companies.billing_company_id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } */else {
                $data = $data->orderBy($request->sortBy, (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            }
        } else {
            $data = $data->orderBy('created_at', 'desc')->orderBy('id', 'asc');
        }

        $data = $data->paginate($request->itemsPerPage ?? 10);

        return response()->json([
            'data'          => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count'         => $data->total()
        ], 200);
    }

    public function changeStatus(bool $status,int $id) {
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        $insurancePlan = InsurancePlan::find($id);
        if (is_null($insurancePlan->billingCompanies()->find($billingCompany->id))) {
            $insurancePlan->billingCompanies()->attach($billingCompany->id);
            return $insurancePlan;
        } else {
            return $insurancePlan->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }

    public function getByName(string $name) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $insurance_plans = InsurancePlan::search($name)->with([
                'nicknames',
                'abbreviations',
                'insType',
                'planType',
                'insuranceCompany',
                'billingCompanies'
            ])->get();
        } else {
            $insurance_plans = InsurancePlan::search($name)->whereHas('billingCompanies', function ($query) use ($bC) {
                    $query->where('billing_company_id', $bC);
                })->with([
                    'nicknames' => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    'abbreviations' => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    'billingCompanies' => function ($query) use ($bC) {
                        $query->where('billing_company_id', $bC);
                    },
                    'insType',
                    'planType',
                    'insuranceCompany'
            ])->get();
        }
        $records = [];
        foreach ($insurance_plans as $insurance) {
            array_push(
                $records,
                [
                    'id' => $insurance->id,
                    'code' => $insurance->code,
                    'name' => $insurance->name,
                    'payer_id' => $insurance->payer_id,
                    'accept_assign' => $insurance->accept_assign,
                    'pre_authorization' => $insurance->pre_authorization,
                    'file_zero_changes' => $insurance->file_zero_changes,
                    'referral_required' => $insurance->referral_required,
                    'accrue_patient_resp' => $insurance->accrue_patient_resp,
                    'require_abn' => $insurance->require_abn,
                    'pqrs_eligible' => $insurance->pqrs_eligible,
                    'allow_attached_files' => $insurance->allow_attached_files,
                    'eff_date' => $insurance->eff_date,
                    'ins_type_id' => $insurance->ins_type_id ?? '',
                    'ins_type' => isset($insurance->insType) ? ($insurance->insType->code . ' - ' . $insurance->insType->description) : '',
                    'plan_type_id' => $insurance->plan_type_id ?? '',
                    'plan_type'    => isset($insurance->planType) ? ($insurance->planType->code . ' - ' . $insurance->planType->description) : '',
                    'charge_using_id' => $insurance->charge_using_id ?? '',
                    'charge_using'    => isset($insurance->chargeUsing) ? ($insurance->chargeUsing->code . ' - ' . $insurance->chargeUsing->description) : '',
                    'insurance_company_id' => $insurance->insurance_company_id,
                    'insurance_company' => $insurance->insuranceCompany->name,
                    'created_at' => $insurance->created_at,
                    'updated_at' => $insurance->updated_at,
                    'public_note' => isset($insurance->publicNote) ? $insurance->publicNote->note : ''
                ]
            );
        }
        return $records;
    }
    
    public function getByPayer(string $payer) {
        $insurance = InsurancePlan::wherePayerId($payer)->first();

        if ($insurance) {
            $record = [
                'id' => $insurance->id,
                'code' => $insurance->code,
                'name' => $insurance->name,
                'payer_id' => $insurance->payer_id,
                'accept_assign' => $insurance->accept_assign,
                'pre_authorization' => $insurance->pre_authorization,
                'file_zero_changes' => $insurance->file_zero_changes,
                'referral_required' => $insurance->referral_required,
                'accrue_patient_resp' => $insurance->accrue_patient_resp,
                'require_abn' => $insurance->require_abn,
                'pqrs_eligible' => $insurance->pqrs_eligible,
                'allow_attached_files' => $insurance->allow_attached_files,
                'ins_type_id' => $insurance->ins_type_id ?? '',
                'ins_type' => isset($insurance->insType) ? ($insurance->insType->code . ' - ' . $insurance->insType->description) : '',
                'plan_type_id' => $insurance->plan_type_id ?? '',
                'plan_type'    => isset($insurance->planType) ? ($insurance->planType->code . ' - ' . $insurance->planType->description) : '',
                'insurance_company_id' => $insurance->insurance_company_id,
                'insurance_company' => $insurance->insuranceCompany->name,
                'created_at' => $insurance->created_at,
                'updated_at' => $insurance->updated_at,
                'last_modified' => $insurance->last_modified,
                'public_note' => isset($insurance->publicNote) ? $insurance->publicNote->note : '',
                'copays' => [],
                'contract_fees' => [],
            ];
        }
        return !is_null($insurance) ? $record : null;
    }

    public function getByCompany(string $nameCompany) {
        return InsurancePlan::whereHas('insuranceCompany', function(Builder $query) use ($nameCompany) {
            $query->where('name','ILIKE','%${nameCompany}%');
        })->get();
    }

    public function getAllPlanByInsurancePlan(int $id){
        return InsurancePlan::whereInsuranceCompanyId($id)->get();
    }

    public function getList() {
        return getList(InsurancePlan::class);
    }

    public function getListByCompany($id) {
        return getList(InsurancePlan::class, ['name'], ['insurance_company_id' => $id]);
    }

    public function getListFormats() {
        try {
            return getList(TypeCatalog::class, ['code'], ['relationship' => 'type', 'where' => ['description' => 'Insurance plan formats']]);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListInsTypes() {
        try {
            return getList(TypeCatalog::class, ['code','-', 'description'], ['relationship' => 'type', 'where' => ['description' => 'Ins type']]);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListPlanTypes() {
        try {
            return getList(TypeCatalog::class, ['code', '-', 'description'], ['relationship' => 'type', 'where' => ['description' => 'Insurance plan type']]);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListChargeUsings() {
        try {
            return [];
            return getList(TypeCatalog::class, ['code'], ['relationship' => 'type', 'where' => ['description' => 'Charge using']]);
        } catch (\Exception $e) {
            return [];
        }
    }

    /** @todo Cambiar relacion entre copays y company muchos a muchos */
    public function addCopays(array $data, int $id) {
        try {
            DB::beginTransaction();
            $insurancePlan = InsurancePlan::find($id);
            $records = [];
            if (is_null($insurancePlan)) return null;
            
            $billingCompany = auth()->user()->billingCompanies->first();
            if (!auth()->user()->hasRole('superuser')) {
                if (is_null($billingCompany)) return null;
            }

            if (isset($data['copays'])) {
                if (auth()->user()->hasRole('superuser')) {
                    $copays = $insurancePlan->copays;
                } else {
                    $copays = $insurancePlan->copays()->where('billing_company_id', $billingCompany->id)->get();
                }
                
                /** Delete Copays */
                foreach ($copays ?? [] as $copayDB) {
                    $validated = false;
                    foreach ($data['copays'] as $copay) {
                        if (($copayDB['copay'] == $copay['copay']) && ($copayDB['company_id'] == $copay['company_id'])) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) {
                        $copayDB->procedures()->detach();
                        $copayDB->delete();
                    }
                }

                /** update or create new copay */
                foreach ($data['copays'] as $copay) {
                    $copayDB = Copay::firstOrCreate([
                        'copay'              => $copay['copay'],
                        'company_id'         => $copay['company_id'] ?? null,
                        'insurance_plan_id'  => $insurancePlan->id,
                        'billing_company_id' => $billingCompany->id ?? $copay['billing_company_id'],
                    ]);
                    if (isset($copay['private_note'])) {
                        PrivateNote::updateOrCreate([
                            'publishable_type'   => Copay::class,
                            'publishable_id'     => $copayDB['id'],
                            'billing_company_id' => $billingCompany->id ?? $copay['billing_company_id'],
                        ], [
                            'note'               => $copay['private_note']
                        ]);
                    }
                    $copayDB->procedures()->sync($copay['procedure_ids']);
                }
            }

            /** Get data response */
            if (auth()->user()->hasRole('superuser')) {
                $insurancePlanCopays = $insurancePlan->copays;
            } else {
                $insurancePlanCopays = $insurancePlan->copays()->where('billing_company_id', $billingCompany->id)->get();
            }

            foreach ($insurancePlanCopays ?? [] as $insurancePlanCopay) {
                $procedure_ids = [];
                foreach ($insurancePlanCopay->procedures ?? [] as $procedure) {
                    array_push($procedure_ids, $procedure->id);
                };
                $private_note = PrivateNote::where([
                    'publishable_id'     => $insurancePlanCopay->id,
                    'publishable_type'   => Copay::class,
                    'billing_company_id' => $insurancePlanCopay->billing_company_id
                ])->first();

                array_push($records, [
                    'billing_company_id' => $insurancePlanCopay->billing_company_id ?? null,
                    'company_id'         => $insurancePlanCopay->company_id ?? null,
                    'procedure_ids'      => $procedure_ids,
                    'copay'              => (float)$insurancePlanCopay->copay ?? null,
                    'private_note'       => $private_note->note ?? '',
                ]);
            }
            DB::commit();
            return $records;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    public function addContractFees(array $data, int $id) {
        try {
            DB::beginTransaction();
            $insurancePlan = InsurancePlan::find($id);
            $records = [];
            if (is_null($insurancePlan)) return null;
            
            $billingCompany = auth()->user()->billingCompanies->first();
            if (!auth()->user()->hasRole('superuser')) {
                if (is_null($billingCompany)) return null;
            }

            if (isset($data['contract_fees'])) {
                $type_id = TypeCatalog::query()
                    ->where(['code' => 'CAP', 'description' => 'CAP'])
                    ->whereHas('type', function ($query) {
                        $query->where('description', 'Contract fee type');
                    })->value('id');

                $excludedIds = array_reduce($data['contract_fees'], function ($ids, $item) {
                    if (isset($item['id'])) {
                        $ids[] = $item['id'];
                    }
                    return $ids;
                }, []);
                if (auth()->user()->hasRole('superuser')) {
                    $contractFeesDelete = $insurancePlan
                        ->contractFees()
                        ->whereNotIn('id', $excludedIds);
                } else {
                    $contractFeesDelete = $insurancePlan
                        ->contractFees()
                        ->where('billing_company_id', $billingCompany->id)
                        ->whereNotIn('id', $excludedIds);
                }
                
                /** Delete contract fees */
                $contractFeesDelete->chunk(20, function ($contracts) {
                    foreach ($contracts as $contract) {
                        $contract->procedures()->detach();
                        $contract->patiens()->detach();
                    }
                    $contracts->each->delete();
                });


                /** update or create new contract fee */
                foreach ($data['contract_fees'] as $contract) {
                    $macLocality = MacLocality::where([
                        'mac' => $contract['mac'] ?? null,
                        'locality_number' => $contract['locality_number'] ?? null,
                        'state' => $contract['state'] ?? null,
                        'fsa' => $contract['fsa'] ?? null,
                        'counties' => $contract['counties'] ?? null,
                    ])->first();

                    $contractFee = ContractFee::updateOrCreate([
                        'id' => $contract['id'] ?? null,
                    ], [
                        'company_id' => $contract['company_id'],
                        'insurance_plan_id' => $insurancePlan->id,
                        'insurance_company_id' => $insurancePlan->insurance_company_id,
                        'private_note' => $contract['private_note'],
                        'billing_company_id' => $billingCompany->id ?? $contract['billing_company_id'],
                        'modifier_id' => $contract['modifier_id'] ?? null,
                        'mac_locality_id' => $macLocality->id ?? null,
                        'insurance_label_fee_id' => $contract['insurance_label_fee_id'] ?? null,
                        'contract_fee_type_id' => $contract['type_id'] ?? null,
                        'start_date' => $contract['start_date'] ?? null,
                        'end_date' => $contract['end_date'] ?? null,
                        'price' => $contract['price'] ?? null,
                        'price_percentage' => $contract['price_percentage'] ?? null,
                    ]);
                    $contractFee->procedures()->sync($contract['procedure_ids']);

                    if (($type_id === $contract['type_id']) &&
                        isset($contract['patients'])  &&
                        !empty(filter_array_empty($contract['patients']))) {
                        
                        $excludedPatients = array_reduce($contract['patients'], function ($ids, $item) {
                            if (isset($item['patient_id'])) {
                                $ids[] = $item['patient_id'];
                            }
                            return $ids;
                        }, []);
                        $patientsDelete = $contractFee
                            ->patiens()
                            ->whereNotIn('patients.id', $excludedPatients)
                            ->select('patients.id')
                            ->get()
                            ->pluck('id');

                        /** Delete contract fees patients */
                        foreach ($patientsDelete ?? [] as $id) {    
                            $contractFee->patiens()->detach($id);
                        }
                        
                        foreach ($contract['patients'] as $item) {
                            /** Attach patient if exist */
                            if (is_null($contractFee->patiens()->find($item['patient_id']))) {
                                $contractFee->patiens()->attach($item['patient_id'], [
                                    'start_date' => $item['start_date'],
                                    'end_date' => $item['end_date'],
                                ]);
                            } else {
                                $contractFee->patiens()->updateExistingPivot($item['patient_id'], [
                                    'start_date' => $item['start_date'],
                                    'end_date' => $item['end_date'],
                                ]);
                            }
                        }
                    }
                }
            }

            /** Get data response */
            if (auth()->user()->hasRole('superuser')) {
                $insurancePlanContracts = $insurancePlan->contractFees;
            } else {
                $insurancePlanContracts = $insurancePlan
                    ->contractFees()
                    ->where('billing_company_id', $billingCompany->id)
                    ->get();
            }

            foreach ($insurancePlanContracts ?? [] as $insurancePlanContract) {
                $procedure_ids = $insurancePlanContract
                    ->procedures()
                    ->select('procedures.id')
                    ->get()
                    ->pluck('id');
                $patients = $insurancePlanContract
                    ->patiens()
                    ->get()
                    ->map(function ($patient) {
                        return [
                            'patient_id' => $patient->id,
                            'start_date' => $patient->pivot->start_date,
                            'end_date' => $patient->pivot->end_date,
                        ];
                    })->toArray();

                $macLocality = MacLocality::find($insurancePlanContract->mac_locality_id ?? null)?->first();

                array_push($records, [
                    'id' => $insurancePlanContract->id,
                    'price' => (float) $insurancePlanContract->price ?? null,
                    'company_id' => $insurancePlanContract->company_id ?? '',
                    'private_note' => $insurancePlanContract->private_note ?? '',
                    'billing_company_id' => $insurancePlanContract->billing_company_id ?? '',
                    'modifier_id' => $insurancePlanContract->modifier_id ?? '',
                    'insurance_label_fee_id' => $insurancePlanContract->insurance_label_fee_id ?? '',
                    'type_id' => $insurancePlanContract->contract_fee_type_id ?? '',
                    'start_date' => $insurancePlanContract->start_date ?? '',
                    'end_date' => $insurancePlanContract->end_date ?? '',
                    'price_percentage' => $insurancePlanContract->price_percentage ?? '',
                    'procedure_ids' => $procedure_ids,
                    'mac' => $macLocality['mac'] ?? '',
                    'locality_number' => $macLocality['locality_number'] ?? '',
                    'state' => $macLocality['state'] ?? '',
                    'fsa' => $macLocality['fsa'] ?? '',
                    'counties' => $macLocality['counties'] ?? '',
                    'patients' => $patients
                ]);
            }
            DB::commit();
            return $records;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    public function getCopays(int $id) {
        $insurancePlan = InsurancePlan::find($id);
        $records = [];
        $billingCompany = auth()->user()->billingCompanies->first();
        if (!auth()->user()->hasRole('superuser')) {
            if (is_null($billingCompany)) return null;
        }
        if (auth()->user()->hasRole('superuser')) {
            $insurancePlanCopays = $insurancePlan->copays;
        } else {
            $insurancePlanCopays = $insurancePlan->copays()->where('billing_company_id', $billingCompany->id)->get();
        }

        foreach ($insurancePlanCopays ?? [] as $insurancePlanCopay) {
            $procedure_ids = [];
            foreach ($insurancePlanCopay->procedures ?? [] as $procedure) {
                array_push($procedure_ids, $procedure->id);
            };
            $private_note = PrivateNote::where([
                'publishable_id'     => $insurancePlanCopay->id,
                'publishable_type'   => Copay::class,
                'billing_company_id' => $insurancePlanCopay->billing_company_id
            ])->first();

            array_push($records, [
                'billing_company_id' => $insurancePlanCopay->billing_company_id ?? null,
                'company_id'         => $insurancePlanCopay->company_id ?? null,
                'procedure_ids'      => $procedure_ids,
                'copay'              => (float)$insurancePlanCopay->copay ?? null,
                'private_note'       => $private_note->note ?? '',
            ]);
        }
        return $records;
    }

    public function getContractFees(int $id) {
        $insurancePlan = InsurancePlan::find($id);
        $records = [];
        $billingCompany = auth()->user()->billingCompanies->first();
        if (!auth()->user()->hasRole('superuser')) {
            if (is_null($billingCompany)) return null;
        }
        if (auth()->user()->hasRole('superuser')) {
            $insurancePlanContracts = $insurancePlan->contractFees;
        } else {
            $insurancePlanContracts = $insurancePlan
                ->contractFees()
                ->where('billing_company_id', $billingCompany->id)
                ->get();
        }

        foreach ($insurancePlanContracts ?? [] as $insurancePlanContract) {
            $procedure_ids = $insurancePlanContract
                ->procedures()
                ->select('procedures.id')
                ->get()
                ->pluck('id');
            $patients = $insurancePlanContract
                ->patiens()
                ->get()
                ->map(function ($patient) {
                    return [
                        'patient_id' => $patient->id,
                        'start_date' => $patient->pivot->start_date,
                        'end_date' => $patient->pivot->end_date,
                    ];
                })->toArray();

            $macLocality = MacLocality::find($insurancePlanContract->mac_locality_id ?? null)?->first();

            array_push($records, [
                'id' => $insurancePlanContract->id,
                'price' => (float) $insurancePlanContract->price ?? null,
                'company_id' => $insurancePlanContract->company_id ?? '',
                'private_note' => $insurancePlanContract->private_note ?? '',
                'billing_company_id' => $insurancePlanContract->billing_company_id ?? '',
                'modifier_id' => $insurancePlanContract->modifier_id ?? '',
                'insurance_label_fee_id' => $insurancePlanContract->insurance_label_fee_id ?? '',
                'type_id' => $insurancePlanContract->contract_fee_type_id ?? '',
                'start_date' => $insurancePlanContract->start_date ?? '',
                'end_date' => $insurancePlanContract->end_date ?? '',
                'price_percentage' => $insurancePlanContract->price_percentage ?? '',
                'procedure_ids' => $procedure_ids,
                'mac' => $macLocality['mac'] ?? '',
                'locality_number' => $macLocality['locality_number'] ?? '',
                'state' => $macLocality['state'] ?? '',
                'fsa' => $macLocality['fsa'] ?? '',
                'counties' => $macLocality['counties'] ?? '',
                'patients' => $patients
            ]);
        }
        return $records;
    }
}

<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\InsuranceLabelFee;
use App\Models\InsuranceCompany;
use App\Models\InsurancePlan;
use App\Models\InsuranceType;
use App\Models\MacLocality;
use App\Models\PublicNote;
use App\Models\ProcedureConsideration;
use App\Models\ProcedureFee;
use App\Models\Procedure;
use App\Models\Gender;
use App\Models\Discriminatory;
use App\Models\Diagnosis;
use App\Models\Modifier;
use App\Models\Company;

class ProcedureRepository
{
    /**
     * @param array $data
     * @return Procedure|Model
     */
    public function createProcedure(array $data) {
        try {
            DB::beginTransaction();
            $procedure = Procedure::create([
                "code"        => $data['code'],
                "start_date"  => $data["start_date"],
                "description" => $data['description']
            ]);
            
            if (isset($data['specific_insurance_company']) && isset($data['insurance_companies'])) {
                if ($data['specific_insurance_company']) {
                    $procedure->insuranceCompanies()->sync($data['insurance_companies']);
                }
            }

            if (isset($data['mac_localities'])) {
                foreach ($data['mac_localities'] as $macL) {
                    $macLocality = MacLocality::where([
                        "mac"             => $macL['mac'],
                        "locality_number" => $macL['locality_number'],
                        "state"           => $macL['state'],
                        "fsa"             => $macL['fsa'],
                        "counties"        => $macL['counties']
                    ])->first();
                    if (isset($macLocality)) {
                        /** Attach macLocality to procedure */
                        $procedure->macLocalities()->attach($macLocality->id, ['modifier_id' => $macL['modifier_id'] ?? null]);
                    }
                    foreach ($macL['procedure_fees'] as $procedureFees => $value) {
                        if (isset($value)) {
                            /** insuranceType == Medicare */
                            $insuranceLabelFeesMedicare = InsuranceLabelFee::whereHas('insuranceType', function ($query) {
                                $query->whereDescription('Medicare');
                            })->get();

                            foreach ($insuranceLabelFeesMedicare as $insuranceLabelFeeMedicare) {
                                $field = str_replace(" ", "_", strtolower($insuranceLabelFeeMedicare->description));
                                if ($procedureFees == $field) {
                                    ProcedureFee::updateOrCreate([
                                        'insurance_label_fee_id' => $insuranceLabelFeeMedicare->id,
                                        'procedure_id'           => $procedure->id,
                                        'mac_locality_id'        => $macLocality->id
                                    ], [
                                        'fee'                    => $value
                                    ]);
                                }
                            }

                            /** insuranceType == Medicaid */
                            $insuranceLabelFeesMedicaid = InsuranceLabelFee::whereHas('insuranceType', function ($query) {
                                $query->whereDescription('Medicaid');
                            })->get();

                            foreach ($insuranceLabelFeesMedicaid as $insuranceLabelFeeMedicaid) {
                                $field = str_replace(" ", "_", strtolower($insuranceLabelFeeMedicaid->description));
                                if ($procedureFees == $field) {
                                    ProcedureFee::updateOrCreate([
                                        'insurance_label_fee_id' => $insuranceLabelFeeMedicaid->id,
                                        'procedure_id'           => $procedure->id,
                                        'mac_locality_id'        => $macLocality->id
                                    ], [
                                        'fee'                    => $value
                                    ]);
                                }
                            }
                        }
                    }
                }
            }

            if (isset($data['procedure_considerations'])) {
                if (isset($data['procedure_considerations']['gender_id']) &&
                    isset($data['procedure_considerations']['age_init']) &&
                    isset($data['procedure_considerations']['discriminatory_id'])) {
                    ProcedureConsideration::create([
                        'procedure_id'      => $procedure->id,
                        'gender_id'         => $data['procedure_considerations']['gender_id'],
                        'age_init'          => $data['procedure_considerations']['age_init'],
                        'age_end'           => $data['procedure_considerations']['age_end'] ?? null,
                        'discriminatory_id' => $data['procedure_considerations']['discriminatory_id']
                    ]);
                }
            }

            if (isset($data['modifiers'])) {
                $procedure->modifiers()->sync($data['modifiers']);
            }

            if (isset($data['diagnoses'])) {
                $procedure->diagnoses()->sync($data['diagnoses']);
            }

            if (isset($data['note'])) {
                PublicNote::create([
                    'publishable_type' => Procedure::class,
                    'publishable_id'   => $procedure->id,
                    'note'             => $data['note'],
                ]);
            }

            DB::commit();
            return $procedure;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @return Procedure[]|Collection
     */
    public function getAllProcedures() {
        $procedures = Procedure::with([
            "publicNote",
        ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        
        return is_null($procedures) ? null : $procedures;
    }

    public function getServerAllProcedures(Request $request) {
        $data = Procedure::with([
            "publicNote"
        ]);
        
        if (!empty($request->query('query')) && $request->query('query')!=="{}") {
            $data = $data->search($request->query('query'));
        }
        
        if ($request->sortBy) {
            $data = $data->orderBy($request->sortBy, (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
        } else {
            $data = $data->orderBy("created_at", "desc")->orderBy("id", "asc");
        }

        $data = $data->paginate($request->itemsPerPage ?? 10);

        return response()->json([
            'data'          => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count'         => $data->total()
        ], 200);
    }

    /**
     * @param int $id
     * @return Procedure|Builder|Model|object|null
     */
    public function getOneProcedure(int $id) {
        $procedure = Procedure::whereId($id)->with([
            "publicNote",
            "procedureCosiderations",
            "insuranceCompanies",
            "diagnoses",
            "modifiers",
            "macLocalities" => function ($query) use ($id) {
                $query->with(['procedureFees' => function ($q) use ($id) {
                    $q->where('procedure_id', $id)->with('insuranceLabelFee');
                }]);
            }
        ])->first();

        return !is_null($procedure) ? $procedure : null;
    }

    /**
     * @param int $id
     * @return Procedure|Builder|Model|object|null
     */
    public function getPriceOfProcedure(Request $request) {
        if (isset($request->procedure_id)) {
            $id = $request->procedure_id;
            $filters = [];
            
            if (isset($request->mac)) {
                $filters['mac'] = $request->mac;
            }
            if (isset($request->locality_number)) {
                $filters['locality_number'] = $request->locality_number;
            }
            if (isset($request->state)) {
                $filters['state'] = $request->state;
            }
            if (isset($request->fsa)) {
                $filters['fsa'] = $request->fsa;
            }
            if (isset($request->counties)) {
                $filters['counties'] = $request->counties;
            }
            if (isset($request->insurance_label_fee_id)) {
                $label_fee = InsuranceLabelFee::find($request->insurance_label_fee_id);
            }
            $procedure = Procedure::whereId($id)->with([
                "macLocalities" => function ($query) use ($id, $filters) {
                    $query->where($filters)->with(['procedureFees' => function ($q) use ($id) {
                        $q->where('procedure_id', $id)->with('insuranceLabelFee');
                    }]);
                }
            ])->first();
            if (isset($procedure->macLocalities)) {
                $macLocality = $procedure->macLocalities->first();
                $labelFee = $macLocality->procedureFees()->where('insurance_label_fee_id', $label_fee->id)->first();
                return [
                    "fee" => $labelFee->fee ?? '',
                    "insurance_label_fee_id" => $labelFee->insurance_label_fee_id ?? null,
                    "insurance_label_fee" => $labelFee->insuranceLabelFee->description ?? '',
                    "created_at" => $labelFee->created_at ?? null,
                    "updated_at" => $labelFee->updated_at ?? null,
                ];
            }
        }

        return null;
    }

    /**
     * @param string $code
     * @return Procedure|Builder|Model|object|null
     */
    public function getByCode(string $code) {
        $proID = Procedure::whereCode($code)->first();
        $id = $proID->id ?? null;
        $procedure = Procedure::whereId($id)->with([
            "publicNote",
            "procedureCosiderations",
            "insuranceCompanies",
            "diagnoses",
            "modifiers",
            "macLocalities" => function ($query) use ($id) {
                $query->with(['procedureFees' => function ($q) use ($id) {
                    $q->where('procedure_id', $id)->with('insuranceLabelFee');
                }]);
            }
        ])->first();

        return !is_null($procedure) ? $procedure : null;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Procedure|Builder|Model|object|null
     */
    public function updateProcedure(array $data, int $id) {
        try {
            DB::beginTransaction();
            $procedure = Procedure::find($id);

            $procedure->update([
                "start_date"  => $data["start_date"],
                "end_date"  => $data["end_date"] ?? null,
                "description" => $data['description']
            ]);

            if (isset($data['specific_insurance_company']) && isset($data['insurance_companies'])) {
                if ($data['specific_insurance_company']) {
                    $procedure->insuranceCompanies()->sync($data['insurance_companies']);
                }
            }

            if (isset($data['mac_localities'])) {
                /** Delete mac localities */
                $procedure->macLocalities()->detach();
                /** update or create new mac localities */
                foreach ($data['mac_localities'] as $macL) {
                    $macLocality = MacLocality::where([
                        "mac"             => $macL['mac'],
                        "locality_number" => $macL['locality_number'],
                        "state"           => $macL['state'],
                        "fsa"             => $macL['fsa'],
                        "counties"        => $macL['counties']
                    ])->first();
                    if (isset($macLocality)) {
                        /** Attach macLocality to procedure */
                        $procedure->macLocalities()->attach($macLocality->id, ['modifier_id' => $macL['modifier_id'] ?? null]);
                    }
                    foreach ($macL['procedure_fees'] as $procedureFees => $value) {
                        if (isset($value)) {
                            /** insuranceType == Medicare */
                            $insuranceLabelFeesMedicare = InsuranceLabelFee::whereHas('insuranceType', function ($query) {
                                $query->whereDescription('Medicare');
                            })->get();

                            foreach ($insuranceLabelFeesMedicare as $insuranceLabelFeeMedicare) {
                                $field = str_replace(" ", "_", strtolower($insuranceLabelFeeMedicare->description));
                                if ($procedureFees == $field) {
                                    ProcedureFee::updateOrCreate([
                                        'insurance_label_fee_id' => $insuranceLabelFeeMedicare->id,
                                        'procedure_id'           => $procedure->id,
                                        'mac_locality_id'        => $macLocality->id
                                    ], [
                                        'fee'                    => $value
                                    ]);
                                }
                            }

                            /** insuranceType == Medicaid */
                            $insuranceLabelFeesMedicaid = InsuranceLabelFee::whereHas('insuranceType', function ($query) {
                                $query->whereDescription('Medicaid');
                            })->get();

                            foreach ($insuranceLabelFeesMedicaid as $insuranceLabelFeeMedicaid) {
                                $field = str_replace(" ", "_", strtolower($insuranceLabelFeeMedicaid->description));
                                if ($procedureFees == $field) {
                                    ProcedureFee::updateOrCreate([
                                        'insurance_label_fee_id' => $insuranceLabelFeeMedicaid->id,
                                        'procedure_id'           => $procedure->id,
                                        'mac_locality_id'        => $macLocality->id
                                    ], [
                                        'fee'                    => $value
                                    ]);
                                }
                            }
                        }
                    }
                }
            }

            if (isset($data['procedure_considerations'])) {
                if (isset($data['procedure_considerations']['gender_id']) &&
                    isset($data['procedure_considerations']['age_init']) &&
                    isset($data['procedure_considerations']['discriminatory_id'])) {
                    ProcedureConsideration::updateOrCreate([
                        'procedure_id'      => $procedure->id,
                    ], [
                        'gender_id'         => $data['procedure_considerations']['gender_id'],
                        'age_init'          => $data['procedure_considerations']['age_init'],
                        'age_end'           => $data['procedure_considerations']['age_end'] ?? null,
                        'discriminatory_id' => $data['procedure_considerations']['discriminatory_id']
                    ]);
                };
            }

            if (isset($data['modifiers'])) {
                $procedure->modifiers()->sync($data['modifiers']);
            }

            if (isset($data['diagnoses'])) {
                $procedure->diagnoses()->sync($data['diagnoses']);
            }

            if (isset($data['note'])) {
                /** PublicNote */
                PublicNote::updateOrCreate([
                    'publishable_type' => Procedure::class,
                    'publishable_id'   => $procedure->id,
                ], [
                    'note'             => $data['note'],
                ]);
            }

            DB::commit();
            return Procedure::whereId($id)->first();
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param bool $status
     * @param int $id
     * @return bool|int|null
     */
    public function changeStatus(bool $status, int $id) {
        $procedure = Procedure::find($id);

        if (is_null($procedure)) return null;

        if ($status) {
            return $procedure->update(
                [
                    "active"   => $status,
                    "end_date" => null
                ]
            );
        } else {
            return $procedure->update(
                [
                    "active"   => $status,
                    "end_date" => now()
                ]
            );
        }
    }

    public function getListMacLocalities(Request $request) {
        try {
            $filters = [];
            if (isset($request->mac)) {
                $filters['mac'] = $request->mac;
            }
            if (isset($request->locality_number)) {
                $filters['locality_number'] = $request->locality_number;
            }
            if (isset($request->state)) {
                $filters['state'] = $request->state;
            }
            if (isset($request->fsa)) {
                $filters['fsa'] = $request->fsa;
            }
            if (isset($request->counties)) {
                $filters['counties'] = $request->counties;
            }
            $records['mac'] = MacLocality::where($filters)->distinct('mac')->get();
            $records['locality_number'] = MacLocality::where($filters)->distinct('locality_number')->get();
            $records['state'] = MacLocality::where($filters)->distinct('state')->get();
            $records['fsa'] = MacLocality::where($filters)->distinct('fsa')->get();
            $records['counties'] = MacLocality::where($filters)->distinct('counties')->get();
            
            $options = [
                'mac'             => [],
                'locality_number' => [],
                'state'           => [],
                'fsa'             => [],
                'counties'        => []

            ];
            foreach ($records['mac'] as $rec) {
                array_push($options['mac'], ['id' => $rec->mac, 'name' => $rec->mac]);
            }
            foreach ($records['locality_number'] as $rec) {
                array_push($options['locality_number'], ['id' => $rec->locality_number, 'name' => $rec->locality_number]);
            }
            foreach ($records['state'] as $rec) {
                array_push($options['state'], ['id' => $rec->state, 'name' => $rec->state]);
            }
            foreach ($records['fsa'] as $rec) {
                array_push($options['fsa'], ['id' => $rec->fsa, 'name' => $rec->fsa]);
            }
            foreach ($records['counties'] as $rec) {
                array_push($options['counties'], ['id' => $rec->counties, 'name' => $rec->counties]);
            }

            return $options;
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListMac() {
        try {
            return getList(MacLocality::class, ['mac']);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListLocalityNumber() {
        try {
            return getList(MacLocality::class, ['locality_number']);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListState() {
        try {
            return getList(MacLocality::class, ['state']);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListFsa() {
        try {
            return getList(MacLocality::class, ['fsa']);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListCounties() {
        try {
            return getList(MacLocality::class, ['counties']);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListGenders() {
        return getList(Gender::class, 'description');
    }

    public function getListDiscriminatories() {
        return getList(Discriminatory::class, 'description');
    }

    public function getListDiagnoses($code = '', $except_ids = null) {
        try {
            if ($code == '') {
                return getList(Diagnosis::class, 'code', [], null, ['description']);
            } else {
                return getList(Diagnosis::class, 'code', ['whereRaw' => ['search' => $code]], $except_ids, ['description']);
            }
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListModifiers($code = '') {
        try {
            if ($code == '') {
                return getList(Modifier::class, 'modifier');
            } else {
                return getList(Modifier::class, 'modifier', ['whereRaw' => ['search' => $code]]);
            }
            
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListInsuranceCompanies($procedure_id = null) {
        try {
            if ($procedure_id == null) {
                return [];
            } else {
                $procedure = Procedure::whereId($procedure_id)->with([
                    "insuranceCompanies",
                ])->first();
                if (count($procedure->insuranceCompanies) > 0) {
                    return getList(
                        InsuranceCompany::class,
                        'name',
                        ['relationship' => 'procedures', 'where' => ['procedure_id' => $procedure_id]]
                    );
                } else {
                    return getList(InsuranceCompany::class);
                }
            }
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getList($company_id = null, $search = '', $except_ids = null) {
        try {
            if ($company_id == null) {
                if ($search == '') {
                    return getList(Procedure::class, 'code', [], null, ['description']);
                } else {
                    return getList(Procedure::class, 'code', ['whereRaw' => ['search' => $search]], $except_ids, ['description']);
                }
            } else {
                if ($search == '') {
                    return getList(
                        Procedure::class,
                        'code',
                        ['relationship' => 'companies', 'where' => ['company_id' => $company_id]],
                        null,
                        ['description'],
                        ['price']
                    );
                } else {
                    return getList(
                        Procedure::class,
                        'code',
                        [
                            'whereRaw' => ['search' => $search],
                            'relationship' => 'companies',
                            'where' => ['company_id' => $company_id]
                        ],
                        $except_ids,
                        ['description'],
                        ['price']
                    );
                }
            }
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListInsuranceLabelFees() {
        try {
            return getList(InsuranceLabelFee::class, 'description');
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @param array $data
     * @param int $id
     * @return Procedure|Builder|Model|object|null
     */
    public function addToCompany(array $data, int $id) {
        try {
            DB::beginTransaction();
            $company = Company::find($id);
            
            $procedures = Procedure::whereHas('companies', function ($query) use ($company) {
                $query->where('company_id', $company->id);
            })->with(['companies', 'macLocalities'])->get();

            foreach ($procedures as $procedure) {
                $procedure->macLocalities()->detach();
            }
            $company->procedures()->detach();

            if (isset($data['mac_localities'])) {
                foreach ($data['mac_localities'] as $macL) {
                    $procedure = Procedure::find($macL['procedure_id']);

                    $macLocality = MacLocality::where([
                        "mac"             => $macL['mac'],
                        "locality_number" => $macL['locality_number'],
                        "state"           => $macL['state'],
                        "fsa"             => $macL['fsa'],
                        "counties"        => $macL['counties']
                    ])->first();
                    if (isset($macLocality)) {
                        if (is_null($macLocality->procedures()->wherePivot('modifier_id', $macL['modifier_id'])->find($procedure->id))) {
                            $macLocality->procedures()->attach($procedure->id, ['modifier_id'  => $macL['modifier_id']]);
                        }
                    }

                    if (isset($macL['procedure_fees'])) {
                        foreach ($macL['procedure_fees'] as $procedureFees => $value) {
                            if (isset($value)) {
                                /** insuranceType == Medicare */
                                $insuranceLabelFeesMedicare = InsuranceLabelFee::whereHas('insuranceType', function ($query) {
                                    $query->whereDescription('Medicare');
                                })->get();

                                foreach ($insuranceLabelFeesMedicare as $insuranceLabelFeeMedicare) {
                                    $field = str_replace(" ", "_", strtolower($insuranceLabelFeeMedicare->description));
                                    if ($procedureFees == $field) {
                                        ProcedureFee::updateOrCreate([
                                            'insurance_label_fee_id' => $insuranceLabelFeeMedicare->id,
                                            'procedure_id'           => $procedure->id,
                                            'mac_locality_id'        => $macLocality->id
                                        ], [
                                            'fee'                    => $value
                                        ]);
                                    }
                                }

                                /** insuranceType == Medicaid */
                                $insuranceLabelFeesMedicaid = InsuranceLabelFee::whereHas('insuranceType', function ($query) {
                                    $query->whereDescription('Medicaid');
                                })->get();

                                foreach ($insuranceLabelFeesMedicaid as $insuranceLabelFeeMedicaid) {
                                    $field = str_replace(" ", "_", strtolower($insuranceLabelFeeMedicaid->description));
                                    if ($procedureFees == $field) {
                                        ProcedureFee::updateOrCreate([
                                            'insurance_label_fee_id' => $insuranceLabelFeeMedicare->id,
                                            'procedure_id'           => $procedure->id,
                                            'mac_locality_id'        => $macLocality->id
                                        ], [
                                            'fee'                    => $value
                                        ]);
                                    }
                                }
                            }
                        }

                        if (isset($macL['company_procedure']) && isset($macL['company_procedure']['price'])) {
                            $companyProcedureLabelFee = InsuranceLabelFee::whereDescription(ucfirst(strtolower($macL['selectedPrice'])))->first();
                            $company->procedures()->attach(
                                $procedure->id,
                                [
                                    'price'                  => $macL['company_procedure']['price'],
                                    'price_percentage'       => $macL['company_procedure']['price_percentage'],
                                    'insurance_label_fee_id' => $companyProcedureLabelFee->id ?? null
                                ]
                            );
                        }

                        if (isset($macL['insurance_plan_procedure']) && isset($macL['insurance_plan_procedure']['price'])) {
                            $planProcedureLabelFee = InsuranceLabelFee::whereDescription(ucfirst(strtolower($macL['selectedPriceContractFee'])))->first();
                            $insurancePlan = InsurancePlan::find($macL['insurance_plan_procedure']['insurance_plan_id']);
                            if (isset($insurancePlan)) {
                                $insurancePlan->procedures()->attach(
                                    $procedure->id,
                                    [
                                        'price'                  => $macL['insurance_plan_procedure']['price'],
                                        'price_percentage'       => $macL['insurance_plan_procedure']['price_percentage'],
                                        'insurance_label_fee_id' => $planProcedureLabelFee->id ?? null
                                    ]
                                );
                            }
                        }
                    }
                }
            }
            DB::commit();
            return $company;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param  int $id
     * @return Company|Builder|Model|object|null
     */
    public function getToCompany(int $companyId) {
        $mac_localities = [];
        $labelFees = getList(InsuranceLabelFee::class, 'description');
        $procedures = Procedure::whereHas('companies', function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->with(['companies', 'insurancePlans', 'macLocalities', 'macLocalities.procedureFees', 'macLocalities.procedureFees.insuranceLabelFee'])->get();

        foreach ($procedures as $procedure) {
            foreach ($procedure['macLocalities'] as $macL) {
                foreach ($labelFees as $labelFee) {
                    $fees[Str::snake($labelFee['name'])] = '';
                }
                foreach ($macL['procedureFees'] as $procedureFee) {
                    $fees[Str::snake($procedureFee['insuranceLabelFee']['description'])] = $procedureFee['fee'];
                }
                $companyProcedureLabelFee = InsuranceLabelFee::find($procedure['companies']['0']['pivot']['insurance_label_fee_id'] ?? null);
                $planProcedureLabelFee = InsuranceLabelFee::find($procedure['insurancePlans']['0']['pivot']['insurance_label_fee_id'] ?? null);

                array_push($mac_localities, [
                    'procedure_id'          => $macL['pivot']['procedure_id'],
                    'procedure_code'        => $procedure['code'],
                    'procedure_description' => $procedure['description'],
                    'modifier_id'           => $macL['pivot']['modifier_id'],
                    'modifier_code'         => $macL['modifier']['modifier'] ?? '',
                    'mac'                   => $macL['mac'],
                    'state'                 => $macL['state'],
                    'fsa'                   => $macL['fsa'],
                    'counties'              => $macL['counties'],
                    'locality_number'       => $macL['locality_number'],
                    'procedure_fees'        => $fees,
                    'company_procedure'     => [
                        'price'                  => $procedure['companies']['0']['pivot']['price'] ?? '',
                        'price_percentage'       => $procedure['companies']['0']['pivot']['price_percentage'] ?? ''
                    ],
                    'insurance_plan_procedure' => [
                        'price'                  => $procedure['insurancePlans']['0']['pivot']['price'] ?? '',
                        'price_percentage'       => $procedure['insurancePlans']['0']['pivot']['price_percentage'] ?? '',
                        'insurance_company_id'   => $procedure['insurancePlans']['0']['insurance_company_id'] ?? '',
                        'insurance_company_name' => $procedure['insurancePlans']['0']['insuranceCompany']['name'] ?? '',
                        'insurance_plan_id'      => $procedure['insurancePlans']['0']['pivot']['insurance_plan_id'] ?? '',
                        'insurance_plan_name'    => $procedure['insurancePlans']['0']['name'] ?? ''
                    ],
                    "selectedPrice"              => ucwords($companyProcedureLabelFee->description ?? ''),
                    "selectedPriceContractFee"   => ucwords($planProcedureLabelFee->description ?? '')
                ]);
            }
        }
        return $mac_localities;
    }
}

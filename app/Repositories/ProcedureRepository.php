<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\InsuranceLabelFee;
use App\Models\InsuranceType;
use App\Models\MacLocality;
use App\Models\PublicNote;
use App\Models\ProcedureConsideration;
use App\Models\ProcedureFee;
use App\Models\Procedure;
use App\Models\Gender;
use App\Models\Discriminatory;

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

            if (isset($data['mac_localities'])) {
                foreach ($data['mac_localities'] as $macL) {
                    $macLocality = MacLocality::updateOrCreate([
                        "mac"             => $macL['mac'],
                        "locality_number" => $macL['locality_number'],
                        "state"           => $macL['state'],
                        "fsa"             => $macL['fsa'],
                        "counties"        => $macL['counties']
                    ], [
                        "mac"             => $macL['mac'],
                        "locality_number" => $macL['locality_number'],
                        "state"           => $macL['state'],
                        "fsa"             => $macL['fsa'],
                        "counties"        => $macL['counties']
                    ]);
                    if (isset($macLocality)) {
                        /** Attach macLocality to procedure */
                        $procedure->macLocalities()->attach($macLocality->id);
                    }
                    foreach ($macL['procedure_fees'] as $procedureFees) {
                        /** insuranceType == Medicare */
                        $insuranceLabelFeesMedicare = InsuranceLabelFee::whereHas('insuranceType', function ($query) {
                            $query->whereDescription('Medicare');
                        })->get();

                        foreach ($insuranceLabelFeesMedicare as $insuranceLabelFeeMedicare) {
                            $field = str_replace(" ", "_", strtolower($insuranceLabelFeeMedicare->description));
                            if (isset($procedureFees[$field])) {
                                ProcedureFee::updateOrCreate([
                                    'insurance_label_fee_id' => $insuranceLabelFeeMedicare->id,
                                    'procedure_id'           => $procedure->id,
                                    'mac_locality_id'        => $macLocality->id
                                ], [
                                    'fee'                    => $procedureFees[$field]
                                ]);
                            }
                        }

                        /** insuranceType == Medicaid */
                        $insuranceLabelFeesMedicaid = InsuranceLabelFee::whereHas('insuranceType', function ($query) {
                            $query->whereDescription('Medicaid');
                        })->get();

                        foreach ($insuranceLabelFeesMedicaid as $insuranceLabelFeeMedicaid) {
                            $field = str_replace(" ", "_", strtolower($insuranceLabelFeeMedicaid->description));
                            if (isset($procedureFees[$field])) {
                                ProcedureFee::updateOrCreate([
                                    'insurance_label_fee_id' => $insuranceLabelFeeMedicare->id,
                                    'procedure_id'           => $procedure->id,
                                    'mac_locality_id'        => $macLocality->id
                                ], [
                                    'fee'                    => $procedureFees[$field]
                                ]);
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
        $sortBy   = $request->sortBy ?? 'id';
        $sortDesc = $request->sortDesc ?? false;
        $page = $request->page ?? 1;
        $itemsPerPage = $request->itemsPerPage ?? 5;
        $search = $request->search ?? '';

        $records = Procedure::with([
            "publicNote",
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
     * @param int $id
     * @return Procedure|Builder|Model|object|null
     */
    public function getOneProcedure(int $id) {
        $procedure = Procedure::whereId($id)->with([
            "publicNote",
            "procedureCosiderations",
            "companies",
            "diagnoses",
            "modifiers",
            "macLocalities"
        ])->first();

        return !is_null($procedure) ? $procedure : null;
    }

    /**
     * @param string $code
     * @return Procedure|Builder|Model|object|null
     */
    public function getByCode(string $code) {
        $procedure = Procedure::whereCode($code)->with([
                "publicNote",
                "procedureCosiderations",
                "companies",
                "diagnoses",
                "modifiers",
                "macLocalities"
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

            if (isset($data['mac_localities'])) {
                /** Delete mac localities */
                $procedure->macLocalities()->detach();
                /** update or create new mac localities */
                foreach ($data['mac_localities'] as $macL) {
                    $macLocality = MacLocality::updateOrCreate([
                        "mac"             => $macL['mac'],
                        "locality_number" => $macL['locality_number'],
                        "state"           => $macL['state'],
                        "fsa"             => $macL['fsa'],
                        "counties"        => $macL['counties']
                    ], [
                        "mac"             => $macL['mac'],
                        "locality_number" => $macL['locality_number'],
                        "state"           => $macL['state'],
                        "fsa"             => $macL['fsa'],
                        "counties"        => $macL['counties']
                    ]);
                    if (isset($macLocality)) {
                        /** Attach macLocality to procedure */
                        $procedure->macLocalities()->attach($macLocality->id);
                    }
                    foreach ($macL['procedure_fees'] as $procedureFees) {
                        /** insuranceType == Medicare */
                        $insuranceLabelFeesMedicare = InsuranceLabelFee::whereHas('insuranceType', function ($query) {
                            $query->whereDescription('Medicare');
                        })->get();

                        foreach ($insuranceLabelFeesMedicare as $insuranceLabelFeeMedicare) {
                            $field = str_replace(" ", "_", strtolower($insuranceLabelFeeMedicare->description));
                            if (isset($procedureFees[$field])) {
                                ProcedureFee::updateOrCreate([
                                    'insurance_label_fee_id' => $insuranceLabelFeeMedicare->id,
                                    'procedure_id'           => $procedure->id,
                                    'mac_locality_id'        => $macLocality->id
                                ], [
                                    'fee'                    => $procedureFees[$field]
                                ]);
                            }
                        }

                        /** insuranceType == Medicaid */
                        $insuranceLabelFeesMedicaid = InsuranceLabelFee::whereHas('insuranceType', function ($query) {
                            $query->whereDescription('Medicaid');
                        })->get();

                        foreach ($insuranceLabelFeesMedicaid as $insuranceLabelFeeMedicaid) {
                            $field = str_replace(" ", "_", strtolower($insuranceLabelFeeMedicaid->description));
                            if (isset($procedureFees[$field])) {
                                ProcedureFee::updateOrCreate([
                                    'insurance_label_fee_id' => $insuranceLabelFeeMedicare->id,
                                    'procedure_id'           => $procedure->id,
                                    'mac_locality_id'        => $macLocality->id
                                ], [
                                    'fee'                    => $procedureFees[$field]
                                ]);
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

        return $procedure->update(["active" => $status]);
    }

    public function getListMacLocalities(Request $request) {
        try {
            $records['mac'] = MacLocality::select('mac')->distinct()->get();
            $records['locality_number'] = MacLocality::select('locality_number')->distinct()->get();
            $records['state'] = MacLocality::select('state')->distinct()->get();
            $records['fsa'] = MacLocality::select('fsa')->distinct()->get();
            $records['counties'] = MacLocality::select('counties')->distinct()->get();
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
}

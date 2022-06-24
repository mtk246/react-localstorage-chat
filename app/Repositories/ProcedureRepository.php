<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\InsuranceLabelFee;
use App\Models\InsuranceType;
use App\Models\MacLocality;
use App\Models\PublicNote;
use App\Models\ProcedureConsideration;
use App\Models\ProcedureFee;
use App\Models\Procedure;

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
                "code" => $data['code'],
                "description" => $data['description']
            ]);

            if (isset($data['mac_localities'])) {
                foreach ($data['mac_localities'] as $macL) {
                    $macLocality = MacLocality::create([
                        "mac"             => $macL['mac'],
                        "locality_number" => $macL['locality_number'],
                        "state"           => $macL['state'],
                        "fsa"             => $macL['fsa'],
                        "counties"        => $macL['countries']
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
                ProcedureConsideration::create([
                    'procedure_id'      => $procedure->id,
                    'gender_id'         => $data['procedure_considerations']['gender_id'],
                    'age_init'          => $data['procedure_considerations']['age_init'],
                    'age_end'           => $data['procedure_considerations']['age_end'],
                    'discriminatory_id' => $data['procedure_considerations']['discriminatory_id']
                ]);
            }

            if (isset($data['modifiers'])) {
                foreach ($data['modifiers'] as $modifier) {
                    $procedure->modifiers()->sync($tax_array);
                }
            }

            if (isset($data['diagnoses'])) {
                foreach ($data['diagnoses'] as $diagnosis) {
                    $procedure->diagnoses()->sync($tax_array);
                }
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

    /**
     * @param int $id
     * @return Procedure|Builder|Model|object|null
     */
    public function getOneProcedure(int $id) {
        $procedure = Procedure::whereId($id)->with([
            "publicNote",
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
            ]);

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
}
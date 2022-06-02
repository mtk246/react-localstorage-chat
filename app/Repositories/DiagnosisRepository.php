<?php

namespace App\Repositories;

use App\Models\Diagnosis;
use App\Models\PublicNote;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DiagnosisRepository
{
    /**
     * @param array $data
     * @return Diagnosis|Model
     */
    public function createDiagnosis(array $data) {
        try {
            DB::beginTransaction();
            $diagnosis = Diagnosis::create([
                "code"        => $data["code"],
                "description" => $data["description"]
            ]);
            
            if (isset($data['note'])) {
                PublicNote::create([
                    'publishable_type' => Diagnosis::class,
                    'publishable_id'   => $diagnosis->id,
                    'note'             => $data['note'],
                ]);
            }

            DB::commit();
            return $diagnosis;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    
    public function getListDiagnoses($id = null) {
        try {
            return getList(Diagnosis::class, ['code', '-', 'description']);
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @return Diagnosis[]|Collection
     */
    public function getAllDiagnoses() {
        $diagnoses = Diagnosis::with([
            "publicNote",
        ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        
        return is_null($diagnoses) ? null : $diagnoses;
    }

    /**
     * @param int $id
     * @return Diagnosis|Builder|Model|object|null
     */
    public function getOneDiagnosis(int $id) {
        $diagnosis = Diagnosis::whereId($id)->with([
                "publicNote",
            ])->first();

        return !is_null($diagnosis) ? $diagnosis : null;
    }

    /**
     * @param array $data
     * @param int $id
     * @return Diagnosis|Builder|Model|object|null
     */
    public function updateDiagnosis(array $data, int $id) {
        try {
            DB::beginTransaction();
            $diagnosis = Diagnosis::find($id);

            $diagnosis->update([
                "code"        => $data["code"],
                "description" => $data["description"]
            ]);

            if (isset($data['note'])) {
                /** PublicNote */
                PublicNote::updateOrCreate([
                    'publishable_type' => Diagnosis::class,
                    'publishable_id'   => $diagnosis->id,
                ], [
                    'note'             => $data['note'],
                ]);
            }

            DB::commit();
            return Diagnosis::whereId($id)->first();
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
        $diagnosis = Diagnosis::find($id);

        if (is_null($diagnosis)) return null;

        return $diagnosis->update(["active" => $status]);
    }
}

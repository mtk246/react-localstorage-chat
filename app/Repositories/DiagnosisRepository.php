<?php

namespace App\Repositories;

use App\Models\Diagnosis;
use App\Models\PublicNote;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
                "start_date"  => $data["start_date"],
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

    public function getServerAllDiagnoses(Request $request) {
        $sortBy   = $request->sortBy ?? 'id';
        $sortDesc = $request->sortDesc ?? false;
        $page = $request->page ?? 1;
        $itemsPerPage = $request->itemsPerPage ?? 5;
        $search = $request->search ?? '';

        $records = Diagnosis::with([
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
     * @return Diagnosis|Builder|Model|object|null
     */
    public function getOneDiagnosis(int $id) {
        $diagnosis = Diagnosis::whereId($id)->with([
                "publicNote",
            ])->first();

        return !is_null($diagnosis) ? $diagnosis : null;
    }

    /**
     * @param string $code
     * @return Diagnosis|Builder|Model|object|null
     */
    public function getByCode(string $code) {
        $diagnosis = Diagnosis::whereCode($code)->with([
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
                "start_date"  => $data["start_date"],
                "end_date"    => $data["end_date"] ?? null,
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
            return Diagnosis::whereId($id)->with([
                "publicNote",
            ])->first();
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

        if ($status) {
            return $diagnosis->update(
                [
                    "active"   => $status,
                    "end_date" => null
                ]
            );
        } else {
            return $diagnosis->update(
                [
                    "active"   => $status,
                    "end_date" => now()
                ]
            );
        }
    }
}

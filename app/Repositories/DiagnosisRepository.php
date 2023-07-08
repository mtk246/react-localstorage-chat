<?php

namespace App\Repositories;

use App\Models\Diagnosis;
use App\Models\PublicNote;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Diagnoses\DiagnosesResource;

class DiagnosisRepository
{
    /**
     * @return Diagnosis|Model
     */
    public function createDiagnosis(array $data)
    {
        try {
            DB::beginTransaction();
            $diagnosis = Diagnosis::create([
                'code' => $data['code'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'] ?? null,
                'description' => $data['description'],
                'type' => $data['type'],
                'clasifications' => collect($data['clasifications'])->filter()->toArray(),
                'description_long' => $data['description_long'] ?? null,
                'age' => $data['age'] ?? null,
                'age_end' => $data['age_end'] ?? null,
                'gender_id' => $data['gender_id'] ?? null,
                'injury_date_required' => $data['injury_date_required'] ?? null,
                'discriminatory_id' => $data['discriminatory_id'] ?? null,
            ]);

            if (isset($data['note'])) {
                PublicNote::create([
                    'publishable_type' => Diagnosis::class,
                    'publishable_id' => $diagnosis->id,
                    'note' => $data['note'],
                ]);
            }

            DB::commit();

            return new DiagnosesResource($diagnosis);
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    public function getListDiagnoses($id = null)
    {
        try {
            return getList(Diagnosis::class, ['code', '-', 'description']);
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @return Diagnosis[]|Collection
     */
    public function getAllDiagnoses()
    {
        $diagnoses = Diagnosis::with([
            'publicNote',
        ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();

        return is_null($diagnoses) ? null : $diagnoses;
    }

    public function getServerAllDiagnoses(Request $request)
    {
        $data = Diagnosis::with([
            'publicNote',
            'discriminatory'
        ]);
        if (!empty($request->query('query')) && '{}' !== $request->query('query')) {
            $data = $data->search($request->query('query'));
        }

        if ($request->sortBy) {
            $data = $data->orderBy($request->sortBy, (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
        } else {
            $data = $data->orderBy('created_at', 'desc')->orderBy('id', 'asc');
        }

        $data = $data->paginate($request->itemsPerPage ?? 10);

        return response()->json([
            'data' => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count' => $data->total(),
        ], 200);
    }

    /**
     * @return Diagnosis|Builder|Model|object|null
     */
    public function getOneDiagnosis(int $id)
    {
        $diagnosis = Diagnosis::whereId($id)->with([
                'publicNote',
                'gender',
            ])->first();

        return !is_null($diagnosis) ? new DiagnosesResource($diagnosis) : null;
    }

    /**
     * @return Diagnosis|Builder|Model|object|null
     */
    public function getByCode(string $code)
    {
        $diagnosis = Diagnosis::whereCode($code)->with([
                'publicNote',
            ])->first();

        return !is_null($diagnosis) ? $diagnosis : null;
    }

    /**
     * @return Diagnosis|Builder|Model|object|null
     */
    public function updateDiagnosis(array $data, int $id)
    {
        try {
            DB::beginTransaction();
            $diagnosis = Diagnosis::find($id);

            $diagnosis->update([
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'] ?? null,
                'description' => $data['description'],
                'type' => $data['type'],
                'clasifications' => collect($data['clasifications'])->filter()->toArray(),
                'description_long' => $data['description_long'] ?? null,
                'age' => $data['age'] ?? null,
                'age_end' => $data['age_end'] ?? null,
                'gender_id' => $data['gender_id'] ?? null,
                'discriminatory_id' => $data['discriminatory_id'] ?? null,
            ]);

            if (isset($data['note'])) {
                /* PublicNote */
                PublicNote::updateOrCreate([
                    'publishable_type' => Diagnosis::class,
                    'publishable_id' => $diagnosis->id,
                ], [
                    'note' => $data['note'],
                ]);
            }

            DB::commit();

            return Diagnosis::whereId($id)->with([
                'publicNote',
                'gender',
                'discriminatory'
            ])->first();
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @return bool|int|null
     */
    public function changeStatus(bool $status, int $id)
    {
        $diagnosis = Diagnosis::find($id);

        if (is_null($diagnosis)) {
            return null;
        }

        if ($status) {
            $diagnosis->update(
                [
                    'active' => $status,
                    'end_date' => null,
                ]
            );
        } else {
            $diagnosis->update(
                [
                    'active' => $status,
                    'end_date' => now(),
                ]
            );
        }

        return [
            'active' => $diagnosis->active
        ];
    }

    public function deleteDiagnosis(int $id)
    {
        $diagnosis = Diagnosis::find($id);
        return $diagnosis->update(['status' => false]);
    }

}

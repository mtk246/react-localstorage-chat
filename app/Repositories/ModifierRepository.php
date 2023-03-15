<?php

namespace App\Repositories;

use App\Models\Modifier;
use App\Models\ModifierInvalidCombination;
use App\Models\PublicNote;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ModifierRepository
{
    /**
     * @param array $data
     * @return modifier|Model
     */
    public function createModifier(array $data) {
        try {
            DB::beginTransaction();
            $modifier = Modifier::create([
                "modifier"                    => $data["modifier"],
                "start_date"                  => $data["start_date"],
                "special_coding_instructions" => $data["special_coding_instructions"]
            ]);

            if (isset($data['modifier_invalid_combinations'])) {
                foreach ($data['modifier_invalid_combinations'] as $invalidCombination) {
                    ModifierInvalidCombination::create([
                        'modifier_id'         => $modifier->id,
                        'invalid_combination' => $invalidCombination
                    ]);
                }
            }
            
            if (isset($data['note'])) {
                PublicNote::create([
                    'publishable_type' => Modifier::class,
                    'publishable_id'   => $modifier->id,
                    'note'             => $data['note'],
                ]);
            }

            DB::commit();
            return $modifier;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    
    public function getListModifiers($id = null) {
        try {
            return getList(Modifier::class, 'modifier');
        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * @return modifier[]|Collection
     */
    public function getAllModifiers() {
        $modifiers = Modifier::with([
            "publicNote",
            "modifierInvalidCombinations"
        ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        
        return is_null($modifiers) ? null : $modifiers;
    }

    public function getServerAllModifiers(Request $request) {
        $data = Modifier::with([
            "publicNote",
            "modifierInvalidCombinations"
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
     * @return modifier|Builder|Model|object|null
     */
    public function getOneModifier(int $id) {
        $modifier = Modifier::whereId($id)->with([
            "publicNote",
            "modifierInvalidCombinations"
        ])->first();

        return !is_null($modifier) ? $modifier : null;
    }

    /**
     * @param string $code
     * @return Modifier|Builder|Model|object|null
     */
    public function getByCode(string $code) {
        $modifier = Modifier::whereModifier($code)->with([
                "publicNote",
                "modifierInvalidCombinations"
            ])->first();

        return !is_null($modifier) ? $modifier : null;
    }

    /**
     * @param array $data
     * @param int $id
     * @return modifier|Builder|Model|object|null
     */
    public function updateModifier(array $data, int $id) {
        try {
            DB::beginTransaction();
            $modifier = Modifier::find($id);

            $modifier->update([
                "start_date"                  => $data["start_date"],
                "end_date"                    => $data["end_date"] ?? null,
                "special_coding_instructions" => $data["special_coding_instructions"]
            ]);

            if (isset($data['modifier_invalid_combinations'])) {
                $invalidCombinations = $modifier->modifierInvalidCombinations;

                /** Delete modifierInvalidCombinations */
                foreach ($invalidCombinations as $invalidC) {
                    $validated = false;
                    foreach ($data['modifier_invalid_combinations'] as $invalidCombination) {
                        if ($invalidCombination == $invalidC->invalid_combination) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) $invalidC->delete();
                }

                foreach ($data['modifier_invalid_combinations'] as $invalidCombination) {
                    ModifierInvalidCombination::updateOrCreate([
                        'modifier_id'         => $modifier->id,
                        'invalid_combination' => $invalidCombination
                    ], [
                        'modifier_id'         => $modifier->id,
                        'invalid_combination' => $invalidCombination
                    ]);
                }
            }

            if (isset($data['note'])) {
                /** PublicNote */
                PublicNote::updateOrCreate([
                    'publishable_type' => Modifier::class,
                    'publishable_id'   => $modifier->id,
                ], [
                    'note'             => $data['note'],
                ]);
            }

            DB::commit();
            return Modifier::whereId($id)->with([
                "publicNote",
                "modifierInvalidCombinations"
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
        $modifier = Modifier::find($id);

        if (is_null($modifier)) return null;

        if ($status) {
            return $modifier->update(
                [
                    "active"   => $status,
                    "end_date" => null
                ]
            );
        } else {
            return $modifier->update(
                [
                    "active"   => $status,
                    "end_date" => now()
                ]
            );
        }
    }
}

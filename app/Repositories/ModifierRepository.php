<?php

namespace App\Repositories;

use App\Http\Resources\ModifierResource;
use App\Http\Resources\Procedure\ListModifierResource;
use App\Models\Modifier;
use App\Models\ModifierInvalidCombination;
use App\Models\PublicNote;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class ModifierRepository
{
    public function createModifier(array $data): ModifierResource
    {
        try {
            DB::beginTransaction();
            $modifier = Modifier::create([
                'modifier' => $data['modifier'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'] ?? null,
                'special_coding_instructions' => $data['special_coding_instructions'],
                'classification' => $data['classification'],
                'type' => $data['type'],
                'description' => $data['description'],
            ]);

            if (isset($data['modifier_invalid_combinations'])) {                

                $modifier_invalid_combinations_data = [];

                foreach ($data['modifier_invalid_combinations'] as $invalidCombination) {
                    array_push($modifier_invalid_combinations_data, [
                        'modifier_id' => $modifier->id,
                        'invalid_combination' => $invalidCombination
                    ]);
                }

                ModifierInvalidCombination::insert($modifier_invalid_combinations_data);

            }

            if (isset($data['note'])) {
                PublicNote::create([
                    'publishable_type' => Modifier::class,
                    'publishable_id' => $modifier->id,
                    'note' => $data['note'],
                ]);
            }

            DB::commit();

            return new ModifierResource($modifier->load([
                'publicNote',
                'modifierInvalidCombinations',
            ]));
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function getListModifiers($id = null)
    {
        $records = Modifier::all();

        return ListModifierResource::collection($records);
    }

    public function getAllModifiers(): AnonymousResourceCollection
    {
        $modifiers = Modifier::with([
            'publicNote',
            'modifierInvalidCombinations',
        ])->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();

        return ModifierResource::collection($modifiers);
    }

    public function getServerAllModifiers(Request $request)
    {
        $data = Modifier::with([
            'publicNote',
            'modifierInvalidCombinations',
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
            'data' => ModifierResource::collection($data->items()),
            'numberOfPages' => $data->lastPage(),
            'count' => $data->total(),
        ], 200);
    }

    public function getOneModifier(int $id): ModifierResource
    {
        $modifier = Modifier::whereId($id)->with([
            'publicNote',
            'modifierInvalidCombinations',
        ])->first();

        return new ModifierResource($modifier);
    }

    public function getByCode(string $code): ModifierResource
    {
        $modifier = Modifier::whereModifier($code)->with([
                'publicNote',
                'modifierInvalidCombinations',
            ])->first();

        return new ModifierResource($modifier);
    }

    public function updateModifier(array $data, int $id): ModifierResource
    {
        try {
            DB::beginTransaction();
            $modifier = Modifier::find($id);

            $modifier->update([
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'] ?? null,
                'special_coding_instructions' => $data['special_coding_instructions'],
                'classification' => $data['classification'],
                'type' => $data['type'],
                'description' => $data['description'],
            ]);

            if (isset($data['modifier_invalid_combinations'])) {
                $invalidCombinations = $modifier->modifierInvalidCombinations;

                /* Delete modifierInvalidCombinations */
                foreach ($invalidCombinations as $invalidC) {
                    $validated = false;
                    foreach ($data['modifier_invalid_combinations'] as $invalidCombination) {
                        if ($invalidCombination == $invalidC->invalid_combination) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) {
                        $invalidC->delete();
                    }
                }

                foreach ($data['modifier_invalid_combinations'] as $invalidCombination) {

                    foreach ($data['modifier_invalid_combinations'] as $invalidCombination) {

                        ModifierInvalidCombination::updateOrCreate([
                            'modifier_id' => $modifier->id,
                            'invalid_combination' => $invalidCombination,
                        ], [
                            'modifier_id' => $modifier->id,
                            'invalid_combination' => $invalidCombination,
                        ]);

                        
                        /*foreach ($data['modifier_invalid_combinations'] as $invalidCombination) {
                           
                            ModifierInvalidCombination::updateOrCreate([
                                'modifier_id' => $modifier->id,
                                'invalid_combination' => $invalidCombination['invalid_combination'],
                            ], [
                                'modifier_id' => $modifier->id,
                                'invalid_combination' => $invalidCombination['invalid_combination'],
                            ]);
                        }*/
                    }
                }
            }

            DB::commit();

            $record = Modifier::whereId($id)->with([
                'modifierInvalidCombinations',
            ])->first();

            return new ModifierResource($record);
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    public function updateModifierNote(Modifier $modifier, string $note)
    {
        $modifier->publicNote()->updateOrCreate([
            'publishable_type' => Modifier::class,
            'publishable_id' => $modifier->id,
        ], [
            'note' => $note,
        ]);

        return $modifier->load(['publicNote']);
    }

    /**
     * @return bool|int|null
     */
    public function changeStatus(bool $status, int $id)
    {
        $modifier = Modifier::find($id);

        if (is_null($modifier)) {
            return null;
        }

        if ($status) {
            return $modifier->update(
                [
                    'active' => $status,
                    'end_date' => null,
                ]
            );
        } else {
            return $modifier->update(
                [
                    'active' => $status,
                    'end_date' => now(),
                ]
            );
        }
    }
}

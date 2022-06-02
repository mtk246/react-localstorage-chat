<?php

namespace App\Repositories;

use App\Models\Modifier;
use App\Models\PublicNote;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
                "description"                 => $data["description"],
                "special_coding_instructions" => $data["special_coding_instructions"]
            ]);
            
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
        ])->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        
        return is_null($modifiers) ? null : $modifiers;
    }

    /**
     * @param int $id
     * @return modifier|Builder|Model|object|null
     */
    public function getOneModifier(int $id) {
        $modifier = Modifier::whereId($id)->with([
            "publicNote",
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
                "modifier"                    => $data["modifier"],
                "description"                 => $data["description"],
                "special_coding_instructions" => $data["special_coding_instructions"]
            ]);

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
            return Modifier::whereId($id)->first();
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

        return $modifier->update(["active" => $status]);
    }
}

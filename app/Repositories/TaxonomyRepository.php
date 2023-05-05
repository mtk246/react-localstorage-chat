<?php

namespace App\Repositories;

use App\Models\Taxonomy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaxonomyRepository
{
    public function checkPrimaryTaxonomy(int $user_id = null, int $company_id = null): bool
    {
        $taxonomies = !is_null($user_id) ? Taxonomy::whereUserId($user_id)
            ->where('isPrimary', true)->get()
            : Taxonomy::whereCompanyId($company_id)
            ->where('isPrimary', true)->get();

        return 0 == count($taxonomies);
    }

    /**
     * @return Taxonomy|Model|null
     */
    public function addTaxonomy(array $data)
    {
        try {
            DB::beginTransaction();
            $taxonomy = Taxonomy::create($data);

            if (!is_null($taxonomy)) {
                DB::commit();

                return $taxonomy;
            }

            return null;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());

            return null;
        }
    }

    /**
     * @return bool|mixed|null
     */
    public function removeTaxonomy(int $id)
    {
        return Taxonomy::whereId($id)->delete();
    }

    /**
     * @return Taxonomy|Builder|Model|object|null
     */
    public function updateTaxonomy(array $data, int $id)
    {
        $taxonomy = Taxonomy::whereId($id)->first();
        $taxonomy->update($data);

        return $taxonomy->refresh();
    }

    /**
     * @return bool|int
     */
    public function changePrimary(bool $primary, int $id, int $user_id = null, int $company_id = null)
    {
        $taxonomies = !is_null($user_id) ? Taxonomy::whereUserId($user_id)->where('isPrimary', true)->get()
            : Taxonomy::whereCompanyId($company_id)->where('isPrimary', true)->get();

        if (0 == count($taxonomies)) {
            return Taxonomy::whereId($id)->update(['isPrimary' => $primary]);
        } else {
            if ($primary) {
                if ($id != $taxonomies[0]->id) {
                    return false;
                } else {
                    return Taxonomy::whereId($id)->update(['isPrimary' => $primary]);
                }
            } else {
                return Taxonomy::whereId($id)->update(['isPrimary' => $primary]);
            }
        }
    }

    /**
     * @return Taxonomy[]|Builder[]|Collection
     */
    public function getAllTaxonomy(int $type, int $id)
    {
        return $type > 1 ? Taxonomy::whereCompanyId($id)->get() : Taxonomy::whereUserId($id)->get();
    }

    /**
     * @return Taxonomy|Builder|Model|object|null
     */
    public function getOneTaxonomy(int $id)
    {
        $taxonomy = Taxonomy::whereId($id)->first();

        return $taxonomy ? $taxonomy : null;
    }
}

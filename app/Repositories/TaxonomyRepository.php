<?php

namespace App\Repositories;

use App\Models\Taxonomy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TaxonomyRepository
{
    /**
     * @param int|null $user_id
     * @param int|null $company_id
     * @return bool
     */
    public function checkPrimaryTaxonomy(int $user_id = null,int $company_id = null): bool
    {
        $taxonomies = !is_null($user_id) ? Taxonomy::whereUserId($user_id)
            ->where("isPrimary",true)->get()
            : Taxonomy::whereCompanyId($company_id)
            ->where("isPrimary",true)->get();

        return count($taxonomies) == 0;
    }

    /**
     * @param array $data
     * @return Taxonomy|Model|null
     */
    public function addTaxonomy(array $data){
        try {
            DB::beginTransaction();
            $taxonomy = Taxonomy::create($data);

            if(!is_null($taxonomy)){
                DB::commit();
                return $taxonomy;
            }

            return null;
        }catch (\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
            return null;
        }
    }

    /**
     * @param int $id
     * @return bool|mixed|null
     */
    public function removeTaxonomy(int $id){
        return Taxonomy::whereId($id)->delete();
    }

    /**
     * @param array $data
     * @param int $id
     * @return Taxonomy|Builder|Model|object|null
     */
    public function updateTaxonomy(array $data,int $id){
        $taxonomy = Taxonomy::whereId($id)->first();
        $taxonomy->update($data);
        return $taxonomy->refresh();
    }

    /**
     * @param bool $primary
     * @param int $id
     * @param int|null $user_id
     * @param int|null $company_id
     * @return bool|int
     */
    public function changePrimary(bool $primary, int $id, int $user_id=null, int $company_id=null){
        $taxonomies = !is_null($user_id) ? Taxonomy::whereUserId($user_id)->where("isPrimary",true)->get()
            : Taxonomy::whereCompanyId($company_id)->where("isPrimary",true)->get();

        if(count($taxonomies) == 0) return Taxonomy::whereId($id)->update(["isPrimary" => $primary]);
        else{
            if($primary){
                if($id != $taxonomies[0]->id) return false;
                else return Taxonomy::whereId($id)->update(["isPrimary" => $primary]);
            }else{
                return Taxonomy::whereId($id)->update(["isPrimary" => $primary]);
            }
        }
    }

    /**
     * @param int $type
     * @param int $id
     * @return Taxonomy[]|Builder[]|Collection
     */
    public function getAllTaxonomy(int $type,int $id){
        return $type > 1 ? Taxonomy::whereCompanyId($id)->get() : Taxonomy::whereUserId($id)->get();
    }

    /**
     * @param int $id
     * @return Taxonomy|Builder|Model|object|null
     */
    public function getOneTaxonomy(int $id){
        $taxonomy = Taxonomy::whereId($id)->first();

        return $taxonomy ? $taxonomy : null;
    }
}

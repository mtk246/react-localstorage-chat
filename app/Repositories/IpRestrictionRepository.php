<?php

namespace App\Repositories;

use App\Models\IpRestriction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IpRestrictionRepository
{
    /**
     * @param     array $data
     * @return    ipRestriction|Model|null
     */
    public function create(array $data) {
        try {
            DB::beginTransaction();
            $billingCompany = auth()->user()->billingCompanies->first();

            $restriction = IpRestriction::create([
                'ip_beginning'       => $data['ip_beginning'],
                'ip_finish'          => $data['ip_finish'],
                'rank'               => $data['rank'],
                'billing_company_id' => $billingCompany->id ?? null,
            ]);
            if (isset($data['users'])) {
                $restriction->users()->syncWithoutDetaching($data['users']);
            }
            /*if (isset($data['roles'])) {
                $restriction->roles()->syncWithoutDetaching($data['roles']);
            }*/

            DB::commit();
            return $restriction;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }

    }

    public function update(array $data, int $id) {
        try {
            DB::beginTransaction();

            $restriction = IpRestriction::find($id);
            $restriction->update([
                'ip_beginning' => $data['ip_beginning'],
                'ip_finish'    => $data['ip_finish'],
                'rank'         => $data['rank'],
            ]);

            if (isset($data['users'])) {
                $restriction->users()->sync($data['users']);
            }
            /*if (isset($data['roles'])) {
                $restriction->roles()->syncWithoutDetaching($data['roles']);
            }*/

            DB::commit();
            return $restriction;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    public function getAllRestrictions() {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $restrictions = IpRestriction::orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        } else {
            $restrictions = IpRestriction::where('billing_company_id', $bC)
                                        ->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        }
        return !is_null($restrictions) ? $restrictions : null;
    }

    public function getOneRestriction(int $id) {
        return IpRestriction::with('users')->find($id);
    }

    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();
            $restriction = IpRestriction::find($id);
            $restriction->users()->detach();
            $restriction->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
        return true;
    }
}

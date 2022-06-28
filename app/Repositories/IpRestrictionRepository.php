<?php

namespace App\Repositories;

use App\Models\IpRestriction;
use App\Models\IpRestrictionMult;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IpRestrictionRepository
{
    /**
     * @param     array $data
     * @return    ipRestriction|Model|null
     */
    public function create(array $data) {
        try {
            DB::beginTransaction();
            
            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            $restriction = IpRestriction::create([
                'entity'             => $data['entity'],
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ]);

            foreach ($data['ip_restriction_mults'] as $ip_restriction) {
                IpRestrictionMult::create([
                    'ip_beginning'      => $ip_restriction['ip_beginning'],
                    'ip_finish'         => $ip_restriction['ip_finish'],
                    'rank'              => $ip_restriction['rank'],
                    'ip_restriction_id' => $restriction->id,
                ]);
            }

            if ($data['entity'] == 'user') {
                if (isset($data['users'])) {
                    $restriction->users()->sync($data['users']);
                }
            }
            if ($data['entity'] == 'role') {
                if (isset($data['roles'])) {
                    $restriction->roles()->sync($data['roles']);
                }
            }

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

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"];
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            $restriction = IpRestriction::find($id);

            $restriction->update([
                'entity'             => $data['entity'],
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ]);

            $restriction->IpRestrictionMults()->delete();

            foreach ($data['ip_restriction_mults'] as $ip_restriction) {
                IpRestrictionMult::create([
                    'ip_beginning'      => $ip_restriction['ip_beginning'],
                    'ip_finish'         => $ip_restriction['ip_finish'],
                    'rank'              => $ip_restriction['rank'],
                    'ip_restriction_id' => $restriction->id,
                ]);
            }

            $restriction->users()->detach();
            $restriction->roles()->detach();

            if ($data['entity'] == 'user') {
                if (isset($data['users'])) {
                    $restriction->users()->sync($data['users']);
                }
            }
            if ($data['entity'] == 'role') {
                if (isset($data['roles'])) {
                    $restriction->roles()->sync($data['roles']);
                }
            }

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
            $restrictions = IpRestriction::with('users', 'roles', 'billingCompany', 'ipRestrictionMults')
                                         ->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        } else {
            $restrictions = IpRestriction::with('users', 'roles', 'billingCompany', 'ipRestrictionMults')
                                        ->where('billing_company_id', $bC)
                                        ->orderBy("created_at", "desc")->orderBy("id", "asc")->get();
        }
        return !is_null($restrictions) ? $restrictions : null;
    }

    public function getServerAllRestrictions() {
        $sortBy   = $request->sortBy ?? 'id';
        $sortDesc = $request->sortDesc ?? false;
        $page = $request->page ?? 1;
        $itemsPerPage = $request->itemsPerPage ?? 5;
        $search = $request->search ?? '';

        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $records = IpRestriction::with('users', 'roles', 'billingCompany', 'ipRestrictionMults')
                                         ->orderBy("created_at", "desc")->orderBy("id", "asc")->paginate($itemsPerPage);
        } else {
            $records = IpRestriction::with('users', 'roles', 'billingCompany', 'ipRestrictionMults')
                                        ->where('billing_company_id', $bC)
                                        ->orderBy("created_at", "desc")->orderBy("id", "asc")->paginate($itemsPerPage);
        }
        
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

    public function getOneRestriction(int $id) {
        return IpRestriction::with('users', 'roles', 'billingCompany', 'ipRestrictionMults')->find($id);
    }

    public function destroy(int $id)
    {
        try {
            DB::beginTransaction();
            $restriction = IpRestriction::find($id);
            $restriction->IpRestrictionMults()->delete();
            $restriction->users()->detach();
            $restriction->roles()->detach();
            $restriction->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
        return true;
    }
}

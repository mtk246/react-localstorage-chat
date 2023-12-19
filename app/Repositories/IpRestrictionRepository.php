<?php

namespace App\Repositories;

use App\Models\BillingCompany;
use App\Models\IpRestriction;
use App\Models\IpRestrictionMult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IpRestrictionRepository
{
    /**
     * @return ipRestriction|Model|null
     */
    public function create(array $data)
    {
        try {
            DB::beginTransaction();

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()?->billingCompanies->first();
            }

            $restriction = IpRestriction::create([
                'entity' => $data['entity'],
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ]);

            foreach ($data['ip_restriction_mults'] as $ip_restriction) {
                IpRestrictionMult::create([
                    'ip_beginning' => $ip_restriction['ip_beginning'],
                    'ip_finish' => $ip_restriction['ip_finish'],
                    'rank' => $ip_restriction['rank'],
                    'ip_restriction_id' => $restriction->id,
                ]);
            }

            if ('user' == $data['entity']) {
                if (isset($data['users'])) {
                    $restriction->users()->sync($data['users']);
                }
            }
            if ('role' == $data['entity']) {
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

    public function update(array $data, int $id)
    {
        try {
            DB::beginTransaction();

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'];
            } else {
                $billingCompany = auth()->user()?->billingCompanies->first();
            }

            $restriction = IpRestriction::find($id);

            $restriction->update([
                'entity' => $data['entity'],
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
            ]);

            $restriction->IpRestrictionMults()->delete();

            foreach ($data['ip_restriction_mults'] as $ip_restriction) {
                IpRestrictionMult::create([
                    'ip_beginning' => $ip_restriction['ip_beginning'],
                    'ip_finish' => $ip_restriction['ip_finish'],
                    'rank' => $ip_restriction['rank'],
                    'ip_restriction_id' => $restriction->id,
                ]);
            }

            $restriction->users()->detach();
            $restriction->roles()->detach();

            if ('user' == $data['entity']) {
                if (isset($data['users'])) {
                    $restriction->users()->sync($data['users']);
                }
            }
            if ('role' == $data['entity']) {
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

    public function getAllRestrictions()
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $restrictions = IpRestriction::with('users', 'roles', 'billingCompany', 'ipRestrictionMults')
                                         ->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        } else {
            $restrictions = IpRestriction::with('users', 'roles', 'billingCompany', 'ipRestrictionMults')
                                        ->where('billing_company_id', $bC)
                                        ->orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
        }

        return !is_null($restrictions) ? $restrictions : null;
    }

    public function getServerAllRestrictions(Request $request)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = IpRestriction::with('users', 'roles', 'billingCompany', 'ipRestrictionMults');
        } else {
            $data = IpRestriction::with('users', 'roles', 'billingCompany', 'ipRestrictionMults')
                                        ->where('billing_company_id', $bC);
        }

        if (!empty($request->query('query')) && '{}' !== $request->query('query')) {
            $data = $data->search($request->query('query'));
        }

        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'entity')) {
                $data = $data->orderBy('entity', (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } elseif (str_contains($request->sortBy, 'billingcompany')) {
                $data = $data->orderBy(
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'ip_restrictions.billing_company_id'), (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } else {
                $data = $data->orderBy($request->sortBy, (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            }
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

    public function getOneRestriction(int $id)
    {
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

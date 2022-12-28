<?php

namespace App\Repositories;

use App\Models\ClaimSubStatus;
use App\Models\ClaimStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ClaimSubStatusRepository
{
    /**
     * @param array $data
     * @return ClaimSubStatus|Model
     */
    public function createClaimSubStatus(array $data) {
        try {
            DB::beginTransaction();
            $claimSubStatus = ClaimSubStatus::create([
                "code"        => $data["code"],
                "name"        => $data["name"],
                "description" => $data["description"]
            ]);
            
            if (isset($data['claim_statuses'])) {
                $claimSubStatus->claimStatuses()->sync($data['claim_statuses']);
            }

            if (auth()->user()->hasRole('superuser')) {
                if (isset($data['specific_billing_company']) && isset($data['billing_companies'])) {
                    $claimSubStatus->billingCompanies()->sync($data['billing_companies']);
                }
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
                $claimSubStatus->billingCompanies()->attach($billingCompany->id);
            }

            DB::commit();
            return $claimSubStatus;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    
    public function getList() {
        try {
            return getList(ClaimSubStatus::class);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListStatus() {
        try {
            return getList(ClaimStatus::class, ['status']);
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getServerAll(Request $request) {
        $data = ClaimSubStatus::with([
            "billingCompanies", "claimStatuses"
        ]);
        if (!empty($request->query('query')) && $request->query('query')!=="{}") {
            $data = $data->search($request->query('query'));
        }
        
        if ($request->sortBy) {
            $data = $data->orderBy($request->sortBy, (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
        } else {
            $data = $data->orderBy("created_at", "desc")->orderBy("id", "asc");
        }

        $data = $data->paginate($request->itemsPerPage ?? 5);

        return response()->json([
            'data'          => $data->items(),
            'numberOfPages' => $data->lastPage(),
            'count'         => $data->total()
        ], 200);
    }

    /**
     * @param int $id
     * @return ClaimSubStatus|Builder|Model|object|null
     */
    public function getOneClaimSubStatus(int $id) {
        $claimSubStatus = ClaimSubStatus::whereId($id)->with([
                "billingCompanies", "claimStatuses"
            ])->first();

        return !is_null($claimSubStatus) ? $claimSubStatus : null;
    }

    /**
     * @param string $name
     * @return ClaimSubStatus|Builder|Model|object|null
     */
    public function getByName(string $name) {
        $claimSubStatus = ClaimSubStatus::whereName($name)->with([
                "billingCompanies", "claimStatuses"
            ])->first();

        return !is_null($claimSubStatus) ? $claimSubStatus : null;
    }

    /**
     * @param array $data
     * @param int $id
     * @return ClaimSubStatus|Builder|Model|object|null
     */
    public function updateClaimSubStatus(array $data, int $id) {
        try {
            DB::beginTransaction();
            $claimSubStatus = ClaimSubStatus::find($id);

            $claimSubStatus->update([
                "name"        => $data["name"],
                "description" => $data["description"]
            ]);

            if (isset($data['claim_statuses'])) {
                $claimSubStatus->claimStatuses()->sync($data['claim_statuses']);
            }

            if (auth()->user()->hasRole('superuser')) {
                if (isset($data['specific_billing_company']) && isset($data['billing_companies'])) {
                    $claimSubStatus->billingCompanies()->sync($data['billing_companies']);
                }
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
                $claimSubStatus->billingCompanies()->attach($billingCompany->id);
            }

            DB::commit();
            return ClaimSubStatus::whereId($id)->with([
                "billingCompanies", "claimStatuses"
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
        $billingCompany = auth()->user()->billingCompanies->first();
        if (is_null($billingCompany)) return null;
        
        $claimSubStatus = ClaimSubStatus::find($id);
        if (is_null($claimSubStatus->billingCompanies()->find($billingCompany->id))) {
            $claimSubStatus->billingCompanies()->attach($billingCompany->id);
            return $claimSubStatus;
        } else {
            return $claimSubStatus->billingCompanies()->updateExistingPivot($billingCompany->id, [
                'status' => $status,
            ]);
        }
    }
}

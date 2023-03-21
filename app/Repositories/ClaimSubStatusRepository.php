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

    
    public function getList($status_id, $id = null, $current_id = null) {
        try {
            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $id;
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }
            /**return getList(ClaimSubStatus::class, 'name', ['relationship' => 'billingCompanies', 'where' => ['billing_company_id' => $billingCompany->id ?? $billingCompany]]);*/
            return getList(ClaimSubStatus::class, 'name', ['relationship' => 'claimStatuses', 'where' => ['claim_status_id' => $status_id]], array($current_id));
        } catch (\Exception $e) {
            return [];
        }
    }

    public function getListStatus(array $data) {
        try {
            if (isset($data['current_id'])) {
                $current = ClaimStatus::whereId($data['current_id'])->first();
                if (isset($current) && $current->status == 'Draft') {
                    $nextStatuses = ClaimStatus::where('status', 'Verified - Not submitted');
                } else if (isset($current) && $current->status == 'Verified - Not submitted') {
                    $nextStatuses = ClaimStatus::where('status', 'Submitted')
                        ->orWhere('status', 'Draft');
                } else if (isset($current) && $current->status == 'Submitted') {
                    $nextStatuses = ClaimStatus::where('status', 'Approved')
                        ->orWhere('status', 'Rejected')
                        ->orWhere('status', 'Denied');
                } else if (isset($current) && ($current->status == 'Approved' || $current->status == 'Denied')) {
                    $nextStatuses = ClaimStatus::where('status', 'Complete');
                } else if (isset($current) && $current->status == 'Rejected') {
                    $nextStatuses = ClaimStatus::where('status', 'Draft');
                }
                $nextStatuses = $nextStatuses->get()->pluck('id')->toArray();
                return ClaimStatus::query()->select('id', 'status as name', 'background_color')
                    ->whereIn('id', $nextStatuses)->get()->toArray();
            } else {
                return getList(ClaimStatus::class, ['status'], [], null, ['background_color']);
            }
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

        $data = $data->paginate($request->itemsPerPage ?? 10);

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

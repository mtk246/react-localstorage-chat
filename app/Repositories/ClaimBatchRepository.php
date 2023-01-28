<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Models\Claim;
use App\Models\ClaimBatch;
use App\Models\ClaimStatus;

class ClaimBatchRepository
{
    /**
     * @param array $data
     * @return claim|Model
     */
    public function createBatch(array $data) {
        try {
            DB::beginTransaction();
            $status = 'Not submitted';

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"] ?? null;
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            if (isset($data["send"])) {
                $status = ($data["send"] == true) ? 'Submitted' : 'Not submitted';
            }

            $claimBatch = ClaimBatch::create([
                "code"               => generateNewCode(getPrefix($data["name"]), 5, date("y"), ClaimBatch::class, "code"),
                "name"               => $data["name"],
                "status"             => $status,
                "shipping_date"      => ($status == 'Not submitted') ? null : now(),
                "claims_reconciled"  => $data["claims_reconciled"] ?? false,
                "fake_transmission"  => $data["fake_transmission"] ?? false,
                "company_id"         => $data["company_id"],
                "billing_company_id" => $billingCompany->id ?? $billingCompany,
            ]);

            if (isset($data['claim_ids'])) {
                $claimBatch->claims()->sync($data['claim_ids']);
            }

            DB::commit();
            return $claimBatch;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    /**
     * @return claim[]|Collection
     */
    public function getServerAllClaims(Request $request) {
        $status = ClaimStatus::where("status", "Verified - Not submitted")->first();

        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = Claim::whereHas("claimStatusClaims", function ($query) use ($status) {
                $query->where('claim_status_type', ClaimStatus::class)->where("claim_status_id", $status->id);
            })->with([
                "company" => function ($query) {
                    $query->with('nicknames');
                },
                "patient" => function ($query) {
                    $query->with([
                        "user" => function ($q) {
                            $q->with(["profile", "addresses", "contacts"]);
                        }
                    ]);
                }
            ]);
        } else {
            $data = Claim::whereHas("claimStatusClaims", function ($query) use ($status) {
                $query->where('claim_status_type', ClaimStatus::class)->where("claim_status_id", $status->id);
            })->with([
                "company" => function ($query) {
                    $query->with([
                        "nicknames" => function ($q) use ($bC) {
                            $q->where('billing_company_id', $bC);
                        }
                    ]);
                },
                "patient" => function ($query) use ($bC) {
                    $query->with([
                        "user" => function ($q) use ($bC) {
                            $q->with([
                                "profile",
                                "addresses" => function ($qq) use ($bC) {
                                    $qq->where('billing_company_id', $bC);
                                },
                                "contacts" => function ($qq) use ($bC) {
                                    $qq->where('billing_company_id', $bC);
                                },
                            ]);
                        }
                    ]);
                }
            ]);
        }
        if ($request->filterBy) {
            if ($request->billing_company_id) {
                $data = $data->whereHas("company", function ($query) use ($request) {
                    $query->whereHas("billingCompanies", function ($q) use ($request) {
                        $q->where('billing_company_id', $request->billing_company_id);
                    });    
                });
            }
            if ($request->company_id) {
                $data = $data->where('company_id', $request->company_id);
            }
        }

        if (!empty($request->query('query')) && $request->query('query')!=="{}") {
            $data = $data->search($request->query('query'));
        }
        
        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'billingcompany')) {
                $data = $data->orderBy(
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'company.billing_company_id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } else {
                $data = $data->orderBy($request->sortBy, (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            }
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
     * @return claim|Builder|Model|object|null
     */
    public function getOneBatch(int $id) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $claimBatch = ClaimBatch::with([
                "company" => function ($query) {
                    $query->with('nicknames');
                },
                "claims" => function ($query) {
                    $query->with([
                        "insuranceCompany" => function ($query) {
                            $query->with('nicknames');
                        },
                        "patient" => function ($query) {
                            $query->with([
                                "user" => function ($q) {
                                    $q->with("profile");
                                }
                            ]);
                        }
                    ]);
                },
                "billingCompany"
            ])->whereId($id)->first();
        } else {
            $claimBatch = ClaimBatch::with([
                "company" => function ($query) use ($bC) {
                    $query->with([
                        "nicknames" => function ($q) use ($bC) {
                            $q->where('billing_company_id', $bC);
                        }
                    ]);
                },
                "claims" => function ($query) use ($bC) {
                    $query->with([
                        "insuranceCompany" => function ($query) use ($bC){
                            $query->with([
                                "nicknames" => function ($q) use ($bC) {
                                    $q->where('billing_company_id', $bC);
                                }
                            ]);
                        },
                        "patient" => function ($query) use ($bC) {
                            $query->with([
                                "user" => function ($q) use ($bC) {
                                    $q->with([
                                        "profile"
                                    ]);
                                }
                            ]);
                        }
                    ]);
                }
            ])->whereId($id)->first();
        }
        if (isset($claimBatch)) {
            $record = [
                "id" => $claimBatch->id,
                "code" => $claimBatch->code,
                "name" => $claimBatch->name,
                "status" => $claimBatch->status,
                "shipping_date" => $claimBatch->shipping_date,
                "fake_transmission" => $claimBatch->fake_transmission,
                "company_id" => $claimBatch->company_id,
                "billing_company_id" => $claimBatch->billing_company_id,
                "created_at" => $claimBatch->created_at,
                "updated_at" => $claimBatch->updated_at,
                "claims_reconciled" => $claimBatch->claims_reconciled,
                "total_processed" => $claimBatch->total_processed,
                "claim_ids" => $claimBatch->claim_ids,
                "total_claims" => $claimBatch->total_claims,
                "total_accepted" => $claimBatch->total_accepted,
                "total_denied" => $claimBatch->total_denied,
                "total_accepted_by_clearing_house" => $claimBatch->total_accepted_by_clearing_house,
                "total_denied_by_clearing_house" => $claimBatch->total_denied_by_clearing_house,
                "total_accepted_by_payer" => $claimBatch->total_accepted_by_payer,
                "total_denied_by_payer" => $claimBatch->total_denied_by_payer,
                "company" => $claimBatch->company,
                "claims" => $claimBatch->claims,
                "billing_company" => [
                    "id" => $claimBatch->billingCompany->id,
                    "name" => $claimBatch->billingCompany->name,
                    "created_at" => $claimBatch->billingCompany->created_at,
                    "updated_at" => $claimBatch->billingCompany->updated_at,
                    "code" => $claimBatch->billingCompany->code,
                    "status" => $claimBatch->billingCompany->status,
                    "logo" => $claimBatch->billingCompany->logo,
                    "abbreviation" => $claimBatch->billingCompany->abbreviation,
                ]
            ];
        };

        return !is_null($record) ? $record : null;
    }

    /**
     * @return claim[]|Collection
     */
    public function getServerAll(Request $request) {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = ClaimBatch::with([
                "company" => function ($query) {
                    $query->with('nicknames');
                },
                "claims"
            ]);
        } else {
            $data = ClaimBatch::with([
                "company" => function ($query) use ($bC) {
                    $query->with([
                        "nicknames" => function ($q) use ($bC) {
                            $q->where('billing_company_id', $bC);
                        }
                    ]);
                },
                "claims"
            ]);
        }

        if (!empty($request->query('query')) && $request->query('query')!=="{}") {
            $data = $data->search($request->query('query'));
        }
        
        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'billingcompany')) {
                $data = $data->orderBy(
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'company.billing_company_id'), (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } else {
                $data = $data->orderBy($request->sortBy, (bool)(json_decode($request->sortDesc)) ? 'desc' : 'asc');
            }
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
     * @param array $data
     * @param int $id
     * @return claim|Builder|Model|object|null
     */
    public function updateBatch(array $data, int $id) {
        try {
            DB::beginTransaction();
            $status = 'Not submitted';

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data["billing_company_id"] ?? null;
            } else {
                $billingCompany = auth()->user()->billingCompanies->first();
            }

            if (isset($data["send"])) {
                $status = ($data["send"] == true) ? 'Submitted' : 'Not submitted';
            }

            $claimBatch = ClaimBatch::find($id);

            $claimBatch->update([
                "name"               => $data["name"],
                "status"             => $status,
                "shipping_date"      => ($status == 'Not submitted') ? null : now(),
                "claims_reconciled"  => $data["claims_reconciled"] ?? false,
                "fake_transmission"  => $data["fake_transmission"] ?? false,
                "company_id"         => $data["company_id"],
                "billing_company_id" => $billingCompany->id ?? $billingCompany,
            ]);

            if (isset($data['claim_ids'])) {
                $claimBatch->claims()->sync($data['claim_ids']);
            }

            DB::commit();
            return $claimBatch;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }

    /**
     * @param int $id
     * @return claim|Builder|Model|object|null
     */
    public function deleteBatch(int $id) {
        try {
            $claimBatch = ClaimBatch::find($id);
            $claimBatch->claims()->detach();
            $claimBatch->delete();
            return !is_null($claimBatch) ? $claimBatch : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param int $id
     * @return claim|Builder|Model|object|null
     */
    public function submitToClearingHouse(int $id) {
        try {
            DB::beginTransaction();

            $claimBatch = ClaimBatch::find($id);
            $claimBatch->update([
                "status"             => 'Submitted',
                "shipping_date"      => now(),
            ]);

            DB::commit();
            return $claimBatch;
        } catch (\Exception $e) {
            DB::rollBack();
            return null;
        }
    }
}

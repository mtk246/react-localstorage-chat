<?php

namespace App\Repositories;

use App\Http\Resources\Claim\Batch\ClaimBatchBodyResource;
use App\Http\Resources\Claim\BatchClaimBodyResource;
use App\Http\Resources\Claim\ClaimBodyResource;
use App\Models\Billingcompany;
use App\Models\Claims\Claim;
use App\Models\Claims\ClaimBatch;
use App\Models\Claims\ClaimBatchStatus;
use App\Models\Claims\ClaimStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ClaimBatchRepository
{
    /**
     * @return claim|Model
     */
    public function createBatch(array $data)
    {
        try {
            DB::beginTransaction();
            $claimBatchSubmitted = ClaimBatchStatus::whereStatus('Submitted')->first();
            $claimBatchNotSubmitted = ClaimBatchStatus::whereStatus('Not submitted')->first();

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'] ?? null;
            } else {
                $billingCompany = auth()->user()?->billingCompanies->first();
            }

            $status = (isset($data['send']) && true == $data['send']) ? $claimBatchSubmitted : $claimBatchNotSubmitted;

            $claimBatch = ClaimBatch::create([
                'code' => generateNewCode(getPrefix($data['name']), 5, date('Y'), ClaimBatch::class, 'code'),
                'name' => $data['name'],
                'claim_batch_status_id' => $status->id,
                'shipping_date' => ('Not submitted' == $status->status) ? null : now(),
                'claims_reconciled' => $data['claims_reconciled'] ?? false,
                'fake_transmission' => $data['fake_transmission'] ?? false,
                'company_id' => $data['company_id'],
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
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
    public function getServerAllClaims(Request $request)
    {
        $status = ClaimStatus::query()
            ->where('status', 'Not submitted')
            ->toBase()
            ->first();
        $batchStatus = ClaimBatchStatus::query()
            ->where('status','Not submitted')
            ->toBase()
            ->first();

        $claimsQuery = Claim::query()
            ->whereHas('claimStatusClaims', function ($query) use ($status) {
                $query->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                    ->where('claim_status_claim.claim_status_id', $status->id)
                    ->whereRaw('claim_status_claim.created_at = (SELECT MAX(created_at) FROM claim_status_claim WHERE claim_status_claim.claim_id = claims.id)');
            })
            ->where(function ($query) use ($batchStatus) {
                $query->whereDoesntHave('claimBatchs')
                ->orWhereHas('claimBatchs', function ($query) use ($batchStatus) {
                    $query
                        ->whereRaw('claim_claim_batch.created_at = (SELECT MAX(created_at) FROM claim_claim_batch WHERE claim_claim_batch.claim_id = claims.id)')
                        ->where('claim_batch_status_id', '<>', $batchStatus?->id);
                });
            })
            ->when(
                Gate::denies('is-admin'),
                fn ($query) => $query->where('billing_company_id', $request->user()->billing_company_id),
            )
            ->when(
                !empty($request->query('query')) && '{}' !== $request->query('query'),
                fn ($query) => $query->search($request->query('query')),
            )
            ->when(
                !empty($request->billing_company_id),
                fn ($query) => $query->whereHas('demographicInformation', function ($query) use ($request) {
                    $query->whereHas('company', function ($query) use ($request) {
                        $query->whereHas('billingCompanies', function ($q) use ($request) {
                            $q->where('billing_company_id', $request->billing_company_id);
                        });
                    });
                }),
            )
            ->when(
                !empty($request->company_id),
                fn ($query) => $query->whereHas('demographicInformation', function ($query) use ($request) {
                    $query->where('company_id', $request->company_id);
                }),
            )
            ->with('demographicInformation', 'service', 'insurancePolicies');
            //->orderBy(Pagination::sortBy(), Pagination::sortDesc(true))
            //->paginate(Pagination::itemsPerPage());

        return ClaimBodyResource::collection($claimsQuery->get());

        $data = [
            'data' => ClaimBodyResource::collection($claimsQuery->items()),
            'numberOfPages' => $claimsQuery->lastPage(),
            'count' => $claimsQuery->total(),
        ];

        return $data;
    }

    /**
     * @return claim|Builder|Model|object|null
     */
    public function getOneBatch(int $id)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $claimBatch = ClaimBatch::with([
                'company' => function ($query) {
                    $query->with('nicknames');
                },
                'claims',
                'billingCompany',
            ])->whereId($id)->first();
        } else {
            $claimBatch = ClaimBatch::with([
                'company' => function ($query) use ($bC) {
                    $query->with([
                        'nicknames' => function ($q) use ($bC) {
                            $q->where('billing_company_id', $bC);
                        },
                    ]);
                },
                'claims',
                'billingCompany',
            ])->whereId($id)->first();
        }
        if (isset($claimBatch)) {
            $claims = [];
            foreach ($claimBatch->claims as $key => $claim) {
                $claims[$key] = new BatchClaimBodyResource(
                    $claim->load(['demographicInformation', 'service', 'insurancePolicies']),
                    $claimBatch->id
                );
            }

            $record = [
                'id' => $claimBatch->id,
                'code' => $claimBatch->code,
                'name' => $claimBatch->name,
                'type' => $claimBatch->claims->first()?->type->value,
                'claim_type' => upperCaseWords($claimBatch->claims->first()?->type->getName()),
                'claim_batch_status' => $claimBatch->claimBatchStatus,
                'claim_batch_status_id' => $claimBatch->claim_batch_status_id,
                'shipping_date' => $claimBatch->shipping_date,
                'fake_transmission' => $claimBatch->fake_transmission,
                'company_id' => $claimBatch->company_id,
                'billing_company_id' => $claimBatch->billing_company_id,
                'created_at' => $claimBatch->created_at,
                'updated_at' => $claimBatch->updated_at,
                'last_modified' => $claimBatch->last_modified,
                'claims_reconciled' => $claimBatch->claims_reconciled,
                'total_processed' => $claimBatch->total_processed,
                'claim_ids' => $claimBatch->claim_ids,
                'total_claims' => $claimBatch->total_claims,
                'total_accepted' => $claimBatch->total_accepted,
                'total_denied' => $claimBatch->total_denied,
                'total_accepted_by_clearing_house' => $claimBatch->total_accepted_by_clearing_house,
                'total_denied_by_clearing_house' => $claimBatch->total_denied_by_clearing_house,
                'total_accepted_by_payer' => $claimBatch->total_accepted_by_payer,
                'total_denied_by_payer' => $claimBatch->total_denied_by_payer,
                'company' => isset($claimBatch->company)
                    ? [
                        'id' => $claimBatch->company->id,
                        'npi' => $claimBatch->company->npi,
                        'name' => $claimBatch->company->name,
                        'abbreviation' => $claimBatch->company
                            ->abbreviations()
                            ->where('billing_company_id', $claimBatch->billing_company_id)
                            ->first()?->abbreviation ?? '',
                    ]: null,
                'claims' => $claims,
                'billing_company' => [
                    'id' => $claimBatch->billingCompany->id,
                    'name' => $claimBatch->billingCompany->name,
                    'created_at' => $claimBatch->billingCompany->created_at,
                    'updated_at' => $claimBatch->billingCompany->updated_at,
                    'code' => $claimBatch->billingCompany->code,
                    'status' => $claimBatch->billingCompany->status,
                    'logo' => $claimBatch->billingCompany->logo,
                    'abbreviation' => $claimBatch->billingCompany->abbreviation,
                ],
            ];
        }

        return !is_null($record) ? $record : null;
    }

    /**
     * @return claim[]|Collection
     */
    public function getServerAll(Request $request)
    {
        $bC = auth()->user()->billing_company_id ?? null;
        if (!$bC) {
            $data = ClaimBatch::with([
                'company' => function ($query) {
                    $query->with('nicknames');
                },
                'claims',
                'claimBatchStatus',
            ]);
        } else {
            $data = ClaimBatch::query()
                ->where('billing_company_id', $bC)
                ->with([
                    'company' => function ($query) use ($bC) {
                        $query->with([
                            'nicknames' => function ($q) use ($bC) {
                                $q->where('billing_company_id', $bC);
                            },
                        ]);
                    },
                    'claims',
                    'claimBatchStatus',
                ]);
        }

        if (!empty($request->query('query')) && '{}' !== $request->query('query')) {
            $data = $data->search($request->query('query'));
        }

        if ($request->sortBy) {
            if (str_contains($request->sortBy, 'billingcompany')) {
                $data = $data->orderBy(
                    BillingCompany::select('name')->whereColumn('billing_companies.id', 'company.billing_company_id'), (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            } else {
                $data = $data->orderBy($request->sortBy, (bool) (json_decode($request->sortDesc)) ? 'desc' : 'asc');
            }
        } else {
            $data = $data->orderBy('created_at', 'desc')->orderBy('id', 'asc');
        }

        $data = $data->paginate($request->itemsPerPage ?? 10);

        return response()->json([
            'data' => ClaimBatchBodyResource::collection($data->items()),
            'numberOfPages' => $data->lastPage(),
            'count' => $data->total(),
        ], 200);
    }

    /**
     * @return claim|Builder|Model|object|null
     */
    public function updateBatch(array $data, int $id)
    {
        try {
            DB::beginTransaction();
            $claimBatchSubmitted = ClaimBatchStatus::whereStatus('Submitted')->first();
            $claimBatchNotSubmitted = ClaimBatchStatus::whereStatus('Not submitted')->first();

            if (auth()->user()->hasRole('superuser')) {
                $billingCompany = $data['billing_company_id'] ?? null;
            } else {
                $billingCompany = auth()->user()?->billingCompanies->first();
            }

            if (isset($data['send'])) {
                $status = (true == $data['send']) ? $claimBatchSubmitted : $claimBatchNotSubmitted;
            }

            $claimBatch = ClaimBatch::find($id);

            $claimBatch->update([
                'name' => $data['name'],
                'claim_status_id' => $status->id,
                'shipping_date' => ('Not submitted' == $status->status) ? null : now(),
                'claims_reconciled' => $data['claims_reconciled'] ?? false,
                'fake_transmission' => $data['fake_transmission'] ?? false,
                'company_id' => $data['company_id'],
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
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
     * @return claim|Builder|Model|object|null
     */
    public function deleteBatch(int $id)
    {
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
     * @return claim|Builder|Model|object|null
     */
    public function submitToClearingHouse($token, int $id)
    {
        try {
            DB::beginTransaction();

            $claimRepository = new ClaimRepository();
            $claimBatch = ClaimBatch::find($id);
            $claimBatchStatus = ClaimBatchStatus::whereStatus('Submitted')->first();
            $claimBatch->update([
                'claim_batch_status_id' => $claimBatchStatus->id,
                'shipping_date' => now(),
            ]);
            foreach ($claimBatch->claims as $claim) {
                $claimRepository->claimSubmit($token, $claim->id, $claimBatch->id);
            }

            DB::commit();

            return $claimBatch;
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }
}

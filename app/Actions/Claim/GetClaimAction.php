<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Facades\Pagination;
use App\Http\Resources\Claim\ClaimBodyResource;
use App\Models\Claims\Claim;
use App\Models\Claims\ClaimStatus;
use App\Models\Claims\ClaimSubStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

final class GetClaimAction
{
    public function single(Claim $claim): ClaimBodyResource
    {
        return ClaimBodyResource::make($claim);
    }

    public function all(Request $request)
    {
        $status = ((is_array($request->status))
            ? $request->status
            : json_decode($request->status ?? '[]'));

        $subStatus = ((is_array($request->substatus))
            ? $request->substatus
            : json_decode($request->substatus ?? '[]'));

        $claimsQuery = Claim::query()
            ->when(count($status) > 0, function ($query) use ($status) {
                $query->whereHas('claimStatusClaims', function ($query) use ($status) {
                    $query
                        ->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                        ->whereIn('claim_status_claim.claim_status_id', $status)
                        ->whereRaw('claim_status_claim.created_at = (SELECT MAX(created_at) FROM claim_status_claim WHERE claim_status_claim.claim_id = claims.id)');
                });
            })
            ->when(count($subStatus) > 0, function ($query) use ($subStatus) {
                $query->whereHas('claimStatusClaims', function ($query) use ($subStatus) {
                    $query
                        ->where('claim_status_claim.claim_status_type', ClaimSubStatus::class)
                        ->whereIn('claim_status_claim.claim_status_id', $subStatus)
                        ->whereRaw('claim_status_claim.created_at = (SELECT MAX(created_at) FROM claim_status_claim WHERE claim_status_claim.claim_id = claims.id)');
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
                !empty($request->patient_id),
                fn ($query) => $query->whereHas('demographicInformation', function ($query) use ($request) {
                    $query->where('patient_id', $request->patient_id);
                }),
            )
            ->with('demographicInformation', 'service', 'insurancePolicies', 'denialTrackings')
            ->orderBy(Pagination::sortBy(), Pagination::sortDesc())
            ->paginate(Pagination::itemsPerPage());

        $data = [
            'data' => ClaimBodyResource::collection($claimsQuery->items()),
            'numberOfPages' => $claimsQuery->lastPage(),
            'count' => $claimsQuery->total(),
        ];

        return $data;
    }
}

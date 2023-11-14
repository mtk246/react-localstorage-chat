<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Facades\Pagination;
use App\Http\Resources\Claim\ClaimBodyResource;
use App\Http\Resources\Claim\DenialBodyResource;
use App\Models\Claims\Claim;
use Illuminate\Http\Request;

final class GetDenialAction
{
    public function single(Claim $claim): DenialBodyResource
    {
        $claim->load('denialTrackings');

        return DenialBodyResource::make($claim);
    }

    public function all(Claim $claim, Request $request, $status, $subStatus)
    {
        $query = $claim->query();

        if ($status || $subStatus) {
            if ($status) {
                $query->whereHas('status', function ($statusQuery) use ($status) {
                    $statusQuery->whereIn('claim_statuses.id', $status);
                });
            }

            if ($subStatus) {
                $query->orWhereHas('subStatus', function ($subStatusQuery) use ($subStatus) {
                    $subStatusQuery->whereIn('claim_sub_statuses.id', $subStatus);
                });
            }
        }

        if ($request->user()->isAdmin()) {
            $query->where('billing_company_id', $request->user()->billing_company_id);
        }

        $query->with('demographicInformation', 'service', 'insurancePolicies', 'denialTrackings', 'claimTransmissionResponses')
            ->orderBy(Pagination::sortBy(), Pagination::sortDesc());

        $claimsQuery = $query->paginate(Pagination::itemsPerPage());

        $data = [
            'data' => ClaimBodyResource::collection($claimsQuery->items()),
            'numberOfPages' => $claimsQuery->lastPage(),
            'count' => $claimsQuery->total(),
        ];

        return $data;
    }
}

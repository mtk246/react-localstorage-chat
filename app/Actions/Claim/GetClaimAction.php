<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Facades\Pagination;
use App\Http\Resources\Claim\ClaimBodyResource;
use App\Models\Claims\Claim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

final class GetClaimAction
{
    public function single(Claim $claim): ClaimBodyResource
    {
        return ClaimBodyResource::make($claim);
    }

    public function all(Claim $claim, Request $request)
    {
        $claimsQuery = $claim->query()
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

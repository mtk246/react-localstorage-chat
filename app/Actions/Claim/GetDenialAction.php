<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Facades\Pagination;
use App\Http\Casts\Claims\DenialTrackingWrapper;
use App\Http\Resources\Claim\DenialBodyResource;
use App\Models\Claims\Claim;
use App\Models\Claims\ClaimStatus;
use App\Models\Claims\DenialTracking;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Meilisearch\Endpoints\Indexes;

final class GetDenialAction
{
    public function single(Claim $claim): DenialBodyResource
    {
        $claim->load('denialTrackings');

        return DenialBodyResource::make($claim);
    }

    public function all(Claim $claim, Request $request, $status, $subStatus)
    {
        $claimsQuery = Claim::when(count($status) > 0, function ($query) use ($status) {
            $query->whereHas('claimStatusClaims', function ($query) use ($status) {
                $query
                    ->where('claim_status_claim.claim_status_type', ClaimStatus::class)
                    ->whereIn('claim_status_claim.claim_status_id', $status)
                    ->whereRaw('claim_status_claim.created_at = (SELECT MAX(created_at) FROM claim_status_claim WHERE claim_status_claim.claim_id = claims.id)');
            });
        })
            ->search(
                $request->query('query', ''),
                function (Indexes $searchEngine, string $query, array $options) use ($request, $status) {
                    $config = config('scout.meilisearch.index-settings.'.Claim::class);

                    if (isset($request->sortBy) && in_array($request->sortBy, $config['sortableAttributes'])) {
                        $options['sort'] = [$request->sortBy.':'.Pagination::sortDesc()];
                    }

                    if (isset($request->filter)) {
                        $options['filter'] = $request->filter;
                    }

                    if (isset($request->status)) {
                        $statusFilter = is_array($request->status) ? $request->status : [$request->status];
                        $options['filter'] = [];

                        foreach ($statusFilter as $status) {
                            $options['filter'][] = 'status:'.$status;
                        }
                    }

                    return $searchEngine->search($query, $options);
                }
            )
            ->when(
                Gate::denies('is-admin'),
                fn ($query) => $query->where('billing_company_id', $request->user()->billing_company_id),
            )
            ->paginate(Pagination::itemsPerPage());

        $data = [
            'data' => DenialBodyResource::collection(
                collect($claimsQuery->items())->reject(function ($item) {
                    $status = (new DenialBodyResource($item))->getStatus();

                    return 1 === $status->id || 2 === $status->id || 7 === $status->id;
                })
            ),
            'numberOfPages' => $claimsQuery->lastPage(),
            'count' => $claimsQuery->total(),
        ];

        return $data;
    }

    public function createDenialTracking(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), $this->validateDenialTrackingWrapper());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $claim = Claim::find($request->input('claim_id'));

        if (!$claim) {
            return response()->json(__('Claim ID not found'), 400);
        }

        $note = $claim->setStates(
            $request->input('claim_status'),
            $request->input('claim_sub_status'),
            $request->input('tracking_note'),
        );

        $denialTrackingWrapper = new DenialTrackingWrapper($request->all());

        $trackingData = $denialTrackingWrapper->getData()['denial_tracking_data'];
        $trackingData['private_note_id'] = $note->id;

        if (isset($note)) {
            $tracking = DenialTracking::createDenialTracking($trackingData);
        }

        return $tracking ? response()->json($tracking, 201) : response()->json(__('Error creating denial tracking'), 400);
    }

    public function updateDenialTracking(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), $this->validateDenialTrackingWrapper());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $claim = Claim::find($request->input('claim_id'));

        if (!$claim) {
            return response()->json(__('Claim ID not found'), 400);
        }

        $note = $claim->setStates(
            $request->input('claim_status'),
            $request->input('claim_sub_status'),
            $request->input('tracking_note'),
        );

        $denialTrackingWrapper = new DenialTrackingWrapper($request->all());

        $trackingData = $denialTrackingWrapper->getData()['denial_tracking_data'];
        $trackingData['private_note_id'] = $note->id;

        $tracking = DenialTracking::updateDenialTracking($trackingData);

        return $tracking ? response()->json($tracking) : response()->json(__('Error updating denial tracking'), 400);
    }

    private function validateDenialTrackingWrapper(): array
    {
        $validationRules = [
            'denial_id' => 'nullable',
            'interface_type' => 'required',
            'is_reprocess_claim' => 'required|boolean',
            'is_contact_to_patient' => 'required|boolean',
            'contact_through' => 'required_if:is_contact_to_patient,true',
            'claim_id' => 'required|numeric',
            'claim_number' => 'required|string',
            'rep_name' => 'required|string',
            'ref_number' => 'nullable|string',
            'claim_status' => 'required|numeric',
            'claim_sub_status' => 'nullable|numeric',
            'tracking_date' => 'required|date',
            'resolution_time' => 'nullable|date',
            'past_due_date' => 'nullable|date',
            'follow_up' => 'nullable|string',
            'department_responsible' => 'required|string',
            'policy_responsible' => 'required|string',
        ];

        return $validationRules;
    }
}

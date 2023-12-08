<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Facades\Pagination;
use App\Http\Casts\Claims\DenialRefileWrapper;
use App\Http\Casts\Claims\DenialTrackingWrapper;
use App\Http\Resources\Claim\DenialBodyResource;
use App\Models\Claims\Claim;
use App\Models\Claims\DenialRefile;
use App\Models\Claims\DenialTracking;
use App\Models\PrivateNote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'data' => DenialBodyResource::collection($claimsQuery->items()),
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

    public function createDenialRefile(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), $this->validateDenialRefileWrapper());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $claim = Claim::find($request->input('claim_id'));

        if (!$claim) {
            return response()->json(__('Claim ID not found'), 400);
        }

        $denialRefileWrapper = new DenialRefileWrapper($request->all());
        $refileData = $denialRefileWrapper->getData()['denial_refile_data'];

        $refile = DenialRefile::createDenialRefile($refileData);

        $note = PrivateNote::create([
            'publishable_type' => DenialRefile::class,
            'publishable_id' => $refile->id,
            'note' => $denialRefileWrapper->getData()['denial_refile_data']['note'],
        ]);

        $refile->private_note_id = $note->id;

        $refile->save();

        return $refile ? response()->json($refile) : response()->json(__('Error creating denial refile'), 400);
    }

    public function updateDenialRefile(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), $this->validateDenialRefileWrapper());

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $claim = Claim::find($request->input('claim_id'));

        if (!$claim) {
            return response()->json(__('Claim ID not found'), 400);
        }

        $denialRefileWrapper = new DenialRefileWrapper($request->all());
        $refileData = $denialRefileWrapper->getData()['denial_refile_data'];

        $refile = DenialRefile::updateDenialRefile($refileData);

        $note = PrivateNote::create([
            'publishable_type' => DenialRefile::class,
            'publishable_id' => $refile->id,
            'note' => $denialRefileWrapper->getData()['denial_refile_data']['note'],
        ]);

        $refile->private_note_id = $note->id;

        $refile->save();

        return $refile ? response()->json($refile) : response()->json(__('Error creating denial refile'), 400);
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

    private function validateDenialRefileWrapper(): array
    {
        $validationRules = [
            'refile_id' => 'nullable|numeric',
            'refile_type' => 'required|numeric',
            'policy_id' => 'nullable',
            'is_cross_over' => 'nullable|boolean',
            'cross_over_date' => 'nullable|date',
            'note' => 'required|string',
            'original_claim_id' => 'nullable',
            'refile_reason' => 'nullable|numeric',
            'claim_id' => 'required|numeric',
        ];

        return $validationRules;
    }
}

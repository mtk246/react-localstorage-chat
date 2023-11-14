<?php

declare(strict_types=1);

namespace App\Http\Controllers\Denial;

use App\Actions\Claim\GetDenialAction;
use App\Models\Claims\Claim;
use App\Models\Claims\DenialTracking;
use App\Http\Controllers\Controller;
use App\Repositories\ClaimRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class DenialController extends Controller
{
    public function __construct(
        private ClaimRepository $claimRepository,
    ) {
    }

    public function getServerAll(
        Request $request,
        Claim $claim,
        GetDenialAction $getDenial
    ): JsonResponse {
        $status = ($request->has('status') && $request->status !== null) ?
        json_decode($request->status, true) : [];

        $subStatus = ($request->has('subStatus') && $request->subStatus !== null) ?
        json_decode($request->subStatus, true) : [];

        return response()->json($getDenial->all($claim, $request, $status, $subStatus));
    }

    public function getOneDenial(
        Claim $denial,
        GetDenialAction $getDenial
    ): JsonResponse {
        return response()->json($getDenial->single($denial));
    }

    public function createDenialTracking(Request $request): JsonResponse
    {
        $claim = Claim::find($request->input('claim_id'));

        if (!$claim) {
            return response()->json(__('Error creating denial tracking'), 400);
        }

        $note = $claim->setStates(
            $request->input('claim_status'),
            $request->input('claim_sub_status'),
            $request->input('tracking_note'),
        );

        $trackingData = [
            'interface_type' => $request->input('interface_type'),
            'is_reprocess_claim' => $request->input('is_reprocess_claim'),
            'is_contact_to_patient' => $request->input('is_contact_to_patient'),
            'contact_through' => $request->input('contact_through'),
            'claim_id' => $request->input('claim_id'),
            'claim_number' => $request->input('claim_number'),
            'rep_name' => $request->input('rep_name'),
            'ref_number' => $request->input('ref_number'),
            'claim_status' => $request->input('claim_status'),
            'claim_sub_status' => $request->input('claim_sub_status'),
            'tracking_date' => $request->input('tracking_date'),
            'resolution_time' => $request->input('resolution_time'),
            'past_due_date' => $request->input('past_due_date'),
            'follow_up' => $request->input('follow_up'),
            'department_responsible' => $request->input('department_responsible'),
            'policy_responsible' => $request->input('policy_responsible'),
            'private_note_id' => $note->id,
            'response_details' => $request->input('response_details'),
        ];

        if (isset($note)) {
            $tracking = DenialTracking::createDenialTracking($trackingData);
        }


        return $tracking ? response()->json($tracking, 201) : response()->json(__('Error creating denial tracking'), 400);
    }

    public function updateDenialTracking(Request $request): JsonResponse
    {
        $claim = Claim::find($request->input('claim_id'));

        if (!$claim) {
            return response()->json(__('Error updating denial tracking'), 400);
        }

        $note = $claim->setStates(
            $request->input('claim_status'),
            $request->input('claim_sub_status'),
            $request->input('tracking_note'),
        );

        $trackingData = [
            'denial_id' => $request->input('denial_id'),
            'interface_type' => $request->input('interface_type'),
            'is_reprocess_claim' => $request->input('is_reprocess_claim'),
            'is_contact_to_patient' => $request->input('is_contact_to_patient'),
            'contact_through' => $request->input('contact_through'),
            'claim_id' => $request->input('claim_id'),
            'claim_number' => $request->input('claim_number'),
            'rep_name' => $request->input('rep_name'),
            'ref_number' => $request->input('ref_number'),
            'claim_status' => $request->input('claim_status'),
            'claim_sub_status' => $request->input('claim_sub_status'),
            'tracking_date' => $request->input('tracking_date'),
            'resolution_time' => $request->input('resolution_time'),
            'past_due_date' => $request->input('past_due_date'),
            'follow_up' => $request->input('follow_up'),
            'department_responsible' => $request->input('department_responsible'),
            'policy_responsible' => $request->input('policy_responsible'),
            'private_note_id' => $note->id,
            'response_details' => $request->input('response_details'),
        ];

        $tracking = DenialTracking::updateDenialTracking($trackingData);

        return $tracking ? response()->json($tracking) : response()->json(__('Error updating denial tracking'), 400);
    }
}

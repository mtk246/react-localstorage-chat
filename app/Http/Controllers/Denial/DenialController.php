<?php

declare(strict_types=1);

namespace App\Http\Controllers\Denial;

use App\Actions\Claim\GetClaimAction;
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
        GetClaimAction $getClaim
    ): JsonResponse {
        return response()->json($getClaim->all($claim, $request));
    }

    public function getOneDenial(
        Claim $denial,
        GetDenialAction $getDenial
    ): JsonResponse {
        return response()->json($getDenial->single($denial));
    }

    public function createDenialTracking(Request $request): JsonResponse
    {
        $trackingData = [
            'interface_type' => $request->input('interface_type'),
            'is_reprocess_claim' => $request->input('is_reprocess_claim'),
            'is_contact_to_patient' => $request->input('is_contact_to_patient'),
            'contact_through' => $request->input('contact_through'),
            'claim_id' => $request->input('claim_id'),
            'rep_name' => $request->input('rep_name'),
            'ref_number' => $request->input('ref_number'),
            'status_claim' => $request->input('status_claim'),
            'sub_status_claim' => $request->input('sub_status_claim'),
            'tracking_date' => $request->input('tracking_date'),
            'past_due_date' => $request->input('past_due_date'),
            'follow_up' => $request->input('follow_up'),
            'department_responsible' => $request->input('department_responsible'),
            'policy_responsible' => $request->input('policy_responsible'),
            'tracking_note' => $request->input('tracking_note'),
        ];

        $tracking = DenialTracking::createDenialTracking($trackingData);

        return $tracking ? response()->json($tracking, 201) : response()->json(__('Error creating denial tracking'), 400);
    }

    public function updateDenialTracking(Request $request): JsonResponse
    {
        $trackingData = [
            'interface_type' => $request->input('interface_type'),
            'is_reprocess_claim' => $request->input('is_reprocess_claim'),
            'is_contact_to_patient' => $request->input('is_contact_to_patient'),
            'contact_through' => $request->input('contact_through'),
            'denial_id' => $request->input('denial_id'),
            'claim_id' => $request->input('claim_id'),
            'rep_name' => $request->input('rep_name'),
            'ref_number' => $request->input('ref_number'),
            'status_claim' => $request->input('status_claim'),
            'sub_status_claim' => $request->input('sub_status_claim'),
            'tracking_date' => $request->input('tracking_date'),
            'past_due_date' => $request->input('past_due_date'),
            'follow_up' => $request->input('follow_up'),
            'department_responsible' => $request->input('department_responsible'),
            'policy_responsible' => $request->input('policy_responsible'),
            'tracking_note' => $request->input('tracking_note'),
        ];

        $tracking = DenialTracking::updateDenialTracking($trackingData);

        return $tracking ? response()->json($tracking) : response()->json(__('Error updating denial tracking'), 400);
    }
}

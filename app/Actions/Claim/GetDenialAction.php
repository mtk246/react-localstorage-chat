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
        $claim = Claim::find($request->input('claim_id'));

        if (!$claim) {
            return response()->json(__('Error creating denial tracking'), 400);
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
        $claim = Claim::find($request->input('claim_id'));

        if (!$claim) {
            return response()->json(__('Error updating denial tracking'), 400);
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
        $claim = Claim::find($request->input('claim_id'));

        if (!$claim) {
            return response()->json(__('Error creating denial tracking'), 400);
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
        $claim = Claim::find($request->input('claim_id'));

        if (!$claim) {
            return response()->json(__('Error updating denial refile'), 400);
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
}

<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Casts\Claims\DenialTrackingRequestWrapper;
use App\Models\Claims\Claim;
use App\Models\Claims\DenialTracking;
use Illuminate\Support\Facades\DB;

final class CreateDenialTrackingAction
{
    public function invoke(Claim $claim, DenialTrackingRequestWrapper $trackingData): Claim
    {
        return DB::transaction(function () use (&$claim, $trackingData) {
            $note = $claim->setStates(
                $trackingData->getStatus(),
                $trackingData->getSubStatus(),
                $trackingData->getTrackingNote()
            );

            if (isset($note)) {
                DenialTracking::updateOrCreate([
                    'claim_id' => $claim->id,
                    'private_note_id' => $note->id,
                ],
                    $trackingData->getData()
                );
            }

            return $claim->load(['demographicInformation', 'service', 'insurancePolicies']);
        });
    }
}

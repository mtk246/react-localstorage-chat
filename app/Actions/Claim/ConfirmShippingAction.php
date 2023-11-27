<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Models\Claims\Claim;
use App\Models\Claims\ClaimBatch;
use App\Models\Claims\ClaimBatchStatus;
use App\Models\Claims\ClaimStatus;
use App\Models\Claims\ClaimTransmissionStatus;
use App\Models\ClaimTransmissionResponse;
use Illuminate\Support\Facades\DB;

final class ConfirmShippingAction
{
    public function __construct()
    {
    }

    public function invoke(ClaimBatch $batch): ClaimBatch
    {
        return DB::transaction(function () use (&$batch) {
            $claimBatchStatus = ClaimBatchStatus::whereStatus('Submitted')->first();
            $batch->claims
                ->map(fn (Claim $claim) => $this->claimSubmit($claim->id, $batch->id));

            $batch->update([
                'claim_batch_status_id' => $claimBatchStatus->id,
                'shipping_date' => now(),
            ]);

            return $batch;
        });
    }

    public function claimSubmit(int $claimId, int $batchId)
    {
        return DB::transaction(function () use ($claimId, $batchId) {
            $claim = Claim::query()
                ->where('id', $claimId ?? null)
                ->with(['demographicInformation', 'insurancePolicies'])
                ->firstOrFail();

            $claimTransmissionStatus = ClaimTransmissionStatus::whereStatus('Success')->first();
            $statusSubmitted = ClaimStatus::whereStatus('Submitted')->first();
            $claim->setStates($statusSubmitted->id, null, 'Submitted to ClearingHouse');

            return ClaimTransmissionResponse::updateOrCreate([
                'claim_id' => $claim->id,
                'claim_batch_id' => $batchId,
                'claim_transmission_status_id' => $claimTransmissionStatus->id,
                'response_details' => null,
            ]);
        });
    }
}

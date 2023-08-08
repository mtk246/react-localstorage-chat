<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Enums\Claim\FormatType;
use App\Models\Claims\Claim;
use App\Models\Claims\ClaimBatch;
use App\Models\Claims\ClaimBatchStatus;
use App\Models\Claims\ClaimStatus;
use App\Models\Claims\ClaimTransmissionStatus;
use App\Models\ClaimTransmissionResponse;
use App\Services\ClaimService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

final class SubmitToClearingHouseAction
{
    public function __construct(
        private readonly ClaimService $claimService,
    ) {
    }

    public function invoke(?string $token, ClaimBatch $batch): Collection
    {
        return DB::transaction(function () use (&$batch, $token) {
            $claimBatchStatus = ClaimBatchStatus::whereStatus('Submitted')->first();
            $batch->claims
                ->map(fn (Claim $claim) => $this->claimSubmit($token, $claim->id, $batch->id));

            return $batch->update([
                'claim_batch_status_id' => $claimBatchStatus->id,
                'shipping_date' => now(),
            ]);
        });
    }

    public function claimSubmit(?string $token, int $claimId, int $batchId)
    {
        return DB::transaction(function () use ($token, $claimId, $batchId) {
            $claim = Claim::query()
                ->where('id', $claimId ?? null)
                ->with(['demographicInformation', 'insurancePolicies'])
                ->firstOrFail();

            $body = array_filter(
                $this->claimService->create(
                    FormatType::JSON,
                    $claim,
                    $claim->demographicInformation->company ?? null,
                    $claim->insurancePolicies()
                        ->wherePivot('order', 1)
                        ?->first()
                        ?->insurancePlan
                        ?->insuranceCompany ?? null,
                )->toArray(),
                function ($innerValue) {
                    return !empty($innerValue);
                }
            );

            $response = Http::withToken($token)->acceptJson()->post(
                config('claim.connections.url_submission'),
                $body
            );
            $responseData['response'] = json_decode($response->body());
            $responseData['request'] = $body;

            if ($response->successful()) {
                $claimTransmissionStatus = ClaimTransmissionStatus::whereStatus('Success')->first();
                $statusSubmitted = ClaimStatus::whereStatus('Submitted')->first();
                $claim->setStates($statusSubmitted->id, null, 'Submitted to ClearingHouse');
            } elseif ($response->serverError()) {
                $claimTransmissionStatus = ClaimTransmissionStatus::whereStatus('Error')->first();
                $statusId = $claim->claimStatusClaims()
                    ->where('claim_status_type', ClaimStatus::class)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('id', 'desc')
                    ->first()?->claim_status_id ?? null;
                $claim->setStates($statusId, null, 'Error in transmission');
            } elseif ($response->failed()) {
                $claimTransmissionStatus = ClaimTransmissionStatus::whereStatus('Error')->first();
                $statusDenied = ClaimStatus::whereStatus('Rejected')->first();
                $claim->setStates($statusDenied->id, null, 'Submitted to ClearingHouse');
            }

            return ClaimTransmissionResponse::updateOrCreate([
                'claim_id' => $claim->id,
                'claim_batch_id' => $batchId,
                'claim_transmission_status_id' => $claimTransmissionStatus->id,
                'response_details' => isset($responseData) ? json_encode($responseData) : null,
            ]);
        });
    }
}

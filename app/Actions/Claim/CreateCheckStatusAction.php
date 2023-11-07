<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Casts\Claims\CheckStatusRequestWrapper;
use App\Models\Claims\Claim;
use App\Models\Claims\ClaimCheckStatus;
use App\Models\Claims\ClaimStatusClaim;
use App\Models\PrivateNote;
use Illuminate\Support\Facades\DB;

final class CreateCheckStatusAction
{
    public function invoke(Claim $claim, CheckStatusRequestWrapper $claimData): Claim
    {
        return DB::transaction(function () use (&$claim, $claimData) {
            $statusClaim = $claim->claimStatusClaims()
                         ->orderBy('created_at', 'desc')
                         ->orderBy('id', 'desc')->first() ?? null;

            if (isset($statusClaim)) {
                $note = PrivateNote::create([
                    'publishable_type' => ClaimStatusClaim::class,
                    'publishable_id' => $statusClaim->id,
                    'billing_company_id' => $claim->billing_company_id,
                    'note' => $claimData->getPrivateNote(),
                ]);

                ClaimCheckStatus::updateOrCreate([
                    'private_note_id' => $note->id,
                ],
                    $claimData->getData()
                );
            }

            return $claim->load(['demographicInformation', 'service', 'insurancePolicies']);
        });
    }
}

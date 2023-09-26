<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Casts\Claims\ChangeStatusRequestWrapper;
use App\Models\Claims\Claim;
use Illuminate\Support\Facades\DB;

final class ChangeStatusAction
{
    public function invoke(Claim $claim, ChangeStatusRequestWrapper $claimData): Claim
    {
        return DB::transaction(function () use (&$claim, $claimData) {
            $claim->setStates(
                $claimData->getStatus(),
                $claimData->getSubStatus(),
                $claimData->getPrivateNote()
            );

            return $claim->load(['demographicInformation', 'service', 'insurancePolicies']);
        });
    }
}

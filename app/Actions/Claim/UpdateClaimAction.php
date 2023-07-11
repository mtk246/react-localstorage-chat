<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Casts\Claims\StoreRequestWrapper;
use App\Models\Claims\Claim;
use Illuminate\Support\Facades\DB;

final class UpdateClaimAction
{
    public function invoke(Claim $claim, StoreRequestWrapper $claimData): Claim
    {
        return DB::transaction(function () use (&$claim, $claimData) {
            $claim->setDemographicInformation($claimData->getDemographicInformation());
            $claim->setServices($claimData->getClaimServices(), $claimData->getAdditionalInformation());
            $claim->setInsurancePolicies($claimData->getPoliciesInsurances());
            $claim->setStates($claimData->getStatus(), $claimData->getSubStatus(), $claimData->getPrivateNote());
            $claim->setAdditionalInformation($claimData->getAdditionalInformation());

            return $claim->load(['demographicInformation', 'service', 'insurancePolicies']);
        });
    }
}

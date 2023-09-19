<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Casts\Claims\StoreRequestWrapper;
use App\Models\Claims\Claim;
use Illuminate\Support\Facades\DB;

final class CreateAction
{
    public function invoke(StoreRequestWrapper $claimData): Claim
    {
        return DB::transaction(fn () => tap(
            Claim::query()->create($claimData->getData()),
            function (Claim $claim) use ($claimData): void {
                $claim->setDemographicInformation($claimData->getDemographicInformation());
                $claim->setServices($claimData->getClaimServices(), $claimData->getAdditionalInformation());
                $claim->setInsurancePolicies($claimData->getPoliciesInsurances());
                $claim->setStates(
                    $claimData->getStatus(),
                    $claimData->getSubStatus(),
                    $claimData->getPrivateNote('Claim created successfully')
                );
                $claim->setAdditionalInformation($claimData->getAdditionalInformation());
            },
        )->load(['demographicInformation', 'service', 'insurancePolicies']));
    }
}

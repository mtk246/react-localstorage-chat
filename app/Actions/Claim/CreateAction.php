<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Casts\Claims\StoreRequestWrapper;
use App\Models\Claims\Claim;
use Illuminate\Support\Facades\DB;
use Laravel\Telescope\Telescope;

final class CreateAction
{
    public function invoke(StoreRequestWrapper $claimData): Claim
    {
        // This is a workaround to avoid the telescope to record the query and triger the bug in claims model for not relationship seted
        Telescope::stopRecording();

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
                Telescope::startRecording();
            },
        )->load(['demographicInformation', 'service', 'insurancePolicies']));
    }
}

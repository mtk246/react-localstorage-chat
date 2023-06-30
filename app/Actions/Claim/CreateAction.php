<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Casts\Claims\StoreRequestWrapper;
use App\Models\Claims\Claim;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class CreateAction
{
    public function invoke(StoreRequestWrapper $claimData): Collection
    {
        return DB::transaction(tap(
            Claim::query()->create($claimData->getData()),
            function (Claim $claim) use ($claimData) {
                $claim->setDemographicInformation($claimData->getDemographicInformation());
                $claim->setServices($claimData->getClaimServices());
                $claim->setInsurancePolicies($claimData->getPoliciesInsurances());
                $claim->setStates($claimData->getStatus(), $claimData->getSubStatus());
                $claim->query()->when($claim->type, function (Claim $query) use ($claimData) {
                    $query->setAdditionalInformation($claimData->getAdditionalInformation());
                });
            }
        )->load(['demographicInformation', 'services', 'policiesInsurances', 'aditionalInformation']));
    }
}

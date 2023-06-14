<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Casts\Claims\CreateRequestWrapper;
use App\Models\Claims\Claim;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class CreateAction
{
    public function invoke(CreateRequestWrapper $claimData): Collection
    {
        return DB::transaction(tap(
            new Claim($claimData->getData()),
            function (Claim $claim) use ($claimData) {
                $claim->setDemographicInformation($claimData->getDemographicInformation());
                $claim->setServices($claimData->getClaimServices());
                $claim->setPoliciesInsurances($claimData->getPoliciesInsurances());
                $claim->setAditionalInformation($claimData->getAditionalInformation());
            }
        )->load(['demographicInformation', 'services', 'policiesInsurances', 'aditionalInformation']));
    }
}

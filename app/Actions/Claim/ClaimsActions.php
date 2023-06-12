<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Http\Casts\Claims\DemographicInformationWrapper;
use App\Models\Claims\Claim;
use App\Models\Claims\ClaimServices;
use App\Models\Claims\Services;

abstract class ClaimsActions
{
    protected function setDemographicInformation(Claim $claim, DemographicInformationWrapper $demographicInformation): void
    {
        $claim
            ->demographicInformation()
            ->updateOrCreate(
                ['claim_id' => $claim->id],
                $demographicInformation->getData()
            );
    }

    protected function setServices(Claim $claim, ServicesWrapper $services): void
    {
        /** @var ClaimServices */
        $claimService = $claim
            ->services()
            ->updateOrCreate(
                ['claim_id' => $claim->id],
                $services->getData()
            );

        Services::upsert($services->getDiagnoses()->getData());

        $claimService->diagnoses()->syncWithPivotValues(
            $services->getDiagnoses()->getIds(),
            $services->getDiagnoses()->getValues(),
        );
    }

    protected function policiesInsurances(Claim $claim, PoliciesInsurancesWrapper $policiesInsurances): void
    {
        $claim
            ->policiesInsurances()
            ->updateOrCreate(
                ['claim_id' => $claim->id],
                $policiesInsurances->getData()
            );
    }

    protected function setAditionalInformation(Claim $claim, AditionalInformationWrapper $aditionalInformation): void
    {
        $claim
            ->aditionalInformation()
            ->updateOrCreate(
                ['claim_id' => $claim->id],
                $aditionalInformation->getData()
            );
    }
}

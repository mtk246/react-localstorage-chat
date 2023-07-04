<?php

declare(strict_types=1);

namespace App\Actions\Claim;

use App\Enums\Claim\ClaimType;
use App\Http\Casts\Claims\StoreRequestWrapper;
use App\Models\Claims\Claim;
use Illuminate\Support\Facades\DB;

final class UpdateClaimAction
{
    /**
     * @todo: add logic to control claim status should be set to manual verification
     *
     * $statusVerify = ClaimStatus::whereStatus('Verified - Not submitted')->first();
     * if (($request->validate ?? false) == true) {
     *     $rs = $this->claimValidation($claim->id);
     *     $this->claimRepository->changeStatus([
     *         'status_id' => $statusVerify->id,
     *         'private_note' => 'API verification',
     *     ], $claim->id);
     * } else {
     *     $this->claimRepository->changeStatus([
     *         'status_id' => $statusVerify->id,
     *         'private_note' => 'Manual verification',
     *     ], $claim->id);
     * }
     */
    public function invoke(Claim $claim, StoreRequestWrapper $claimData): Claim
    {
        return DB::transaction(function () use (&$claim, $claimData) {
            $claim->setDemographicInformation($claimData->getDemographicInformation());
            $claim->setServices($claimData->getClaimServices());
            $claim->setInsurancePolicies($claimData->getPoliciesInsurances());
            $claim->setStates($claimData->getStatus(), $claimData->getSubStatus());

            if (ClaimType::INSTITUTIONAL->value == $claim->type) {
                $claim->setAdditionalInformation($claimData->getAdditionalInformation());
            }

            return $claim->load(['demographicInformation', 'services', 'insurancePolicies']);
        });
    }
}

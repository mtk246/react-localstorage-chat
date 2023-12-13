<?php

declare(strict_types=1);

namespace App\Http\Resources\Ledger;

use Illuminate\Http\Resources\Json\JsonResource;

final class ClaimPatientDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            'medical_number' => $this->resource->patientPrivate->med_num ?? null,
            'patient_number' => $this->resource->patientPrivate->patient_num ?? null,
            'profile' => ProfileResource::make($this->resource->profile),
            'claims' => $this->getClaimsData(),
            'policy_information' => $this->getPolicyHolderData(),
        ];
    }

    private function getProfileData(): array|null
    {
        return isset($this->resource->profile)
            ? [
                'first_name' => $this->resource->profile->first_name,
                'last_name' => $this->resource->profile->last_name,
                'dob' => $this->resource->profile->date_of_birth,
                'ssn' => $this->resource->profile->ssn,
            ]
            : null;
    }

    private function getClaimsData()
    {
        $claimsDemographics = $this->resource->claimDemographics;

        if (request()->has('status')) {
            $claimsDemographics = $this->resource->claimDemographics->filter(function ($claimDemographic) {
                return $claimDemographic->claim->claimStatusClaims->first()->claim_status_id === request()->status;
            });
        }

        return ClaimDetailResource::collection($claimsDemographics);
    }

    private function getPolicyHolderData(): array|null
    {
        $policy = $this->resource->claimDemographics->first()->claim->insurancePolicies()->where([
            'order' => 1,
        ])->first();

        return [
            'policy_holder' => $policy->policy_holder,
            'policy_number' => $policy->policy_number,
            'effective_date' => $policy->effective_date,
            'expiration_date' => $policy->expiration_date,
        ] ?? null;
    }
}

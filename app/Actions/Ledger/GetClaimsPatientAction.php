<?php

declare(strict_types=1);

namespace App\Actions\Ledger;

use App\Http\Resources\Ledger\ClaimPatientDetailResource;
use App\Models\Patient;

final class GetClaimsPatientAction
{
    public function getClaims(Patient $patient): ClaimPatientDetailResource
    {
        $data = $patient->load([
            'profile',
            'patientPrivate',
            'claimDemographics.claim.claimStatusClaims' => function ($query) {
                $query->orderBy('created_at', 'desc');
            },
            'claimDemographics.claim.service',
            'claimDemographics.healthProfessionals' => function ($query) {
                $query->wherePivot('field_id', 5)
                    ->orWherePivot('field_id', 1)
                    ->orWherePivot('field_id', 76);
            },
            'claimDemographics.claim.insurancePolicies.insurancePlan',
            'claimDemographics.company',
        ]);

        return ClaimPatientDetailResource::make($data);
    }
}

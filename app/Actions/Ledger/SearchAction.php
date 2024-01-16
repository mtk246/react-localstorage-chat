<?php

declare(strict_types=1);

namespace App\Actions\Ledger;

use App\Http\Resources\Ledger\PatientLedgerResource;
use App\Models\Patient;

final class SearchAction
{
    public function search($filters)
    {
        $query = Patient::query();

        if (isset($filters['claim_number'])) {
            $query->with('claimDemographics.claim')
                ->whereHas('claimDemographics.claim', fn ($q) => $q->where('code', $filters['claim_number']));
        }

        if (
            array_key_exists('first_name', $filters)
            || array_key_exists('last_name', $filters)
            || array_key_exists('dob', $filters)
            || array_key_exists('ssn', $filters)
        ) {
            $query->with('profile')
                ->whereHas('profile', function ($q) use ($filters): void {
                    $q->when(isset($filters['first_name']), fn ($query) => $query->whereRaw(
                        'LOWER(first_name) LIKE ?',
                        ['%'.strtolower($filters['first_name']).'%'],
                    ))->when(isset($filters['last_name']), fn ($query) => $query->whereRaw(
                        'LOWER(last_name) LIKE ?',
                        ['%'.strtolower($filters['last_name']).'%'],
                    ))->when(isset($filters['dob']), fn ($query) => $query->where('date_of_birth', $filters['dob']))
                        ->when(isset($filters['ssn']), fn ($query) => $query->where('ssn', $filters['ssn']));
                });
        }

        if (isset($filters['company_ids'])) {
            $query->with('claimDemographics.company')
                ->whereHas('claimDemographics.company', fn ($q) => $q->whereIn('id', $filters['company_ids']));
        }

        if (isset($filters['start_date']) || isset($filters['end_date'])) {
            $query->with('claimDemographics.claim.service')
                ->whereHas('claimDemographics.claim.service', function ($q) use ($filters): void {
                    $q->when(
                        isset($filters['start_date']),
                        fn ($query) => $query->where('from', '>=', $filters['start_date'])
                    )
                    ->when(isset($filters['end_date']), fn ($query) => $query->where('to', '<=', $filters['end_date']));
                });
        }

        if (isset($filters['medical_number'])) {
            $query->with('companies')
                ->whereHas('companies', function ($q) use ($filters): void {
                    $q->when(
                        isset($filters['medical_number']),
                        fn ($query) => $query->where('med_num', $filters['medical_number'])
                    );
                });
        }

        if (isset($filters['health_professional_ids'])) {
            $query->with('claimDemographics.healthProfessionals')
                ->whereHas(
                    'claimDemographics.healthProfessionals',
                    fn ($q) => $q->whereIn('id', $filters['health_professional_ids'])
                );
        }

        if (isset($filters['insurance_plans_ids'])) {
            $query->with('claimDemographics.claim.insurancePolicies.insurancePlan')
                ->whereHas(
                    'claimDemographics.claim.insurancePolicies.insurancePlan',
                    fn ($q) => $q->whereIn('id', $filters['insurance_plans_ids'])
                );
        }

        if (isset($filters['patient_number'])) {
            $query = $query->where('code', $filters['patient_number']);
        }

        $patients = $query->get();

        return PatientLedgerResource::collection($patients);
    }
}

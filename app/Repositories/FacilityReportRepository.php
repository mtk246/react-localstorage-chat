<?php

namespace App\Repositories;

use App\Models\Reports\ViewFacilityReport;

final class FacilityReportRepository
{
    public function getAllFacility(): array
    {
        return \DB::transaction(
            fn () => ViewFacilityReport::all()->toArray()
        );
    }

    public function getFacilityByBillingCompany($billingCompanyId): array
    {
        $query = \DB::transaction(
            fn () => ViewFacilityReport::select([
                'billing_companies_ids',
                'billing_companies',
                'companies',
                'code',
                'facility', 
                'npi',
                'primary_taxonomy',
                'place_of_service',
                'type_of_facility',
                'bill_classifications',
                'claims_processed'
            ])->get()
        );
        $response = [];

        foreach($query as $item) {
            if (in_array($billingCompanyId, json_decode($item->billing_companies_ids))) {
                array_push($response, $item);
            }
        }

        return $response;
    }
}

<?php

namespace App\Repositories;

use App\Models\Reports\ViewFacilityReport;

final class FacilityReportRepository
{
    public function getAllNamesClounms() {
        $columns = [
            'companies',
            'code',
            'facility', 
            'npi',
            'primary_taxonomy',
            'place_of_service',
            'type_of_facility',
            'bill_classifications',
            'claims_processed'
        ];
        $response = [];

        if (!\Auth::user()->billing_company_id) {
            array_unshift($columns, 'billing_companies');
        }

        foreach ($columns as $column) {
            array_push($response, [
                "name" => $column,
                "value" => $column,
                "align" => "left",
                "text" => upperCaseColumns($column),
                "width" => "270px",
            ]);
        }

        return $response;
    }

    public function getAllFacility(): array
    {
        $data = ViewFacilityReport::paginate(20)->toArray();

        return responseReportlist($data, 'Facility');
    }

    public function getFacilityByBillingCompany($billingCompanyId): array
    {
        $query = ViewFacilityReport::select([
                'billing_companies_ids',
                'companies',
                'code',
                'facility', 
                'npi',
                'primary_taxonomy',
                'place_of_service',
                'type_of_facility',
                'bill_classifications',
                'claims_processed'
            ])->get();

        $response = [];

        foreach($query as $item) {
            if (in_array($billingCompanyId, explode(',', $item['billing_companies_ids']))){
                array_push($response, $item);
            }
        }

        return responseReportlist($response, 'Facility');
    }
}

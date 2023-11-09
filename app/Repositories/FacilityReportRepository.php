<?php

namespace App\Repositories;

use App\Models\Reports\ViewFacilityReport;

final class FacilityReportRepository
{
    public function getAllNamesClounms() {
        $columns = [
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
        ];
        $response = [];

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
        $data = \DB::transaction(
            fn () => ViewFacilityReport::paginate()->toArray()
        );

        return responseReportlist($data, 'Facility');
    }

    public function getFacilityByBillingCompany($billingCompanyId): array
    {
        $query = \DB::transaction(
            fn () => ViewFacilityReport::select([
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

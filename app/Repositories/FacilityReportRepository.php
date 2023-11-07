<?php

namespace App\Repositories;

use App\Models\Reports\ViewFacilityReport;

final class FacilityReportRepository
{
    public function getAllNamesClounms() {
        $columns = \DB::select("
            SELECT attname AS name, format_type(atttypid, atttypmod) AS type FROM pg_attribute WHERE  attrelid = 'public.view_facility_report'::regclass
        ");
        $response = [];

        foreach ($columns as $column) {
            if ($column->name != 'billing_companies_ids') {
                array_push($response, [
                    "name" => $column->name,
                    "field" => $column->name,
                    "align" => "left",
                    "sortable" => true,
                    "label" => upperCaseColumns($column->name),
                    "type" => $column->type
                ]);
            }
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

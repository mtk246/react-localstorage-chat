<?php

namespace App\Repositories;

use App\Models\Reports\ViewHealthcareProfessionalReport;

final class HealthcareProfessionalRepository
{
    public function getAllNamesClounms() {
        $columns = \DB::select("
            SELECT attname AS name, format_type(atttypid, atttypmod) AS type FROM pg_attribute WHERE  attrelid = 'public.view_healthcare_professional_report'::regclass
        ");
        $response = [];

        if (\Auth::user()->billing_company_id) {
            unset($columns[1]);
        }

        foreach ($columns as $column) {
            if ($column->name != 'billing_companies_ids') {
                array_push($response, [
                    "name" => $column->name,
                    "value" => $column->name,
                    "align" => "left",
                    "text" => upperCaseColumns($column->name),
                    "width" => "270px",
                ]);
            }
        }

        return $response;
    }

    public function getHealthcareProfessional(): array
    {
        $data = ViewHealthcareProfessionalReport::paginate(20)->toArray();

        return responseReportlist($data, 'Healthcare Professional');
    }

    public function getFacilityByBillingCompany($billingCompanyId): array
    {
        $query = ViewHealthcareProfessionalReport::select([
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
            if (in_array($billingCompanyId, json_decode($item->billing_companies_ids))) {
                array_push($response, $item);
            }
        }

        return $response;
    }
}

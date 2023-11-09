<?php

namespace App\Repositories;

use App\Models\Reports\ViewDetailedPatientReport;

final class PatientReportRepository
{
    public function getAllNamesClounms() {
        $columns = \DB::select("
            SELECT attname AS name, format_type(atttypid, atttypmod) AS type FROM pg_attribute WHERE  attrelid = 'public.view_detailed_patient_report'::regclass
        ");
        $response = [];
        $billingCompanyId = \Auth::user()->billing_company_id;

        if ($billingCompanyId) {
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

    public function getGeneralNamesClounms() {
        $billingCompanyId = \Auth::user()->billing_company_id;
        $columns = [
            'companies',
            'medical_no',
            'system_code',
            'patiente_name',
            'date_of_birth',
            'sex',
            'claims_processed',
        ];

        if (!$billingCompanyId) {
            array_unshift($columns, 'billing_companies');
        }

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

    public function getAllPatient(): array
    {
        if (!\Auth::user()->billing_company_id) {
            return responseReportlist(ViewDetailedPatientReport::paginate(20)->toArray(), 'Detail Patient');
        }

        return $this->getAllPatientBillingManager(\Auth::user()->billing_company_id);
    }

    private function getAllPatientBillingManager($billingCompanyId): array
    {
        $query = ViewDetailedPatientReport::allPatientBillingManager();
        
        $response = [];

        foreach($query['data'] as $item) {
            if (in_array($billingCompanyId, explode(',', $item['billing_companies_ids']))) {
                array_push($response, $item['system_code']);
            }
        }

        $data = ViewDetailedPatientReport::whereIn('system_code', $response)->paginate()->toArray();

        return responseReportlist($data, 'Detail Patient');
    }

    public function getAllGeneralPatient()
    {
        if (!\Auth::user()->billing_company_id) {
            return responseReportlist(ViewDetailedPatientReport::allGeneralPatient(), 'General Patient');
        }

        return $this->getAllGeneralPatientBillingManager(\Auth::user()->billing_company_id);
    }

    private function getAllGeneralPatientBillingManager($billingCompanyId): array
    {
        $query = ViewDetailedPatientReport::allGeneralPatientBillingManager();
        $response = [];

        foreach($query['data'] as $item) {
            if (in_array($billingCompanyId, explode(',', $item['billing_companies_ids']))) {
                array_push($response, $item['system_code']);
            }
        }

        $data = ViewDetailedPatientReport::whereIn('system_code', $response)->paginate(20)->toArray();

        return responseReportlist($data, 'General Patient');
    }
}

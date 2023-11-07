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

    public function getAllPatient(): array
    {
        return \DB::transaction(
            fn () => ViewDetailedPatientReport::all()->toArray()
        );
    }

    public function getAllPatientBillingManager($billingCompanyId): array
    {
        $query = \DB::transaction(
            fn () => ViewDetailedPatientReport::select([
                'billing_companies_ids',
                'companies',
                'medical_no',
                'claims_processed',
                'system_code',
                'patiente_name',
                'date_of_birth',
                'sex',
                'ssn',
                'driver_license',
                'language',
                'name',
                'phone',
                'cell_phone',
                'fax',
                'email',
                'type_address',
                'address',
                'apt_suite',
                'zip',
                'city',
                'state',
                'country'
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

    public function getAllGeneralPatient()
    {
        return \DB::transaction(
            fn () => ViewDetailedPatientReport::select([
                'billing_companies',
                'companies',
                'medical_no',
                'system_code',
                'patiente_name',
                'date_of_birth',
                'sex',
                'claims_processed',
            ])->get()
        );
    }

    public function getAllGeneralPatientBillingManager($billingCompanyId): array
    {
        $query = \DB::transaction(
            fn () => ViewDetailedPatientReport::select([
                'billing_companies_ids',
                'companies',
                'medical_no',
                'system_code',
                'patiente_name',
                'date_of_birth',
                'sex',
                'claims_processed',
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

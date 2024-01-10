<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared("
        DROP VIEW IF EXISTS public.view_general_patient;
        CREATE OR REPLACE VIEW public.view_general_patient
        AS SELECT
            row_number() OVER () AS id,
            billing_companies.id AS billing_id,
            concat(
                billing_companies.abbreviation,
                ' - ',
                billing_companies.name
            ) AS billing_companies,
            concat(
                companies.code,
                ' - ',
                companies.name
            ) AS companies,
            company_patient.med_num AS medical_no,
            CASE
                WHEN claim_demographic.totalClaims > 0 THEN 1
                ELSE 0
            END AS claims_processed,
            patients.code AS system_code,
            CASE
                WHEN concat_ws(
                    ' '::text,
                    COALESCE(
                        profiles.last_name,
                        ''::character varying
                    ),
                    COALESCE(
                        type_catalogs.code,
                        ''::character varying
                    ),
                    COALESCE(
                        profiles.first_name,
                        ''::character varying
                    ),
                    COALESCE(
                        profiles.middle_name,
                        ''::character varying
                    )
                ) = ' '::text THEN 'Console'::text
                ELSE concat_ws(
                    ' '::text,
                    COALESCE(
                        profiles.last_name,
                        ''::character varying
                    ),
                    COALESCE(
                        type_catalogs.code,
                        ''::character varying
                    ),
                    COALESCE(
                        profiles.first_name,
                        ''::character varying
                    ),
                    COALESCE(
                        profiles.middle_name,
                        ''::character varying
                    )
                )
            END AS patient_name,
            profiles.date_of_birth,
            profiles.sex,
            date(patients.created_at) as created_at,
            date(patients.updated_at) as updated_at
        FROM patients
            LEFT JOIN profiles ON patients.profile_id = profiles.id
            LEFT JOIN type_catalogs ON profiles.name_suffix_id = type_catalogs.id
            LEFT JOIN marital_statuses ON marital_statuses.id = patients.marital_status_id
            LEFT JOIN company_patient ON company_patient.patient_id = patients.id
            LEFT JOIN billing_companies ON company_patient.billing_company_id = billing_companies.id
            LEFT JOIN companies ON company_patient.company_id = companies.id
            left join (
                select
                    claim_demographic.patient_id,
                    count(claim_demographic.id) as totalClaims
                from claim_demographic
                group by
                    claim_demographic.patient_id
            ) as claim_demographic ON claim_demographic.patient_id = patients.id
        ORDER BY patients.id;
        
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_general_patient');
    }
};

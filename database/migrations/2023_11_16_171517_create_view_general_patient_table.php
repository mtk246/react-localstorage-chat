<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE VIEW public.view_general_patient
            AS select
                row_number() OVER() as id,
                billing_companies.id as billing_id,
                concat(billing_companies.abbreviation, ' - ', billing_companies.name) as billing_companies,
                concat(companies.code, ' - ', companies.name) as companies,
                company_patient.med_num as medical_no,
                CASE
                    when claim_demographic.id > 0 THEN 1 ElSE 0
                end as claims_processed,
                patients.code as system_code,
                CASE
                    WHEN concat_ws(
                        ' ' :: text,
                        COALESCE(profiles.last_name, '' :: character varying),
                        COALESCE(type_catalogs.code, '' :: character varying),
                        COALESCE(profiles.first_name, '' :: character varying),
                        COALESCE(profiles.middle_name, '' :: character varying)
                    ) = ' ' :: text THEN 'Console' :: text
                    ELSE concat_ws(
                        ' ' :: text,
                        COALESCE(profiles.last_name, '' :: character varying),
                        COALESCE(type_catalogs.code, '' :: character varying),
                        COALESCE(profiles.first_name, '' :: character varying),
                        COALESCE(profiles.middle_name, '' :: character varying)
                    )
                END AS patient_name,
                profiles.date_of_birth as date_of_birth,
                profiles.sex
            from
                patients
                left join profiles on patients.profile_id = profiles.id
                left join type_catalogs on profiles.name_suffix_id = type_catalogs.id
                left join marital_statuses on marital_statuses.id = patients.marital_status_id
                left join company_patient on company_patient.patient_id = patients.id
                left join billing_companies on company_patient.billing_company_id = billing_companies.id
                left join companies on company_patient.company_id = companies.id
                left join claim_demographic on claim_demographic.patient_id = patients.id 
            order by patients.id
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_general_patient');
    }
};

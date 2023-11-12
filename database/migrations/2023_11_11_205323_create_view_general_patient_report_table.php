<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW public.view_general_patient_report
            AS select
            patients.id as id,
            billing_companies_ids as billing_id,
            billing_companies,
            companies,
            medical_no,
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
            profiles.sex,
            coalesce(claims_processed, 0) as claims_processed
        from
            patients
            left join (
                select
                    patient_id,
                    array_to_string(array_agg(cp2.med_num), ', ', '') as medical_no
                from
                    company_patient cp2
                    inner join companies c2 on cp2.company_id = c2.id
                GROUP BY
                    patient_id
            ) cow2 on patients.id = cow2.patient_id
            left join (
                select
                    patient_id,
                    array_to_string(
                        array_agg(concat(bc.abbreviation, ' - ', bc.name)),
                        ', ',
                        ''
                    ) as billing_companies
                from
                    company_patient cp
                    inner join billing_companies bc on cp.billing_company_id = bc.id
                GROUP BY
                    patient_id
            ) cow3 on patients.id = cow3.patient_id
            left join (
                select
                    patient_id,
                    array_to_string(array_agg(concat(c.code, ' - ', c.name)), ', ', '') as companies
                from
                    company_patient cp
                    inner join companies c on cp.company_id = c.id
                GROUP BY
                    patient_id
            ) cow on patients.id = cow.patient_id
            left join (
                select
                    patient_id,
                    json_agg(bc.id) as billing_companies_ids
                from
                    company_patient cp
                    inner join billing_companies bc on cp.billing_company_id = bc.id
                GROUP BY
                    patient_id
            ) comp3 on patients.id = comp3.patient_id
            left join (
                select
                    patient_id,
                    count(claim_demographic.id) as claims_processed
                from
                    claim_demographic
                GROUP BY
                    patient_id
            ) cp on patients.id = cp.patient_id
            left join profiles on patients.profile_id = profiles.id
            left join type_catalogs on profiles.name_suffix_id = type_catalogs.id
            left join marital_statuses on marital_statuses.id = patients.marital_status_id
            order by patients.id
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('view_general_patient_report');
    }
};

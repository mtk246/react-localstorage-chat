<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW public.view_bad_debt_cost
            AS select
                patients.code AS system_code,
                CASE
                    WHEN concat_ws(' '::text, COALESCE(profiles.last_name, ''::character varying), COALESCE(type_catalogs.code, ''::character varying), COALESCE(profiles.first_name, ''::character varying), COALESCE(profiles.middle_name, ''::character varying)) = ' '::text THEN 'Console'::text
                    ELSE concat_ws(' '::text, COALESCE(profiles.last_name, ''::character varying), COALESCE(type_catalogs.code, ''::character varying), COALESCE(profiles.first_name, ''::character varying), COALESCE(profiles.middle_name, ''::character varying))
                END AS patient_name,
                claim_services.claim_id,
                claim_demographic.type_of_medical_assistance as inpatient_outpatient,
                concat( (
                    SELECT
                        entity_abbreviations.abbreviation
                    FROM
                        entity_abbreviations
                    WHERE
                        entity_abbreviations.abbreviable_type::text = 'App\Models\InsuranceCompany'::text
                        AND entity_abbreviations.abbreviable_id = insurance_companies.id
                    LIMIT
                        1
                ), ' - ', insurance_companies.name ) AS primery_insurance,
                'N/A' as secondary_insurance,
                patient_information.admission_date as admission_date,
                patient_information.discharge_date as discharge_date,
                '' as write_off_date,
                (services.days_or_units::numeric * services.price::numeric) as Amount,
                '' as primary_pd_date,
                '' as second_pd_date,
                '' as first_bil_date,
                '' as second_bil_date,
                '' as third_bil_date,
                '' as phone_call_date
            from patients
            inner join claim_demographic on claim_demographic.patient_id = patients.id  
            inner join profiles on profiles.id = patients.profile_id
            left join type_catalogs ON profiles.name_suffix_id = type_catalogs.id
            inner join claim_insurance_policy on claim_insurance_policy.claim_id = claim_demographic.claim_id
            inner join (
                select * from insurance_policies where insurance_policies.type_responsibility_id = 48
            ) as insurance_policies on insurance_policies.id = claim_insurance_policy.insurance_policy_id 
            inner join insurance_plans on insurance_plans.id = insurance_policies.insurance_plan_id
            inner join insurance_companies on insurance_companies.id = insurance_plans.insurance_company_id  
            inner join (
                select * from patient_information where patient_information.admission_date notnull or patient_information.discharge_date notnull
            ) as patient_information on patient_information.claim_id = claim_demographic.id
            inner join claim_services on claim_services.claim_id = claim_insurance_policy.claim_id 
            inner join (
                select 
                    distinct on (services.claim_service_id) claim_service_id,
                    services.price,
                    services.days_or_units
                from services
            ) as services on services.claim_service_id = claim_services.id 
            where claim_demographic.type_of_medical_assistance notnull       
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_bad_debt_cost');
    }
};

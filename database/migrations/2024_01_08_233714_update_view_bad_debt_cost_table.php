<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW public.view_bad_debt_cost
            AS SELECT
                billing_companies.id AS billing_id,
                concat(
                    billing_companies.abbreviation,
                    ' - ',
                    billing_companies.name
                ) AS billing_companies,
                concat( (
                        SELECT
                            entity_abbreviations.abbreviation
                        FROM
                            entity_abbreviations
                        WHERE
                            entity_abbreviations.abbreviable_type:: text = 'App\Models\Company':: text
                            AND entity_abbreviations.abbreviable_id = companies.id
                        LIMIT
                            1
                    ), ' - ', companies.name
                ) AS companies,
                patients.code AS system_code,
                CASE
                    WHEN concat_ws(
                        ' ':: text,
                        COALESCE(
                            profiles.last_name,
                            '':: character varying
                        ),
                        COALESCE(
                            type_catalogs.code,
                            '':: character varying
                        ),
                        COALESCE(
                            profiles.first_name,
                            '':: character varying
                        ),
                        COALESCE(
                            profiles.middle_name,
                            '':: character varying
                        )
                    ) = ' ':: text THEN 'Console':: text
                    ELSE concat_ws(
                        ' ':: text,
                        COALESCE(
                            profiles.last_name,
                            '':: character varying
                        ),
                        COALESCE(
                            type_catalogs.code,
                            '':: character varying
                        ),
                        COALESCE(
                            profiles.first_name,
                            '':: character varying
                        ),
                        COALESCE(
                            profiles.middle_name,
                            '':: character varying
                        )
                    )
                END AS patient_name,
                claim_demographic.type_of_medical_assistance AS inpatient_outpatient,
                concat( (
                        SELECT
                            entity_abbreviations.abbreviation
                        FROM
                            entity_abbreviations
                        WHERE
                            entity_abbreviations.abbreviable_type:: text = 'App\Models\InsuranceCompany':: text
                            AND entity_abbreviations.abbreviable_id = insurance_companies.id
                        LIMIT
                            1
                    ), ' - ', insurance_companies.name
                ) AS primery_insurance,
                'N/A':: text AS secondary_insurance,
                patient_information.admission_date,
                patient_information.discharge_date,
                claim_services.from AS write_off_date,
                services.days_or_units:: numeric * services.price:: numeric AS amount,
                '':: text AS primary_pd_date,
                '':: text AS second_pd_date,
                '':: text AS first_bil_date,
                '':: text AS second_bil_date,
                '':: text AS third_bil_date,
                '':: text AS phone_call_date,
                CASE
                    WHEN (
                        select
                            count(claim_batches.shipping_date)
                        from claim_claim_batch
                            inner join claim_batches on claim_batches.id = claim_claim_batch.claim_batch_id
                        where
                            claim_claim_batch.claim_id = claim_services.claim_id
                    ):: numeric = 1:: numeric THEN (
                        select
                            patient_information.discharge_date as discharge_date
                        from patient_information
                        where
                            patient_information.claim_id = claim_services.claim_id
                        limit
                            1
                    )::text
                    ELSE null
                END AS submission_date,
                claim_demographic.created_at,
                claim_demographic.updated_at,
                (select claim_services.from from claim_services where claim_services.claim_id = claim_demographic.claim_id limit 1) as dos
            FROM patients
                JOIN claim_demographic ON claim_demographic.patient_id = patients.id
                JOIN companies ON companies.id = claim_demographic.company_id
                JOIN billing_company_company ON billing_company_company.company_id = claim_demographic.company_id
                JOIN billing_companies ON billing_companies.id = billing_company_company.billing_company_id
                JOIN profiles ON profiles.id = patients.profile_id
                LEFT JOIN type_catalogs ON profiles.name_suffix_id = type_catalogs.id
                JOIN claim_insurance_policy ON claim_insurance_policy.claim_id = claim_demographic.claim_id
                JOIN (
                    SELECT
                        insurance_policies_1.id,
                        insurance_policies_1.policy_number,
                        insurance_policies_1.group_number,
                        insurance_policies_1.payment_responsibility_level_code,
                        insurance_policies_1.eff_date,
                        insurance_policies_1.end_date,
                        insurance_policies_1.release_info,
                        insurance_policies_1.assign_benefits,
                        insurance_policies_1.insurance_plan_id,
                        insurance_policies_1.created_at,
                        insurance_policies_1.updated_at,
                        insurance_policies_1.payer_responsibility_id,
                        insurance_policies_1.insurance_policy_type_id,
                        insurance_policies_1.type_responsibility_id,
                        insurance_policies_1.billing_company_id,
                        insurance_policies_1.patient_id,
                        insurance_policies_1.status,
                        insurance_policies_1.own,
                        insurance_policies_1.plan_type_id,
                        insurance_policies_1.dual_plan,
                        insurance_policies_1.complementary_policy_id
                    FROM
                        insurance_policies insurance_policies_1
                    WHERE
                        insurance_policies_1.type_responsibility_id = 48
                ) insurance_policies ON insurance_policies.id = claim_insurance_policy.insurance_policy_id
                JOIN insurance_plans ON insurance_plans.id = insurance_policies.insurance_plan_id
                JOIN insurance_companies ON insurance_companies.id = insurance_plans.insurance_company_id
                JOIN (
                    SELECT
                        patient_information_1.id,
                        patient_information_1.claim_id,
                        patient_information_1.admission_date,
                        patient_information_1.admission_time,
                        patient_information_1.discharge_date,
                        patient_information_1.discharge_time,
                        patient_information_1.condition_code_ids,
                        patient_information_1.admission_type_id,
                        patient_information_1.admission_source_id,
                        patient_information_1.patient_status_id,
                        patient_information_1.bill_classification_id,
                        patient_information_1.created_at,
                        patient_information_1.updated_at
                    FROM
                        patient_information patient_information_1
                    WHERE
                        patient_information_1.admission_date IS NOT NULL
                        OR patient_information_1.discharge_date IS NOT NULL
                ) patient_information ON patient_information.claim_id = claim_demographic.id
                JOIN claim_services ON claim_services.claim_id = claim_insurance_policy.claim_id
                JOIN (
                    SELECT
                        DISTINCT ON (services_1.claim_service_id) services_1.claim_service_id,
                        services_1.price,
                        services_1.days_or_units
                    FROM
                        services services_1
                ) services ON services.claim_service_id = claim_services.id
            WHERE
                claim_demographic.type_of_medical_assistance IS NOT NULL;        
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_bad_debt_cost');
    }
};

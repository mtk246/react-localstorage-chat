<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared("
        DROP VIEW IF EXISTS public.view_payer_mix;
        CREATE OR REPLACE VIEW public.view_payer_mix AS
        SELECT
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
            ) AS insurance, (
                SELECT
                    count(
                        claim_insurance_policy_1.insurance_policy_id
                    ) AS count
                FROM
                    claim_insurance_policy claim_insurance_policy_1
                WHERE
                    claim_insurance_policy_1.order = 1
                    AND claim_insurance_policy_1.insurance_policy_id = insurance_policies.id
            ) AS claims_processed, (
                SELECT
                    round(
                        COALESCE(
                            services.days_or_units:: numeric,
                            1:: numeric
                        ) * services.price:: numeric * 100:: numeric / ( (
                                SELECT
                                    sum(
                                        COALESCE(
                                            services_1.days_or_units:: numeric,
                                            1:: numeric
                                        ) * services_1.price:: numeric
                                    ) AS total
                                FROM
                                    claim_demographic claim_demographic_1
                                    JOIN claim_services claim_services_1 ON claim_services_1.claim_id = claim_demographic_1.claim_id
                                    JOIN (
                                        SELECT
                                            DISTINCT ON (services_2.claim_service_id) services_2.claim_service_id,
                                            services_2.days_or_units,
                                            services_2.price
                                        FROM
                                            services services_2
                                    ) services_1 ON services_1.claim_service_id = claim_services_1.id
                                WHERE
                                    claim_demographic_1.company_id = companies.id
                            )
                        ),
                        2
                    ) AS round
                FROM services
                WHERE
                    services.claim_service_id = claim_services.id
                LIMIT
                    1
            ) AS porcentaje, (
                SELECT
                    COALESCE(
                        services.days_or_units:: numeric,
                        1:: numeric
                    ) * services.price:: numeric
                FROM services
                WHERE
                    services.claim_service_id = claim_services.id
                LIMIT
                    1
            ) AS charges,
            0 AS total_payments,
            0 AS payments_amount,
            0 AS total_write_offs,
            0 AS writeoffs_amount,
            0 AS total_denied,
            0 AS denied_amount,
            concat( (
                    SELECT
                        entity_abbreviations.abbreviation
                    FROM
                        entity_abbreviations
                    WHERE
                        entity_abbreviations.abbreviable_type:: text = 'App\Models\InsurancePlan':: text
                        AND entity_abbreviations.abbreviable_id = insurance_plans.id
                    LIMIT
                        1
                ), ' - ', insurance_plans.name
            ) AS plan,
            concat(
                type_catalogs.code,
                '-',
                type_catalogs.description
            ) AS plan_type,
            0 AS total_payments_plan,
            0 AS payments_amount_plan,
            0 AS total_write_offs_plan,
            0 AS writeoffs_amount_plan,
            0 AS total_denied_plan,
            0 AS denied_amount_plan,
            CASE
                WHEN (
                    select
                        count(patient_information.claim_id)
                    from patient_information
                    where
                        patient_information.claim_id = claims.id
                ):: numeric = 1:: numeric THEN (
                    select
                        patient_information.admission_date as admission_date
                    from patient_information
                    where
                        patient_information.claim_id = claims.id
                    limit 1
                )::text
                WHEN (
                    select count(*)
                    from claim_claim_batch
                    where
                        claim_claim_batch.claim_id = claims.id
                ):: numeric = 1:: numeric THEN (
                    select
                        claim_date_informations.from_date
                    from claim_date_informations
                    where
                        claim_date_informations.claim_id = claims.id
                        and claim_date_informations.field_id = 4
                ):: varchar
                ELSE null
            END AS admission_date,
            CASE
                WHEN (
                    select
                        count(patient_information.claim_id)
                    from patient_information
                    where
                        patient_information.claim_id = claims.id
                ):: numeric = 1:: numeric THEN (
                    select
                        patient_information.discharge_date as discharge_date
                    from patient_information
                    where
                        patient_information.claim_id = claims.id
                    limit 1
                )::text
                WHEN (
                    select count(*)
                    from claim_date_informations
                    where
                        claim_date_informations.claim_id = claims.id
                ):: numeric = 1:: numeric THEN (
                    select
                        claim_date_informations.to_date
                    from claim_date_informations
                    where
                        claim_date_informations.claim_id = claims.id
                        and claim_date_informations.field_id = 4
                ):: varchar
                ELSE null
            END AS discharge_date,
            CASE
                WHEN (
                    select
                        count(claim_batches.shipping_date)
                    from claim_claim_batch
                        inner join claim_batches on claim_batches.id = claim_claim_batch.claim_batch_id
                    where
                        claim_claim_batch.claim_id = claims.id
                ):: numeric = 1:: numeric THEN (
                    select
                        patient_information.discharge_date as discharge_date
                    from patient_information
                    where
                        patient_information.claim_id = claims.id
                    limit
                        1
                )::text
                ELSE null
            END AS submission_date,
            (select claim_services.from from claim_services where claim_services.claim_id = claims.id) as dos,
            date(claims.created_at) as created_at,
            date(claims.updated_at) as updated_at
        FROM claims
            JOIN billing_companies ON billing_companies.id = claims.billing_company_id
            JOIN claim_demographic ON claim_demographic.claim_id = claims.id
            JOIN companies ON companies.id = claim_demographic.company_id
            JOIN (
                SELECT
                    DISTINCT ON (
                        claim_insurance_policy_1.insurance_policy_id
                    ) claim_insurance_policy_1.insurance_policy_id,
                    claim_insurance_policy_1.claim_id
                FROM
                    claim_insurance_policy claim_insurance_policy_1
                WHERE
                    claim_insurance_policy_1.order = 1
            ) claim_insurance_policy ON claim_insurance_policy.claim_id = claims.id
            JOIN (
                SELECT
                    DISTINCT ON (
                        insurance_policies_1.insurance_plan_id
                    ) insurance_policies_1.insurance_plan_id,
                    insurance_policies_1.policy_number,
                    insurance_policies_1.id
                FROM
                    insurance_policies insurance_policies_1
            ) insurance_policies ON insurance_policies.id = claim_insurance_policy.insurance_policy_id
            JOIN insurance_plans ON insurance_plans.id = insurance_policies.insurance_plan_id
            JOIN insurance_plan_plan_type ON insurance_plan_plan_type.insurance_plan_id = insurance_plans.id
            JOIN type_catalogs ON type_catalogs.id = insurance_plans.plan_type_id
            JOIN insurance_companies ON insurance_companies.id = insurance_plans.insurance_company_id
            JOIN claim_services ON claim_services.claim_id = claim_insurance_policy.claim_id
            LEFT JOIN (
                SELECT
                    sum(company_services.price) AS total_company,
                    company_services.company_id
                FROM
                    company_services
                GROUP BY
                    company_services.company_id
            ) sc ON claim_demographic.company_id = sc.company_id;
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_payer_mix');
    }
};

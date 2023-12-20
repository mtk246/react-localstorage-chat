<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
        DROP VIEW IF EXISTS public.view_payer_mix;
        CREATE OR REPLACE VIEW public.view_payer_mix AS
        select
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
                        entity_abbreviations.abbreviable_type::text = 'App\Models\Company'::text
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
                        entity_abbreviations.abbreviable_type::text = 'App\Models\InsuranceCompany'::text
                        AND entity_abbreviations.abbreviable_id = insurance_companies.id
                    LIMIT
                        1
                ), ' - ', insurance_companies.name
            ) AS insurance, (
                select
                    count(
                        claim_insurance_policy.insurance_policy_id
                    )
                from
                    claim_insurance_policy
                where
                    claim_insurance_policy.order = 1
                    and claim_insurance_policy.insurance_policy_id = insurance_policies.id
            ) as claims_processed, (
                select
                    round( (
                            COALESCE(
                                services.days_or_units::numeric,
                                1::numeric
                            ) * services.price::numeric
                        ) * 100::numeric / (
                            select
                                sum(
                                    COALESCE(
                                        services.days_or_units::numeric,
                                        1::numeric
                                    ) * services.price::numeric
                                ) as total
                            from claim_demographic
                                inner join claim_services on claim_services.claim_id = claim_demographic.claim_id
                                inner join (
                                    select
                                        distinct on (services.claim_service_id) claim_service_id,
                                        services.days_or_units,
                                        services.price
                                    from
                                        services
                                ) as services on services.claim_service_id = claim_services.id
                            where
                                claim_demographic.company_id = companies.id
                        ),
                        2
                    )
                from services
                where
                    services.claim_service_id = claim_services.id
                limit 1
            ) as porcentaje,  
            (
                select
                        COALESCE(
                            services.days_or_units::numeric,
                            1::numeric
                        ) * services.price::numeric
                from services
                where
                    services.claim_service_id = claim_services.id
                limit
                    1
            ) as charges,
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
                        entity_abbreviations.abbreviable_type::text = 'App\Models\InsurancePlan'::text
                        AND entity_abbreviations.abbreviable_id = insurance_plans.id
                    LIMIT
                        1
                ), ' - ', insurance_plans.name
            ) as plan,
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
            0 AS denied_amount_plan
        from claims
            inner join billing_companies on billing_companies.id = claims.billing_company_id
            inner join claim_demographic on claim_demographic.claim_id = claims.id
            inner join companies on companies.id = claim_demographic.company_id
            inner join (
                select
                    distinct on (
                        claim_insurance_policy.insurance_policy_id
                    ) insurance_policy_id,
                    claim_insurance_policy.claim_id
                from claim_insurance_policy
                where
                    claim_insurance_policy.order = 1
            ) as claim_insurance_policy on claim_insurance_policy.claim_id = claims.id
            inner join (
                select
                    distinct on (
                        insurance_policies.insurance_plan_id
                    ) insurance_plan_id,
                    insurance_policies.policy_number,
                    insurance_policies.id
                from
                    insurance_policies
            ) as insurance_policies on insurance_policies.id = claim_insurance_policy.insurance_policy_id
            inner join insurance_plans on insurance_plans.id = insurance_policies.insurance_plan_id
            inner join insurance_plan_plan_type on insurance_plan_plan_type.insurance_plan_id = insurance_plans.id
            inner join type_catalogs ON type_catalogs.id = insurance_plans.plan_type_id
            inner join insurance_companies on insurance_companies.id = insurance_plans.insurance_company_id
            inner join claim_services ON claim_services.claim_id = claim_insurance_policy.claim_id
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

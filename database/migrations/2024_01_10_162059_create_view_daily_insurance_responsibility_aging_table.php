<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW public.view_daily_insurance_responsibility_aging
            AS select
                billing_companies.id AS billing_id,
                concat(billing_companies.code, '-', billing_companies.name) as billing_companies,
                concat(
                    UPPER( 
                        (
                            SELECT entity_abbreviations.abbreviation 
                            FROM entity_abbreviations 
                            WHERE entity_abbreviations.abbreviable_type::text = 'App\Models\InsuranceCompany'::text AND entity_abbreviations.abbreviable_id = insurance_companies.id LIMIT 1
                        )
                    ), 
                    ': ', insurance_companies.name
                ) AS insurance,
                COALESCE(
                    round(
                        (
                            select
                                sum(services.price::numeric * services.days_or_units::numeric) as total
                            from claim_insurance_policy
                            inner join claim_services on claim_services.claim_id = claim_insurance_policy.claim_id
                            inner join services on services.claim_service_id = claim_services.id 
                            inner join insurance_policies on insurance_policies.id = claim_insurance_policy.insurance_policy_id 
                            inner join insurance_plans on insurance_plans.id = insurance_policies.insurance_plan_id
                            inner join insurance_companies as insurance_companiesII on insurance_companiesII.id = insurance_plans.insurance_company_id 
                            where insurance_companiesII.id = insurance_companies.id and DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 0 and 30
                        )::numeric, 
                        2
                    ),
                    round(0, 2)::numeric
                ) as first_period,
                COALESCE(
                    round(
                        (
                            select
                                sum(services.price::numeric * services.days_or_units::numeric) as total
                            from claim_insurance_policy
                            inner join claim_services on claim_services.claim_id = claim_insurance_policy.claim_id
                            inner join services on services.claim_service_id = claim_services.id 
                            inner join insurance_policies on insurance_policies.id = claim_insurance_policy.insurance_policy_id 
                            inner join insurance_plans on insurance_plans.id = insurance_policies.insurance_plan_id
                            inner join insurance_companies as insurance_companiesII on insurance_companiesII.id = insurance_plans.insurance_company_id 
                            where insurance_companiesII.id = insurance_companies.id and DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 31 and 60
                        )::numeric, 
                        2
                    ),
                    round(0, 2)::numeric
                ) as second_period,
                COALESCE(
                    round(
                        (
                            select
                                sum(services.price::numeric * services.days_or_units::numeric) as total
                            from claim_insurance_policy
                            inner join claim_services on claim_services.claim_id = claim_insurance_policy.claim_id
                            inner join services on services.claim_service_id = claim_services.id 
                            inner join insurance_policies on insurance_policies.id = claim_insurance_policy.insurance_policy_id 
                            inner join insurance_plans on insurance_plans.id = insurance_policies.insurance_plan_id
                            inner join insurance_companies as insurance_companiesII on insurance_companiesII.id = insurance_plans.insurance_company_id 
                            where insurance_companiesII.id = insurance_companies.id and DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 61 and 90
                        )::numeric, 
                        2
                    ),
                    round(0, 2)::numeric
                ) as third_period,
                COALESCE(
                    round(
                        (
                            select
                                sum(services.price::numeric * services.days_or_units::numeric) as total
                            from claim_insurance_policy
                            inner join claim_services on claim_services.claim_id = claim_insurance_policy.claim_id
                            inner join services on services.claim_service_id = claim_services.id 
                            inner join insurance_policies on insurance_policies.id = claim_insurance_policy.insurance_policy_id 
                            inner join insurance_plans on insurance_plans.id = insurance_policies.insurance_plan_id
                            inner join insurance_companies as insurance_companiesII on insurance_companiesII.id = insurance_plans.insurance_company_id 
                            where insurance_companiesII.id = insurance_companies.id and DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 91 and 120
                        )::numeric, 
                        2
                    ),
                    round(0, 2)::numeric
                ) as fourth_period,
                COALESCE(
                    round(
                        (
                            select
                                sum(services.price::numeric * services.days_or_units::numeric) as total
                            from claim_insurance_policy
                            inner join claim_services on claim_services.claim_id = claim_insurance_policy.claim_id
                            inner join services on services.claim_service_id = claim_services.id 
                            inner join insurance_policies on insurance_policies.id = claim_insurance_policy.insurance_policy_id 
                            inner join insurance_plans on insurance_plans.id = insurance_policies.insurance_plan_id
                            inner join insurance_companies as insurance_companiesII on insurance_companiesII.id = insurance_plans.insurance_company_id 
                            where insurance_companiesII.id = insurance_companies.id and DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 121 and 150
                        )::numeric, 
                        2
                    ),
                    round(0, 2)::numeric
                ) as Fifth_period,
                COALESCE(
                    round(
                        (
                            select
                                sum(services.price::numeric * services.days_or_units::numeric) as total
                            from claim_insurance_policy
                            inner join claim_services on claim_services.claim_id = claim_insurance_policy.claim_id
                            inner join services on services.claim_service_id = claim_services.id 
                            inner join insurance_policies on insurance_policies.id = claim_insurance_policy.insurance_policy_id 
                            inner join insurance_plans on insurance_plans.id = insurance_policies.insurance_plan_id
                            inner join insurance_companies as insurance_companiesII on insurance_companiesII.id = insurance_plans.insurance_company_id 
                            where insurance_companiesII.id = insurance_companies.id and DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 151 and 180
                        )::numeric, 
                        2
                    ),
                    round(0, 2)::numeric
                ) as sixth_period,
                COALESCE(
                    round(
                        (
                            select
                                sum(services.price::numeric * services.days_or_units::numeric) as total
                            from claim_insurance_policy
                            inner join claim_services on claim_services.claim_id = claim_insurance_policy.claim_id
                            inner join services on services.claim_service_id = claim_services.id 
                            inner join insurance_policies on insurance_policies.id = claim_insurance_policy.insurance_policy_id 
                            inner join insurance_plans on insurance_plans.id = insurance_policies.insurance_plan_id
                            inner join insurance_companies as insurance_companiesII on insurance_companiesII.id = insurance_plans.insurance_company_id 
                            where insurance_companiesII.id = insurance_companies.id and DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 181 and 210
                        )::numeric, 
                        2
                    ),
                    round(0, 2)::numeric
                ) as seventh_period,
                COALESCE(
                    round(
                        (
                            select
                                sum(services.price::numeric * services.days_or_units::numeric) as total
                            from claim_insurance_policy
                            inner join claim_services on claim_services.claim_id = claim_insurance_policy.claim_id
                            inner join services on services.claim_service_id = claim_services.id 
                            inner join insurance_policies on insurance_policies.id = claim_insurance_policy.insurance_policy_id 
                            inner join insurance_plans on insurance_plans.id = insurance_policies.insurance_plan_id
                            inner join insurance_companies as insurance_companiesII on insurance_companiesII.id = insurance_plans.insurance_company_id 
                            where insurance_companiesII.id = insurance_companies.id and DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 211 and 240
                        )::numeric, 
                        2
                    ),
                    round(0, 2)::numeric
                ) as eighth_period,
                COALESCE(
                    round(
                        (
                            select
                                sum(services.price::numeric * services.days_or_units::numeric) as total
                            from claim_insurance_policy
                            inner join claim_services on claim_services.claim_id = claim_insurance_policy.claim_id
                            inner join services on services.claim_service_id = claim_services.id 
                            inner join insurance_policies on insurance_policies.id = claim_insurance_policy.insurance_policy_id 
                            inner join insurance_plans on insurance_plans.id = insurance_policies.insurance_plan_id
                            inner join insurance_companies as insurance_companiesII on insurance_companiesII.id = insurance_plans.insurance_company_id 
                            where insurance_companiesII.id = insurance_companies.id and DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) > 241
                        )::numeric, 
                        2
                    ),
                    round(0, 2)::numeric
                ) as ninth_period,
                COALESCE(
                    round(
                        (
                            select 
                                sum(services.price::numeric  * services.days_or_units::numeric) as total_again
                            from claim_insurance_policy
                            inner join claim_services on claim_services.claim_id = claim_insurance_policy.claim_id
                            inner join services on services.claim_service_id = claim_services.id 
                            inner join insurance_policies on insurance_policies.id = claim_insurance_policy.insurance_policy_id 
                            inner join insurance_plans on insurance_plans.id = insurance_policies.insurance_plan_id
                            inner join insurance_companies as insurance_companiesII on insurance_companiesII.id = insurance_plans.insurance_company_id 
                            where insurance_companiesII.id = insurance_companies.id
                        )::numeric, 
                        2
                    ),
                    round(0, 2)::numeric
                ) as total_again
            FROM insurance_companies
            inner join billing_company_insurance_company on billing_company_insurance_company.insurance_company_id = insurance_companies.id
            inner join billing_companies on billing_companies.id = billing_company_insurance_company.billing_company_id
            order by insurance asc
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_daily_insurance_responsibility_aging');
    }
};

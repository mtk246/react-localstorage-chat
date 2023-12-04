<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW public.view_payer_mix
                AS select
                billing_companies.id as billing_company_id,
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
                concat(
                    insurance_companies.code,
                    '-',
                    insurance_companies.name
                ) as insurance,
                claims_processed,
                round( (
                        COALESCE(
                            services.days_or_units:: numeric,
                            1:: numeric
                        ) * services.price:: numeric
                    ) * 100:: numeric / total_company:: numeric,
                    2
                ) as porcentaje,
                COALESCE(
                    services.days_or_units:: numeric,
                    1:: numeric
                ) * services.price:: numeric AS charges,
                0 as total_payments,
                0 as payments_amount,
                0 as total_write_offs,
                0 as writeoffs_amount,
                0 as total_denied,
                0 as denied_amount,
                concat(
                    insurance_plans.code,
                    '-',
                    insurance_plans.name
                ) as plan,
                concat(
                    type_catalogs.code,
                    '-',
                    type_catalogs.description
                ) as plan_type
            from billing_companies
                join insurance_policies on insurance_policies.billing_company_id = billing_companies.id
                join insurance_plans on insurance_plans.id = insurance_policies.insurance_plan_id
                join type_catalogs on type_catalogs.id = insurance_plans.plan_type_id
                join insurance_companies on insurance_companies.id = insurance_plans.insurance_company_id
                join (
                    SELECT
                        claim_insurance_policy.insurance_policy_id,
                        count(claim_insurance_policy.id) AS claims_processed
                    FROM
                        claim_insurance_policy
                    where
                        claim_insurance_policy.order = 1
                    GROUP BY
                        claim_insurance_policy.insurance_policy_id
                ) cp ON insurance_policies.id = cp.insurance_policy_id
                left join claim_insurance_policy on claim_insurance_policy.insurance_policy_id = insurance_policies.id
                and claim_insurance_policy.order = 1
                left join claim_demographic on claim_demographic.claim_id = claim_insurance_policy.claim_id
                left join companies on companies.id = claim_demographic.company_id
                left join claim_services on claim_services.claim_id = claim_insurance_policy.claim_id
                left join services on claim_services.id = services.claim_service_id
                left join (
                    select
                        sum(company_services.price) as total_company,
                        company_services.company_id
                    from company_services
                    group by
                        company_services.company_id
                ) sc on claim_demographic.company_id = sc.company_id
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_payer_mix');
    }
};

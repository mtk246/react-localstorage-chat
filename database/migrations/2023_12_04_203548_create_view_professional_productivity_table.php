<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW public.view_professional_productivity
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
                    profiles.first_name,
                    ' ',
                    profiles.name_suffix_id,
                    ', ',
                    profiles.first_name,
                    ' ',
                    profiles.middle_name
                ) AS healthcare_professional,
                health_professionals.npi,
                concat(
                    SPLIT_PART(facilities.code, '-', 1),
                    '-',
                    facilities.name
                ) as facility,
                patient_count,
                claims_processed,
                COALESCE(
                    services.days_or_units:: numeric,
                    1:: numeric
                ) * services.price:: numeric AS charges,
                COALESCE(
                    charge_count.total:: numeric,
                    1:: numeric
                ) as charge_count,
                COALESCE(
                    claim_health_professional.total:: numeric,
                    1:: numeric
                ) as distinct_charge_count,
                0 as total_payments,
                0 as payments_amount,
                0 as total_write_offs,
                0 as writeoffs_amount,
                0 as total_denied,
                0 as denied_amount
            from billing_companies
                join company_health_professional on company_health_professional.billing_company_id = billing_companies.id
                join companies on companies.id = company_health_professional.company_id and company_health_professional.billing_company_id = billing_companies.id
                join health_professionals on health_professionals.id = company_health_professional.health_professional_id and company_health_professional.billing_company_id = billing_companies.id
                join profiles on profiles.id = health_professionals.profile_id --join claim_health_professional on claim_health_professional.health_professional_id = health_professionals.id
                left join (
                    select
                        distinct claim_health_professional.claim_id,
                        claim_health_professional.health_professional_id,
                        count(
                            claim_health_professional.claim_id
                        ) as total
                    from
                        claim_health_professional
                    group by
                        claim_health_professional.health_professional_id,
                        claim_health_professional.claim_id
                ) as claim_health_professional on claim_health_professional.health_professional_id = health_professionals.id
                join (
                    select
                        count(claim_demographic.id) as patient_count,
                        claim_demographic.claim_id
                    from claim_demographic
                    group by
                        claim_demographic.claim_id
                ) cd on claim_health_professional.claim_id = cd.claim_id
                join (
                    SELECT
                        claim_services.claim_id,
                        count(claim_services.id) AS claims_processed
                    FROM claim_services
                    GROUP BY
                        claim_services.claim_id
                ) cp ON claim_health_professional.claim_id = cp.claim_id
                left join claim_services on claim_services.claim_id = claim_health_professional.claim_id
                left join claim_demographic on claim_demographic.claim_id = claim_health_professional.claim_id
                left join facilities on facilities.id = claim_demographic.facility_id
                left join services on claim_services.id = services.claim_service_id
                left join (
                    select
                        sum(company_services.price) as total_company,
                        company_services.company_id
                    from company_services
                    group by
                        company_services.company_id
                ) sc on companies.id = sc.company_id
                left join (
                    select
                        claim_health_professional.health_professional_id,
                        count(
                            claim_health_professional.claim_id
                        ) as total
                    from
                        claim_health_professional
                    group by
                        claim_health_professional.health_professional_id
                ) as charge_count on charge_count.health_professional_id = health_professionals.id
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_professional_productivity');
    }
};

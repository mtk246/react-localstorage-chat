<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
        DROP VIEW IF EXISTS public.view_professional_productivity;
        CREATE OR REPLACE VIEW public.view_professional_productivity
        AS select
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
            concat( (
                    SELECT
                        entity_abbreviations.abbreviation
                    FROM
                        entity_abbreviations
                    WHERE
                        entity_abbreviations.abbreviable_type::text = 'App\Models\Facility'::text
                        AND entity_abbreviations.abbreviable_id = facilities.id
                    LIMIT
                        1
                ), ' - ', facilities.name
            ) AS facility, (
                select
                    count(claim_demographic.patient_id)
                from
                    claim_health_professional
                    join (
                        select
                            distinct claim_demographic.patient_id,
                            claim_demographic.claim_id
                        from
                            claim_demographic
                    ) as claim_demographic on claim_demographic.claim_id = claim_health_professional.claim_id
                where
                    claim_health_professional.health_professional_id = health_professionals.id
                group by
                    claim_health_professional.health_professional_id
            ) as patient_count, (
                select
                    COALESCE(
                        count(
                            claim_health_professional.claim_id
                        )::numeric,
                        0::numeric
                    )
                from
                    claim_health_professional
                where
                    claim_health_professional.health_professional_id = health_professionals.id
            ) as claims_processed, (
                select
                    count(
                        distinct services.procedure_id
                    )
                from services
                where
                    services.claim_service_id = claim_services.id
            ) as distinct_charge_count, (
                select
                    count(services.procedure_id)
                from services
                where
                    services.claim_service_id = claim_services.id
            ) as charge_count, (
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
            ) as charges_amount,
            0 AS payments_amount,
            0 AS writeoffs_amount,
            0 AS porcentaje_insurance_payments,
            0 as insurance_payments,
            0 AS porcentaje_patient_payments,
            0 AS patient_payment
        from health_professionals
            inner JOIN profiles ON profiles.id = health_professionals.profile_id
            inner join company_health_professional on company_health_professional.health_professional_id = health_professionals.id
            inner join billing_companies on billing_companies.id = company_health_professional.billing_company_id
            inner join companies on companies.id = company_health_professional.company_id
            inner join (
                select
                    distinct on (
                        claim_health_professional.health_professional_id
                    ) health_professional_id,
                    claim_health_professional.claim_id
                from
                    claim_health_professional
            ) as claim_health_professional on claim_health_professional.health_professional_id = health_professionals.id
            inner join claim_services on claim_services.claim_id = claim_health_professional.claim_id
            inner join claim_demographic on claim_demographic.claim_id = claim_health_professional.claim_id
            inner join facilities on facilities.id = claim_demographic.facility_id
            inner join (
                select
                    distinct on (services.claim_service_id) claim_service_id,
                    services.price,
                    services.days_or_units
                from
                    services
            ) as services on services.claim_service_id = claim_services.id
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_professional_productivity');
    }
};

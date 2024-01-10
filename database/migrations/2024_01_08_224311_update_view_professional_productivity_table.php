<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared("
        DROP VIEW IF EXISTS public.view_professional_productivity;
        CREATE OR REPLACE VIEW public.view_professional_productivity
        AS SELECT 
            billing_companies.id AS billing_id,
            concat(billing_companies.abbreviation, ' - ', billing_companies.name) AS billing_companies,
            concat(( SELECT entity_abbreviations.abbreviation
                FROM entity_abbreviations
                WHERE entity_abbreviations.abbreviable_type::text = 'App\Models\Company'::text AND entity_abbreviations.abbreviable_id = companies.id
                LIMIT 1), ' - ', companies.name) AS companies,
            concat(profiles.first_name, ' ', profiles.name_suffix_id, ', ', profiles.first_name, ' ', profiles.middle_name) AS healthcare_professional,
            health_professionals.npi,
            concat(( SELECT entity_abbreviations.abbreviation
                FROM entity_abbreviations
                WHERE entity_abbreviations.abbreviable_type::text = 'App\Models\Facility'::text AND entity_abbreviations.abbreviable_id = facilities.id
                LIMIT 1), ' - ', facilities.name) AS facility,
            ( SELECT count(claim_demographic_1.patient_id) AS count
                FROM claim_health_professional claim_health_professional_1
                    JOIN ( SELECT DISTINCT claim_demographic_2.patient_id,
                            claim_demographic_2.claim_id
                        FROM claim_demographic claim_demographic_2) claim_demographic_1 ON claim_demographic_1.claim_id = claim_health_professional_1.claim_id
                WHERE claim_health_professional_1.health_professional_id = health_professionals.id
                GROUP BY claim_health_professional_1.health_professional_id) AS patient_count,
            ( SELECT COALESCE(count(claim_health_professional_1.claim_id)::numeric, 0::numeric) AS coalesce
                FROM claim_health_professional claim_health_professional_1
                WHERE claim_health_professional_1.health_professional_id = health_professionals.id) AS claims_processed,
            ( SELECT count(DISTINCT services_1.procedure_id) AS count
                FROM services services_1
                WHERE services_1.claim_service_id = claim_services.id) AS distinct_charge_count,
            ( SELECT count(services_1.procedure_id) AS count
                FROM services services_1
                WHERE services_1.claim_service_id = claim_services.id) AS charge_count,
            ( SELECT COALESCE(services_1.days_or_units::numeric, 1::numeric) * services_1.price::numeric
                FROM services services_1
                WHERE services_1.claim_service_id = claim_services.id
                LIMIT 1) AS charges_amount,
            0 AS payments_amount,
            0 AS writeoffs_amount,
            0 AS porcentaje_insurance_payments,
            0 AS insurance_payments,
            0 AS porcentaje_patient_payments,
            0 AS patient_payment,
                CASE
                    WHEN (( SELECT count(patient_information.claim_id) AS count
                    FROM patient_information
                    WHERE patient_information.claim_id = claim_health_professional.claim_id))::numeric = 1::numeric THEN ( SELECT patient_information.admission_date AS admission_date
                    FROM patient_information
                    WHERE patient_information.claim_id = claim_health_professional.claim_id
                    LIMIT 1)::text
                    WHEN (( SELECT count(*) AS count
                    FROM claim_claim_batch
                    WHERE claim_claim_batch.claim_id = claim_health_professional.claim_id))::numeric = 1::numeric THEN ((( SELECT claim_date_informations.from_date
                    FROM claim_date_informations
                    WHERE claim_date_informations.claim_id = claim_health_professional.claim_id AND claim_date_informations.field_id = 4))::character varying)::text
                    ELSE null
                END AS admission_date,
                CASE
                    WHEN (( SELECT count(patient_information.claim_id) AS count
                    FROM patient_information
                    WHERE patient_information.claim_id = claim_health_professional.claim_id))::numeric = 1::numeric THEN ( SELECT patient_information.discharge_date AS discharge_date
                    FROM patient_information
                    WHERE patient_information.claim_id = claim_health_professional.claim_id
                    LIMIT 1)::text
                    WHEN (( SELECT count(*) AS count
                    FROM claim_date_informations
                    WHERE claim_date_informations.claim_id = claim_health_professional.claim_id))::numeric = 1::numeric THEN ((( SELECT claim_date_informations.to_date
                    FROM claim_date_informations
                    WHERE claim_date_informations.claim_id = claim_health_professional.claim_id AND claim_date_informations.field_id = 4))::character varying)::text
                    ELSE null
                END AS discharge_date,
                CASE
                    WHEN (( SELECT count(claim_batches.shipping_date) AS count
                    FROM claim_claim_batch
                        JOIN claim_batches ON claim_batches.id = claim_claim_batch.claim_batch_id
                    WHERE claim_claim_batch.claim_id = claim_health_professional.claim_id))::numeric = 1::numeric THEN ( SELECT patient_information.discharge_date AS discharge_date
                    FROM patient_information
                    WHERE patient_information.claim_id = claim_health_professional.claim_id
                    LIMIT 1)::text
                    ELSE null
                END AS submission_date,
            (select claim_services.from from claim_services where claim_services.claim_id = claim_health_professional.claim_id) as dos,
            date(claim_health_professional.created_at) AS created_at,
            date(claim_health_professional.updated_at) AS updated_at
        FROM health_professionals
            JOIN profiles ON profiles.id = health_professionals.profile_id
            JOIN company_health_professional ON company_health_professional.health_professional_id = health_professionals.id
            JOIN billing_companies ON billing_companies.id = company_health_professional.billing_company_id
            JOIN companies ON companies.id = company_health_professional.company_id
            JOIN ( SELECT DISTINCT ON (claim_health_professional_1.health_professional_id) claim_health_professional_1.health_professional_id,
                    claim_health_professional_1.claim_id,
                    claim_health_professional_1.created_at,
                    claim_health_professional_1.updated_at
                FROM claim_health_professional claim_health_professional_1) claim_health_professional ON claim_health_professional.health_professional_id = health_professionals.id
            JOIN claim_services ON claim_services.claim_id = claim_health_professional.claim_id
            JOIN claim_demographic ON claim_demographic.claim_id = claim_health_professional.claim_id
            JOIN facilities ON facilities.id = claim_demographic.facility_id
            JOIN ( SELECT DISTINCT ON (services_1.claim_service_id) services_1.claim_service_id,
                    services_1.price,
                    services_1.days_or_units
                FROM services services_1) services ON services.claim_service_id = claim_services.id;
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_professional_productivity');
    }
};

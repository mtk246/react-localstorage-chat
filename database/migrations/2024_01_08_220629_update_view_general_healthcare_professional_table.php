<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared("
        DROP VIEW IF EXISTS public.view_general_healthcare_professional;
        CREATE OR REPLACE VIEW public.view_general_healthcare_professional
        AS SELECT
            row_number() OVER () AS id,
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
            health_professionals.code AS system_code,
            concat(
                p.first_name,
                ' ',
                p.name_suffix_id,
                ', ',
                p.first_name,
                ' ',
                p.middle_name
            ) AS healthcare_professional,
            health_professionals.npi,
            concat(t.tax_id, ' ', t.name) AS primary_taxonomy,
            CASE
                WHEN health_professional_types.type = '1'::text THEN 'Medical doctor'::text
                WHEN health_professional_types.type = '2'::text THEN 'Nurse practitioners'::text
                WHEN health_professional_types.type = '3'::text THEN 'Physician assistants'::text
                WHEN health_professional_types.type = '4'::text THEN 'Certified nurse specialists trained in a particular field such as E/R, pediatric or diabetic nursing'::text
                WHEN health_professional_types.type = '5'::text THEN 'Certified nurse midwives'::text
                WHEN health_professional_types.type = '6'::text THEN 'Certified registered nurse anesthetists'::text
                WHEN health_professional_types.type = '7'::text THEN 'Clinical social worker'::text
                WHEN health_professional_types.type = '8'::text THEN 'Physical therapists'::text
                ELSE NULL::text
            END AS health_professional_type,
            CASE
                WHEN company_health_professional.authorization = '[1]'::text THEN 'Service provider'::text
                WHEN company_health_professional.authorization = '[1,2]'::text THEN 'Service provider, Billing provider'::text
                WHEN company_health_professional.authorization = '[1,2,3]'::text THEN 'Service provider, Billing provider, Referred'::text
                WHEN company_health_professional.authorization = '[1,3]'::text THEN 'Service provider, Referred'::text
                WHEN company_health_professional.authorization = '[2]'::text THEN 'Billing provider'::text
                WHEN company_health_professional.authorization = '[2,3]'::text THEN 'Billing provider, Referred'::text
                WHEN company_health_professional.authorization = '[3]'::text THEN 'Referred'::text
                ELSE NULL::text
            END AS health_professional_role,
            COALESCE(
                cp.claims_processed,
                0::bigint
            ) AS claims_processed,
            date(health_professionals.created_at) as created_at,
            date(health_professionals.updated_at) as updated_at
        FROM health_professionals
            LEFT JOIN profiles p ON health_professionals.profile_id = p.id
            LEFT JOIN (
                select
                    distinct health_professional_taxonomy.health_professional_id,
                    health_professional_taxonomy.taxonomy_id
                from
                    health_professional_taxonomy
            ) as hpt ON hpt.health_professional_id = health_professionals.id
            LEFT JOIN taxonomies t ON hpt.taxonomy_id = t.id
            LEFT JOIN (
                select
                    distinct company_health_professional.health_professional_id,
                    company_health_professional.authorization,
                    company_health_professional.company_id,
                    company_health_professional.billing_company_id
                from
                    company_health_professional
            ) as company_health_professional ON company_health_professional.health_professional_id = health_professionals.id
            LEFT JOIN companies ON companies.id = company_health_professional.company_id
            LEFT JOIN billing_companies ON billing_companies.id = company_health_professional.billing_company_id
            LEFT JOIN (
                select
                    distinct health_professional_types.health_professional_id,
                    health_professional_types.id,
                    health_professional_types.type
                from
                    health_professional_types
            ) as health_professional_types ON health_professional_types.health_professional_id = health_professionals.id
            LEFT JOIN (
                SELECT
                    chp2.health_professional_id,
                    count(chp2.id) AS claims_processed
                FROM
                    claim_health_professional chp2
                GROUP BY
                    chp2.health_professional_id
            ) cp ON health_professionals.id = cp.health_professional_id
        ORDER BY
            health_professionals.id;
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_general_healthcare_professional');
    }
};

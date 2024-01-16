<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared("
        DROP VIEW IF EXISTS public.view_general_facility;
        CREATE OR REPLACE VIEW public.view_general_facility
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
            facilities.code,
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
            ) AS facility,
            facilities.npi,
            concat(
                taxonomies.tax_id,
                ' ',
                taxonomies.name
            ) AS primary_taxonomy,
            place_of_services.name AS place_of_service,
            helcomp.classifications AS bill_classifications, (
                SELECT
                    count(claim_demographic.id)
                FROM claim_demographic
                where
                    claim_demographic.facility_id = facilities.id
            ) as claims_processed,
            date(facilities.created_at) as created_at,
            date(facilities.updated_at) as updated_at
        from facilities
            inner join (
                select *
                from facility_taxonomy
                where
                    facility_taxonomy.primary = true
            ) as facility_taxonomy ON facility_taxonomy.facility_id = facilities.id
            inner join taxonomies ON taxonomies.id = facility_taxonomy.taxonomy_id
            inner join (
                select
                    distinct on (company_facility.facility_id) facility_id,
                    company_facility.company_id,
                    company_facility.billing_company_id
                from
                    company_facility
            ) as company_facility ON company_facility.facility_id = facilities.id
            inner join companies ON companies.id = company_facility.company_id
            inner join billing_company_facility ON billing_company_facility.facility_id = facilities.id
            inner join billing_companies ON billing_companies.id = billing_company_facility.billing_company_id
            inner join (
                select
                    distinct on (
                        facility_place_of_service.facility_id
                    ) facility_id,
                    facility_place_of_service.place_of_service_id
                from
                    facility_place_of_service
            ) as facility_place_of_service ON facility_place_of_service.facility_id = facilities.id
            inner join place_of_services ON place_of_services.id = facility_place_of_service.place_of_service_id
            inner join (
                select
                    distinct on (
                        facility_facility_type.facility_id
                    ) facility_id,
                    facility_facility_type.facility_type_id
                from
                    facility_facility_type
            ) as facility_facility_type ON facility_facility_type.facility_id = facilities.id
            inner join facility_types ON facility_types.id = facility_facility_type.facility_type_id
            JOIN (
                SELECT
                    facility_types_1.id,
                    array_to_string(
                        array_agg(bill_classifications.name),
                        ', '::text,
                        ''::text
                    ) AS classifications
                FROM
                    facility_types facility_types_1
                    JOIN bill_classifications ON facility_types_1.code::text = bill_classifications.code::text
                GROUP BY
                    facility_types_1.id
            ) helcomp ON helcomp.id = facility_facility_type.facility_type_id

        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_general_facility');
    }
};

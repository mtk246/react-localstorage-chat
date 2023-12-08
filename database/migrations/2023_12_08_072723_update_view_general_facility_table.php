<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared("
            DROP VIEW IF EXISTS public.view_general_facility;
            CREATE OR REPLACE VIEW public.view_general_facility AS 
                SELECT
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
                                entity_abbreviations.abbreviable_type:: text = 'App\Models\Company':: text
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
                                entity_abbreviations.abbreviable_type:: text = 'App\Models\Facility':: text
                                AND entity_abbreviations.abbreviable_id = facilities.id
                            LIMIT
                                1
                        ), ' - ', facilities.name
                    ) AS facility,
                    facilities.npi,
                    concat(t.tax_id, ' ', t.name) AS primary_taxonomy,
                    place_of_services.name AS place_of_service,
                    facility_types.type AS type_of_facility,
                    classifications as bill_classifications,
                    COALESCE(
                        cp.claims_processed,
                        0:: bigint
                    ) AS claims_processed
                FROM facilities
                    LEFT JOIN facility_taxonomy ft ON ft.facility_id = facilities.id
                    LEFT JOIN taxonomies t ON t.id = ft.taxonomy_id
                    LEFT JOIN company_facility ON company_facility.facility_id = facilities.id
                    LEFT JOIN companies ON companies.id = company_facility.company_id
                    LEFT JOIN billing_company_facility ON billing_company_facility.facility_id = facilities.id
                    LEFT JOIN billing_companies ON billing_companies.id = billing_company_facility.billing_company_id
                    LEFT JOIN facility_place_of_service ON facility_place_of_service.facility_id = facilities.id
                    LEFT JOIN place_of_services ON place_of_services.id = facility_place_of_service.place_of_service_id
                    LEFT JOIN facility_facility_type ON facility_facility_type.facility_id = facilities.id
                    join (
                        SELECT
                            facility_types.id,
                            array_to_string(
                                array_agg(bill_classifications.name),
                                ', ':: text,
                                '':: text
                            ) AS classifications
                        FROM facility_types
                            JOIN bill_classifications ON facility_types.code = bill_classifications.code
                        GROUP BY
                            facility_types.id
                    ) helcomp ON helcomp.id = facility_facility_type.facility_type_id
                    LEFT JOIN facility_types ON facility_types.id = facility_facility_type.facility_type_id
                    LEFT JOIN (
                        SELECT
                            cd.facility_id,
                            count(cd.id) AS claims_processed
                        FROM
                            claim_demographic cd
                        GROUP BY
                            cd.facility_id
                    ) cp ON facilities.id = cp.facility_id
                ORDER BY (row_number() OVER ());
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_general_facility');
    }
};

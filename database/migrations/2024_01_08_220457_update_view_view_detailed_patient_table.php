<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared("
        DROP VIEW IF EXISTS public.view_detailed_patient;
        CREATE OR REPLACE VIEW public.view_detailed_patient
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
            company_patient.med_num AS medical_no,
            CASE
                WHEN claim_demographic.totalClaims > 0 THEN 1
                ELSE 0
            END AS claims_processed,
            patients.code AS system_code,
            concat(
                COALESCE(
                    profiles.last_name,
                    ''::character varying
                ),
                COALESCE(
                    CASE
                        WHEN type_catalogs.code::text <> ''::text THEN concat(' ', type_catalogs.code)
                        ELSE NULL::text
                    END,
                    ''::character varying::text
                ),
                COALESCE(
                    concat(', ', profiles.first_name),
                    ''::character varying::text
                ),
                COALESCE(
                    concat(' ', profiles.middle_name),
                    ''::character varying::text
                )
            ) AS patient_name,
            profiles.date_of_birth,
            profiles.sex,
            upper(profiles.ssn::text) AS ssn,
            patients.driver_license,
            CASE
                WHEN profiles.language::text = 'en'::text THEN 'English'::text
                WHEN profiles.language::text = 'es'::text THEN 'Spanish'::text
                ELSE NULL::text
            END AS language,
            profiles.deceased_date AS date_of_eath,
            marital_statuses.name AS marital_status, (
                SELECT contacts.phone
                FROM contacts
                WHERE
                    contacts.contactable_type::text = 'App\Models\Profile'::text
                    AND contacts.contactable_id = profiles.id
                LIMIT 1
            ) AS phone, (
                SELECT contacts.mobile
                FROM contacts
                WHERE
                    contacts.contactable_type::text = 'App\Models\Profile'::text
                    AND contacts.contactable_id = profiles.id
                LIMIT
                    1
            ) AS cell_phone, (
                SELECT contacts.fax
                FROM contacts
                WHERE
                    contacts.contactable_type::text = 'App\Models\Profile'::text
                    AND contacts.contactable_id = profiles.id
                LIMIT 1
            ) AS fax, (
                SELECT contacts.email
                FROM contacts
                WHERE
                    contacts.contactable_type::text = 'App\Models\Profile'::text
                    AND contacts.contactable_id = profiles.id
                LIMIT
                    1
            ) AS email,
            coww2.type_address,
            ad1.address,
            ad2.apt_suite,
            ad3.zip,
            ad4.city,
            ad5.state,
            ad6.country,
            date(patients.created_at) as created_at,
            date(patients.updated_at) as updated_at
        FROM patients
            LEFT JOIN profiles ON patients.profile_id = profiles.id
            LEFT JOIN type_catalogs ON profiles.name_suffix_id = type_catalogs.id
            LEFT JOIN marital_statuses ON marital_statuses.id = patients.marital_status_id
            LEFT JOIN company_patient ON company_patient.patient_id = patients.id
            LEFT JOIN billing_companies ON company_patient.billing_company_id = billing_companies.id
            LEFT JOIN companies ON company_patient.company_id = companies.id
            left join (
                select
                    claim_demographic.patient_id,
                    count(claim_demographic.id) as totalClaims
                from claim_demographic
                group by
                    claim_demographic.patient_id
            ) as claim_demographic ON claim_demographic.patient_id = patients.id
            LEFT JOIN (
                SELECT
                    ad.addressable_id,
                    array_to_string(
                        array_agg(aty.name),
                        ', '::text,
                        ''::text
                    ) AS type_address
                FROM addresses ad
                    JOIN address_types aty ON ad.address_type_id = aty.id
                WHERE
                    ad.addressable_type::text = 'App\Models\Profile'::text
                GROUP BY
                    ad.addressable_id
            ) coww2 ON profiles.id = coww2.addressable_id
            LEFT JOIN (
                SELECT
                    ad.addressable_id,
                    array_to_string(
                        array_agg(ad.address),
                        ', '::text,
                        ''::text
                    ) AS address
                FROM addresses ad
                WHERE
                    ad.addressable_type::text = 'App\Models\Profile'::text
                GROUP BY
                    ad.addressable_id
            ) ad1 ON profiles.id = ad1.addressable_id
            LEFT JOIN (
                SELECT
                    ad.addressable_id,
                    array_to_string(
                        array_agg(ad.apt_suite),
                        ', '::text,
                        ''::text
                    ) AS apt_suite
                FROM addresses ad
                WHERE
                    ad.addressable_type::text = 'App\Models\Profile'::text
                GROUP BY
                    ad.addressable_id
            ) ad2 ON profiles.id = ad2.addressable_id
            LEFT JOIN (
                SELECT
                    ad.addressable_id,
                    array_to_string(
                        array_agg(ad.zip),
                        ', '::text,
                        ''::text
                    ) AS zip
                FROM addresses ad
                WHERE
                    ad.addressable_type::text = 'App\Models\Profile'::text
                GROUP BY
                    ad.addressable_id
            ) ad3 ON profiles.id = ad3.addressable_id
            LEFT JOIN (
                SELECT
                    ad.addressable_id,
                    array_to_string(
                        array_agg(ad.city),
                        ', '::text,
                        ''::text
                    ) AS city
                FROM addresses ad
                WHERE
                    ad.addressable_type::text = 'App\Models\Profile'::text
                GROUP BY
                    ad.addressable_id
            ) ad4 ON profiles.id = ad4.addressable_id
            LEFT JOIN (
                SELECT
                    ad.addressable_id,
                    array_to_string(
                        array_agg(ad.state),
                        ', '::text,
                        ''::text
                    ) AS state
                FROM addresses ad
                WHERE
                    ad.addressable_type::text = 'App\Models\Profile'::text
                GROUP BY
                    ad.addressable_id
            ) ad5 ON profiles.id = ad5.addressable_id
            LEFT JOIN (
                SELECT
                    ad.addressable_id,
                    array_to_string(
                        array_agg(ad.country),
                        ', '::text,
                        ''::text
                    ) AS country
                FROM addresses ad
                WHERE
                    ad.addressable_type::text = 'App\Models\Profile'::text
                GROUP BY
                    ad.addressable_id
            ) ad6 ON profiles.id = ad6.addressable_id
        ORDER BY patients.id;
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_detailed_patient');
    }
};

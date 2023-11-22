<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE VIEW public.view_detailed_patient
            AS select
                row_number() OVER() as id,
                billing_companies.id as billing_id,
                concat(billing_companies.abbreviation, ' - ', billing_companies.name) as billing_companies,
                concat(companies.code, ' - ', companies.name) as companies,
                company_patient.med_num as medical_no,
                CASE
                    when claim_demographic.id > 0 THEN 1 ElSE 0
                end as claims_processed,
                patients.code as system_code,
                CASE
                    WHEN concat_ws(
                        ' ' :: text,
                        COALESCE(profiles.last_name, '' :: character varying),
                        COALESCE(type_catalogs.code, '' :: character varying),
                        COALESCE(profiles.first_name, '' :: character varying),
                        COALESCE(profiles.middle_name, '' :: character varying)
                    ) = ' ' :: text THEN 'Console' :: text
                    ELSE concat_ws(
                        ' ' :: text,
                        COALESCE(profiles.last_name, '' :: character varying),
                        COALESCE(type_catalogs.code, '' :: character varying),
                        COALESCE(profiles.first_name, '' :: character varying),
                        COALESCE(profiles.middle_name, '' :: character varying)
                    )
                END AS patient_name,
                profiles.date_of_birth as date_of_birth,
                profiles.sex,
                profiles.ssn,
                patients.driver_license,
                case
                    WHEN profiles.language :: text = 'en' :: text THEN 'English' :: text
                    WHEN profiles.language :: text = 'es' :: text THEN 'Spanish' :: text
                end as language,
                profiles.deceased_date as date_of_eath,
                marital_statuses.name as marital_status,
                (
                    SELECT
                        contacts.phone
                    FROM
                        contacts
                    WHERE
                        contacts.contactable_type :: text = 'App\Models\Profile' :: text
                        AND contacts.contactable_id = profiles.id
                    LIMIT
                        1
                ) AS phone,
                (
                    SELECT
                        contacts.mobile
                    FROM
                        contacts
                    WHERE
                        contacts.contactable_type :: text = 'App\Models\Profile' :: text
                        AND contacts.contactable_id = profiles.id
                    LIMIT
                        1
                ) AS cell_phone,
                (
                    SELECT
                        contacts.fax
                    FROM
                        contacts
                    WHERE
                        contacts.contactable_type :: text = 'App\Models\Profile' :: text
                        AND contacts.contactable_id = profiles.id
                    LIMIT
                        1
                ) AS fax,
                (
                    SELECT
                        contacts.email
                    FROM
                        contacts
                    WHERE
                        contacts.contactable_type :: text = 'App\Models\Profile' :: text
                        AND contacts.contactable_id = profiles.id
                    LIMIT
                        1
                ) AS email,
                type_address,
                address,
                apt_suite,
                zip,
                city,
                state,
                country
            from
                patients
                left join profiles on patients.profile_id = profiles.id
                left join type_catalogs on profiles.name_suffix_id = type_catalogs.id
                left join marital_statuses on marital_statuses.id = patients.marital_status_id
                left join company_patient on company_patient.patient_id = patients.id
                left join billing_companies on company_patient.billing_company_id = billing_companies.id
                left join companies on company_patient.company_id = companies.id
                left join claim_demographic on claim_demographic.patient_id = patients.id 
                left join (
                    select
                        addressable_id,
                        array_to_string(array_agg(aty.name), ', ', '') as type_address
                    from
                        addresses ad
                        inner join address_types aty on ad.address_type_id = aty.id
                    WHERE
                        ad.addressable_type::text = 'App\Models\Profile'::text
                    GROUP BY
                        addressable_id
                ) coww2 on profiles.id = coww2.addressable_id
                left join (
                    select
                        addressable_id,
                        array_to_string(array_agg(ad.address), ', ', '') as address
                    from
                        addresses ad
                    WHERE
                        ad.addressable_type::text = 'App\Models\Profile'::text
                    GROUP BY
                        addressable_id
                ) ad1 on profiles.id = ad1.addressable_id
                left join (
                    select
                        addressable_id,
                        array_to_string(array_agg(ad.apt_suite), ', ', '') as apt_suite
                    from
                        addresses ad
                    WHERE
                        ad.addressable_type::text = 'App\Models\Profile'::text
                    GROUP BY
                        addressable_id
                ) ad2 on profiles.id = ad2.addressable_id
                left join (
                    select
                        addressable_id,
                        array_to_string(array_agg(ad.zip), ', ', '') as zip
                    from
                        addresses ad
                    WHERE
                        ad.addressable_type::text = 'App\Models\Profile'::text
                    GROUP BY
                        addressable_id
                ) ad3 on profiles.id = ad3.addressable_id
                left join (
                    select
                        addressable_id,
                        array_to_string(array_agg(ad.city), ', ', '') as city
                    from
                        addresses ad
                    WHERE
                        ad.addressable_type::text = 'App\Models\Profile'::text
                    GROUP BY
                        addressable_id
                ) ad4 on profiles.id = ad4.addressable_id
                left join (
                    select
                        addressable_id,
                        array_to_string(array_agg(ad.state), ', ', '') as state
                    from
                        addresses ad
                    WHERE
                        ad.addressable_type::text = 'App\Models\Profile'::text
                    GROUP BY
                        addressable_id
                ) ad5 on profiles.id = ad5.addressable_id
                left join (
                    select
                        addressable_id,
                        array_to_string(array_agg(ad.country), ', ', '') as country
                    from
                        addresses ad
                    WHERE
                        ad.addressable_type::text = 'App\Models\Profile'::text
                    GROUP BY
                        addressable_id
                ) ad6 on profiles.id = ad6.addressable_id
            order by patients.id
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_detailed_patient');
    }
};

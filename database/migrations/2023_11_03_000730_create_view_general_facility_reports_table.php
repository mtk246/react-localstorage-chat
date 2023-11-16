<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW view_general_facility_report AS
            select
                f.id,
                billing_companies_ids,
                billing_companies,
                companies,
                f.code,
                concat(f.code, '-', f.name) as facility,
                f.npi,
                concat(t.tax_id, ' ', t.name) as primary_taxonomy,
                place_of_service,
                type_of_facility,
                bill_classifications,
                coalesce(claims_processed, 0) as claims_processed
            from
                facilities f
                join facility_taxonomy ft on ft.facility_id = f.id
                join taxonomies t on t.id = ft.taxonomy_id
                left join (
                    select
                        facility_id,
                        array_to_string(
                            array_agg(distinct concat(c.code, ' - ', c.name)),
                            ', ',
                            ''
                        ) as companies
                    from
                        company_facility cf
                        join companies c on c.id = cf.company_id
                    GROUP BY
                        facility_id
                ) comp on f.id = comp.facility_id
                left join (
                    select
                        facility_id,
                        array_to_string(
                            array_agg(distinct concat(bc.abbreviation, ' - ', bc.name)),
                            ', ',
                            ''
                        ) as billing_companies
                    from
                        billing_company_facility bcf
                        inner join billing_companies bc on bcf.billing_company_id = bc.id
                    GROUP BY
                        facility_id
                ) bicf on f.id = bicf.facility_id
                left join (
                    select
                        facility_id,
                        json_agg(distinct bc.id) as billing_companies_ids
                    from
                        billing_company_facility bcf
                        inner join billing_companies bc on bcf.billing_company_id = bc.id
                    GROUP BY
                        facility_id
                ) bicf2 on f.id = bicf2.facility_id
                left join (
                    select
                        facility_id,
                        array_to_string(array_agg(distinct ps.name), ', ', '') as place_of_service
                    from
                        facility_place_of_service fpos
                        inner join place_of_services ps on fpos.place_of_service_id = ps.id
                    GROUP BY
                        facility_id
                ) placeF on f.id = placeF.facility_id
                left join (
                    select
                        facility_id,
                        array_to_string(array_agg(distinct ft2.type), ', ', '') as type_of_facility
                    from
                        facility_facility_type fft
                        join facility_types ft2 on ft2.id = fft.facility_type_id
                    GROUP BY
                        facility_id
                ) factyp on f.id = factyp.facility_id
                left join (
                    select
                        facility_id,
                        array_to_string(array_agg(fft1.bill_classifications), ', ', '') as bill_classifications
                    from
                        facility_facility_type fft1
                        join facility_types ft3 on ft3.id = fft1.facility_type_id
                    GROUP BY
                        facility_id
                ) factyp1 on f.id = factyp1.facility_id
                left join (
                    select
                        facility_id,
                        count(cd.id) as claims_processed
                    from
                        claim_demographic cd
                    GROUP BY
                        facility_id
                ) cp on f.id = cp.facility_id
            order by
                f.code
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW view_general_facility_report');
    }
};

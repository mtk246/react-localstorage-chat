<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE VIEW public.view_general_facility
            AS select
                row_number() OVER() as id,
                billing_companies.id as billing_companies_ids,
                concat(
                    billing_companies.abbreviation,
                    ' - ',
                    billing_companies.name
                ) as billing_companies,
                concat(
                    companies.code,
                    ' - ',
                    companies.name
                ) as companies,
                facilities.code,
                concat(
                    facilities.code,
                    '-',
                    facilities.name
                ) as facility,
                facilities.npi,
                concat(t.tax_id, ' ', t.name) as primary_taxonomy,
                place_of_services.name as place_of_service,
                facility_types.type as type_of_facility,
                facility_facility_type.bill_classifications as bill_classifications,
                coalesce(claims_processed, 0) as claims_processed
            from facilities
                left join facility_taxonomy ft on ft.facility_id = facilities.id
                left join taxonomies t on t.id = ft.taxonomy_id
                left join company_facility on company_facility.facility_id = facilities.id
                left join companies on companies.id = company_facility.company_id
                left join billing_company_facility on billing_company_facility.facility_id = facilities.id
                left join billing_companies on billing_companies.id = billing_company_facility.billing_company_id
                left join facility_place_of_service on facility_place_of_service.facility_id = facilities.id
                left join place_of_services on place_of_services.id = facility_place_of_service.place_of_service_id
                left join facility_facility_type on facility_facility_type.facility_id = facilities.id
                left join facility_types on facility_types.id = facility_facility_type.facility_type_id
                left join (
                    select
                        facility_id,
                        count(cd.id) as claims_processed
                    from claim_demographic cd
                    GROUP BY
                        facility_id
                ) cp on facilities.id = cp.facility_id
            order by id
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_general_facility');
    }
};

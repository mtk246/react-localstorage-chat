<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared('
            DROP VIEW IF EXISTS view_company_information;
            CREATE OR REPLACE VIEW view_company_information AS
            SELECT
                companies.id,
                companies.name as company_name,
                companies.npi as npi,
                companies.ein as ein,
                companies.clia as clia,
                facilities.name as facility_name,
                facility_types.type as facility_type,
                procedures.code as service_code,
                revenue.code as revenue_code,
                (
                    CASE
                        WHEN company_services.price IS  NULL THEN \'0\'
                        ELSE company_services.price
                    END
                ) as price,
                billing_companies.name as billing_company,
                taxonomies.tax_id as taxonomy,
                taxonomies.name as taxonomy_name,
                company_taxonomy.primary as primary_taxonomy
            FROM companies
            JOIN billing_company_company ON companies.id = billing_company_company.company_id
            JOIN billing_companies ON billing_company_company.billing_company_id = billing_companies.id
            LEFT JOIN company_facility ON companies.id = company_facility.company_id
            LEFT JOIN facilities ON company_facility.facility_id = facilities.id
            LEFT JOIN facility_facility_type ON facilities.id = facility_facility_type.facility_id
            LEFT JOIN facility_types ON facility_facility_type.facility_type_id = facility_types.id
            LEFT JOIN company_services ON companies.id = company_services.company_id
            LEFT JOIN procedures ON company_services.procedure_id = procedures.id
            LEFT JOIN procedures as revenue ON company_services.revenue_code_id = revenue.id
            LEFT JOIN company_taxonomy ON companies.id = company_taxonomy.company_id
            LEFT JOIN taxonomies ON company_taxonomy.taxonomy_id = taxonomies.id
        ');
    }

    public function down(): void
    {
        DB::unprepared('
            DROP VIEW IF EXISTS view_company_information;
            CREATE OR REPLACE VIEW view_company_information AS
            SELECT
                companies.id,
                companies.name as company_name,
                companies.npi as npi,
                companies.ein as ein,
                companies.clia as clia,
                facilities.name as facility_name,
                facility_types.type as facility_type,
                procedures.code as service_code,
                revenue.code as revenue_code,
                (
                    CASE
                        WHEN company_services.price IS  NULL THEN \'0\'
                        ELSE company_services.price
                    END
                ) as price,
                billing_companies.name as billing_company
            FROM companies
            JOIN billing_company_company ON companies.id = billing_company_company.company_id
            JOIN billing_companies ON billing_company_company.billing_company_id = billing_companies.id
            LEFT JOIN company_facility ON companies.id = company_facility.company_id
            LEFT JOIN facilities ON company_facility.facility_id = facilities.id
            LEFT JOIN facility_facility_type ON facilities.id = facility_facility_type.facility_id
            LEFT JOIN facility_types ON facility_facility_type.facility_type_id = facility_types.id
            LEFT JOIN company_services ON companies.id = company_services.company_id
            LEFT JOIN procedures ON company_services.procedure_id = procedures.id
            LEFT JOIN procedures as revenue ON company_services.revenue_code_id = revenue.id

            WHERE company_facility.billing_company_id = billing_companies.id
        ');
    }
};

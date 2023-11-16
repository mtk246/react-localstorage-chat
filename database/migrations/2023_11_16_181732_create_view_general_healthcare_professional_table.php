<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE VIEW public.view_general_healthcare_professional
            AS select
                row_number() OVER() as id,
                billing_companies.id as billing_companies_ids,
                concat(
                    billing_companies.code,
                    ' - ',
                    billing_companies.name
                ) as billing_companies,
                concat(
                    companies.code,
                    ' - ',
                    companies.name
                ) as companies,
                health_professionals.code as system_code,
                concat(
                    p.first_name,
                    ' ',
                    p.name_suffix_id,
                    ', ',
                    p.first_name,
                    ' ',
                    p.middle_name
                ) as healthcare_professional,
                health_professionals.npi,
                concat(t.tax_id, ' ', t.name) as primary_taxonomy,
                CASE
                    WHEN health_professional_types.id = '1' THEN 'Medical doctor'
                    WHEN health_professional_types.id = '2' THEN 'Nurse practitioners'
                    WHEN health_professional_types.id = '3' THEN 'Physician assistants'
                    WHEN health_professional_types.id = '4' THEN 'Certified nurse specialists trained in a particular field such as E/R, pediatric or diabetic nursing'
                    WHEN health_professional_types.id = '5' THEN 'Certified nurse midwives'
                    WHEN health_professional_types.id = '6' THEN 'Certified registered nurse anesthetists'
                    WHEN health_professional_types.id = '7' THEN 'Clinical social worker'
                    WHEN health_professional_types.id = '8' THEN 'Physical therapists'
                    ELSE NULL
                end health_professional_type,
                company_health_professional.authorization as health_professional_role,
                coalesce(claims_processed, 0) as claims_processed
            from health_professionals
                left join profiles p on health_professionals.profile_id = p.id
                left join health_professional_taxonomy hpt on hpt.health_professional_id = health_professionals.id
                left join taxonomies t on hpt.taxonomy_id = t.id
                left join company_health_professional on company_health_professional.health_professional_id = health_professionals.id
                left join companies on companies.id = company_health_professional.company_id
                left join billing_companies on billing_companies.id = company_health_professional.billing_company_id
                left join health_professional_types on health_professional_types.health_professional_id = health_professionals.id
                left join (
                    select
                        health_professional_id,
                        count(chp2.id) as claims_processed
                    from
                        claim_health_professional chp2
                    GROUP BY
                        health_professional_id
                ) cp on health_professionals.id = cp.health_professional_id
            order by health_professionals.id
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('view_general_healthcare_professional');
    }
};

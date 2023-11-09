<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        \DB::statement("
            CREATE OR REPLACE VIEW public.view_healthcare_professional_report
            AS select
            billing_companies_ids,
            billing_companies,
            companies,
            system_code,
            concat(p.first_name, ' ', p.name_suffix_id, ', ', p.first_name, ' ', p.middle_name) as healthcare_rofessional,
            hp.npi,
            concat(t.tax_id, ' ', t.name) as primary_taxonomy,
            health_professional_type,
            health_professional_role,
            claims_processed
            from health_professionals hp 
            left join profiles p on hp.profile_id  = p.id
            left join health_professional_taxonomy hpt on hpt.health_professional_id = hp.id
            left join taxonomies t on hpt.taxonomy_id = t.id
            left join
            (select health_professional_id , array_to_string(array_agg(concat(c.code,' - ',c.name)), ',', '') as companies from company_health_professional chp join companies c on c.id = chp.company_id GROUP BY health_professional_id) helcomp on hp.id = helcomp.health_professional_id
            left join
            (select health_professional_id , array_to_string(array_agg(c.id), ',', '') as system_code from company_health_professional chp join companies c on c.id = chp.company_id GROUP BY health_professional_id) helcomp1 on hp.id = helcomp1.health_professional_id
            left join
            (select health_professional_id , array_to_string(array_agg(concat(bc.code,' - ',bc.name)), ', ', '') as billing_companies from company_health_professional chp join billing_companies bc on bc.id = chp.billing_company_id GROUP BY health_professional_id) helblcomp on hp.id = helblcomp.health_professional_id
            left join
            (select health_professional_id , array_to_string(array_agg(bc.id), ', ', '') as billing_companies_ids from company_health_professional chp join billing_companies bc on bc.id = chp.billing_company_id GROUP BY health_professional_id) helblcomp1 on hp.id = helblcomp1.health_professional_id
            left join
            (select health_professional_id , array_to_string(array_agg(chp.authorization), ', ', '') as health_professional_role from company_health_professional chp join billing_companies bc on bc.id = chp.billing_company_id GROUP BY health_professional_id) helblcomp2 on hp.id = helblcomp2.health_professional_id
            left join
            (select health_professional_id , array_to_string(array_agg(hpt.id), ', ', '') as health_professional_type from health_professional_types hpt GROUP BY health_professional_id) helblcompTy on hp.id = helblcompTy.health_professional_id
            left join 
            (select health_professional_id , count(chp2.id) as claims_processed from claim_health_professional chp2 GROUP BY health_professional_id) cp on hp.id = cp.health_professional_id
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('view_healthcare_professional_reports');
    }
};

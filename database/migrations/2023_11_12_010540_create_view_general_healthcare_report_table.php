<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE VIEW public.view_general_healthcare_report
            AS select
                hp.id,
                billing_companies_ids,
                billing_companies,
                companies,
                system_code,
                CASE
                    WHEN concat_ws(
                        ' ' :: text,
                        COALESCE(p.last_name, '' :: character varying),
                        COALESCE(type_catalogs.code, '' :: character varying),
                        COALESCE(p.first_name, '' :: character varying),
                        COALESCE(p.middle_name, '' :: character varying)
                    ) = ' ' :: text THEN 'Console' :: text
                    ELSE concat_ws(
                        ' ' :: text,
                        COALESCE(p.last_name, '' :: character varying),
                        COALESCE(type_catalogs.code, '' :: character varying),
                        COALESCE(p.first_name, '' :: character varying),
                        COALESCE(p.middle_name, '' :: character varying)
                    )
                END AS healthcare_professional,
                hp.npi,
                concat(t.tax_id, ' ', t.name) as primary_taxonomy,
                health_professional_type,
                health_professional_role,
                coalesce(claims_processed, 0) as claims_processed
            from
                health_professionals hp
                left join profiles p on hp.profile_id = p.id
                left join type_catalogs on p.name_suffix_id = type_catalogs.id
                left join health_professional_taxonomy hpt on hpt.health_professional_id = hp.id
                left join taxonomies t on hpt.taxonomy_id = t.id
                left join (
                    select
                        health_professional_id,
                        array_to_string(
                            array_agg(distinct concat(c.code, ' - ', c.name)),
                            ',',
                            ''
                        ) as companies
                    from
                        company_health_professional chp
                        join companies c on c.id = chp.company_id
                    GROUP BY
                        health_professional_id
                ) helcomp on hp.id = helcomp.health_professional_id
                left join (
                    select
                        health_professional_id,
                        array_to_string(array_agg(distinct c.code), ',', '') as system_code
                    from
                        company_health_professional chp
                        join companies c on c.id = chp.company_id
                    GROUP BY
                        health_professional_id
                ) helcomp1 on hp.id = helcomp1.health_professional_id
                left join (
                    select
                        health_professional_id,
                        array_to_string(
                            array_agg(distinct concat(bc.code, ' - ', bc.name)),
                            ', ',
                            ''
                        ) as billing_companies
                    from
                        company_health_professional chp
                        join billing_companies bc on bc.id = chp.billing_company_id
                    GROUP BY
                        health_professional_id
                ) helblcomp on hp.id = helblcomp.health_professional_id
                left join (
                    select
                        health_professional_id,
                        array_to_string(array_agg(distinct bc.id), ', ', '') as billing_companies_ids
                    from
                        company_health_professional chp
                        join billing_companies bc on bc.id = chp.billing_company_id
                    GROUP BY
                        health_professional_id
                ) helblcomp1 on hp.id = helblcomp1.health_professional_id
                left join (
                    select
                        health_professional_id,
                        array_to_string(
                            array_agg(distinct chp.authorization),
                            ', ',
                            ''
                        ) as health_professional_role
                    from
                        company_health_professional chp
                        join billing_companies bc on bc.id = chp.billing_company_id
                    GROUP BY
                        health_professional_id
                ) helblcomp2 on hp.id = helblcomp2.health_professional_id
                left join (
                    select
                        health_professional_id,
                        array_to_string(
                            array_agg(
                                CASE
                                    WHEN hpt.id = '1' THEN 'Medical doctor'
                                    WHEN hpt.id = '2' THEN 'Nurse practitioners'
                                    WHEN hpt.id = '3' THEN 'Physician assistants'
                                    WHEN hpt.id = '4' THEN 'Certified nurse specialists trained in a particular field such as E/R, pediatric or diabetic nursing'
                                    WHEN hpt.id = '5' THEN 'Certified nurse midwives'
                                    WHEN hpt.id = '6' THEN 'Certified registered nurse anesthetists'
                                    WHEN hpt.id = '7' THEN 'Clinical social worker'
                                    WHEN hpt.id = '8' THEN 'Physical therapists'
                                    ELSE NULL
                                END
                            ),
                            ', ',
                            ''
                        ) as health_professional_type
                    from
                        health_professional_types hpt
                    GROUP BY
                        health_professional_id
                ) helblcompTy on hp.id = helblcompTy.health_professional_id
                left join (
                    select
                        health_professional_id,
                        count(chp2.id) as claims_processed
                    from
                        claim_health_professional chp2
                    GROUP BY
                        health_professional_id
                ) cp on hp.id = cp.health_professional_id
            order by hp.id
        ");
    }

    public function down(): void
    {
        Schema::dropIfExists('view_general_healthcare_report');
    }
};

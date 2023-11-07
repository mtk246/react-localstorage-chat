<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
        CREATE OR REPLACE VIEW public.view_detailed_patient_report
        AS select
        billing_companies_ids,
        billing_companies,
        companies,
        medical_no,
        claims_processed,
        p.id as system_code,
        concat(p2.last_name, ' ', p2.name_suffix_id, ', ', p2.first_name, ' ', p2.middle_name) as patiente_name, 
        p2.date_of_birth, 
        p2.sex, 
        p2.ssn, 
        p.driver_license, 
        p2.language, 
        ms.name,
        (SELECT c.phone FROM contacts c WHERE c.contactable_type::text = 'App\Models\Patient'::text AND c.contactable_id = p.id LIMIT 1) AS phone,
        (SELECT c.mobile FROM contacts c WHERE c.contactable_type::text = 'App\Models\Patient'::text AND c.contactable_id = p.id LIMIT 1) AS cell_phone,
        (SELECT c.fax FROM contacts c WHERE c.contactable_type::text = 'App\Models\Patient'::text AND c.contactable_id = p.id LIMIT 1) AS fax,
        (SELECT c.email FROM contacts c WHERE c.contactable_type::text = 'App\Models\Patient'::text AND c.contactable_id = p.id LIMIT 1) AS email,
        type_address,
        address,
        apt_suite,
        zip,
        city,
        state,
        country
        from patients p 
        left join profiles p2 on p.profile_id = p2.id
        left join marital_statuses ms on ms.id = p.marital_status_id
        left join 
        (select patient_id , array_to_string(array_agg(cp2.med_num), ', ', '') as medical_no from company_patient cp2 inner join companies c2 on cp2.company_id = c2.id GROUP BY patient_id) cow2 on p.id = cow2.patient_id
        left join 
        (select patient_id , count(cd.id) as claims_processed from claim_demographic cd GROUP BY patient_id) cp on p.id = cp.patient_id
        left join 
        (select patient_id , array_to_string(array_agg(concat(c.code,' - ',c.name)), ', ', '') as companies  from company_patient cp inner join companies c on cp.company_id = c.id GROUP BY patient_id) cow on p.id = cow.patient_id
        left join 
        (select patient_id , array_to_string(array_agg(bc.id),', ','') as billing_companies_ids from company_patient cp inner join billing_companies bc on cp.billing_company_id  = bc.id GROUP BY patient_id) comp3 on p.id = comp3.patient_id
        left join 
        (select patient_id , array_to_string(array_agg(concat(bc.abbreviation,' - ',bc.name)), ', ', '') as billing_companies  from company_patient cp inner join billing_companies bc on cp.billing_company_id  = bc.id GROUP BY patient_id) cow3 on p.id = cow3.patient_id
        left join 
        (select addressable_id , array_to_string(array_agg(aty.name), ', ', '') as type_address from addresses ad inner join address_types aty on ad.address_type_id = aty.id WHERE ad.addressable_type::text = 'App\Models\Patient'::text GROUP BY addressable_id) coww2 on p.id = coww2.addressable_id
        left join 
        (select addressable_id , array_to_string(array_agg(ad.address), ', ','') as address from addresses ad WHERE ad.addressable_type::text = 'App\Models\Patient'::text GROUP BY addressable_id) ad1 on p.id = ad1.addressable_id
        left join 
        (select addressable_id , array_to_string(array_agg(ad.apt_suite), ', ','') as apt_suite from addresses ad WHERE ad.addressable_type::text = 'App\Models\Patient'::text GROUP BY addressable_id) ad2 on p.id = ad2.addressable_id
        left join 
        (select addressable_id , array_to_string(array_agg(ad.zip), ', ','') as zip from addresses ad WHERE ad.addressable_type::text = 'App\Models\Patient'::text GROUP BY addressable_id) ad3 on p.id = ad3.addressable_id
        left join 
        (select addressable_id , array_to_string(array_agg(ad.city), ', ','') as city from addresses ad WHERE ad.addressable_type::text = 'App\Models\Patient'::text GROUP BY addressable_id) ad4 on p.id = ad4.addressable_id
        left join 
        (select addressable_id , array_to_string(array_agg(ad.state), ', ','') as state from addresses ad WHERE ad.addressable_type::text = 'App\Models\Patient'::text GROUP BY addressable_id) ad5 on p.id = ad5.addressable_id
        left join 
        (select addressable_id , array_to_string(array_agg(ad.country), ', ','') as country from addresses ad WHERE ad.addressable_type::text = 'App\Models\Patient'::text GROUP BY addressable_id) ad6 on p.id = ad6.addressable_id
        order by system_code
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW view_detailed_patient_report');
    }
};

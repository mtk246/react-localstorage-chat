<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class() extends Migration
{
    public function up(): void
    {
        DB::unprepared("
        DROP VIEW IF EXISTS public.view_change_by_module;
        CREATE OR REPLACE VIEW public.view_change_by_module
        AS select
            CASE
                WHEN concat_ws(' '::text, COALESCE(profiles.first_name, ''::character varying), COALESCE(profiles.last_name, ''::character varying)) = ' '::text THEN 'Console'::text
                ELSE concat_ws(' '::text, COALESCE(profiles.first_name, ''::character varying), COALESCE(profiles.last_name, ''::character varying))
            END AS user_name,
            CASE
                WHEN audits.auditable_type::text = 'App\Models\User'::text THEN 'User'::character varying
                WHEN audits.auditable_type::text = 'App\Models\HealthProfessional'::text THEN 'Health Professional'::character varying
                WHEN audits.auditable_type::text = 'App\Models\BillingCompany'::text THEN 'Billing Company'::character varying
                WHEN audits.auditable_type::text = 'App\Models\Claims\Claim'::text THEN 'Claim'::character varying
                WHEN audits.auditable_type::text = 'App\Models\Modifier'::text THEN 'Modifier'::character varying
                WHEN audits.auditable_type::text = 'App\Models\Diagnosis'::text THEN 'Diagnosis'::character varying
                WHEN audits.auditable_type::text = 'App\Models\Report'::text THEN 'Report'::character varying
                WHEN audits.auditable_type::text = 'App\Models\InsurancePlan'::text THEN 'Insurance Plan'::character varying
                WHEN audits.auditable_type::text = 'App\Models\InsuranceCompany'::text THEN 'Insurance Company'::character varying
                WHEN audits.auditable_type::text = 'App\Models\Company'::text THEN 'Company'::character varying
                WHEN audits.auditable_type::text = 'App\Models\Facility'::text THEN 'Facility'::character varying
                WHEN audits.auditable_type::text = 'App\Models\Patient'::text THEN 'Patient'::character varying
                WHEN audits.auditable_type::text = 'App\Models\Procedure'::text THEN 'Procedure'::character varying
                ELSE audits.auditable_type
            END AS module,
            CASE
                WHEN audits.event::text = 'deleted'::text THEN 'Deleted'::character varying
                WHEN audits.event::text = 'restored'::text THEN 'Restored'::character varying
                WHEN audits.event::text = 'updated'::text AND (EXISTS ( SELECT 1
                FROM audits prev
                WHERE prev.user_id = audits.user_id AND prev.auditable_type::text = audits.auditable_type::text AND prev.event::text = 'updated'::text AND prev.created_at < audits.created_at AND prev.old_values::jsonb::text = audits.new_values::jsonb::text AND prev.new_values::jsonb::text = audits.old_values::jsonb::text)) THEN 'Roll Back'::character varying
                WHEN audits.event::text = 'created'::text THEN 'Created'::character varying
                WHEN audits.event::text = 'updated'::text THEN 'Updated'::character varying
                ELSE audits.event
            END AS event,
            case
                when extract(hour from  audits.created_at::timestamp)::numeric >= 12::numeric 
                and extract(hour from  audits.created_at::timestamp)::numeric <= 14::numeric 
                then
                    case
                        WHEN audits.auditable_type::text = 'App\Models\User'::text 
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\User'::text)
                        WHEN audits.auditable_type::text = 'App\Models\HealthProfessional'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\HealthProfessional'::text)
                        WHEN audits.auditable_type::text = 'App\Models\BillingCompany'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\BillingCompany'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Claims\Claim'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Claims\Claim'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Modifier'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Modifier'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Diagnosis'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Diagnosis'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Report'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Report'::text)
                        WHEN audits.auditable_type::text = 'App\Models\InsurancePlan'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\InsurancePlan'::text)
                        WHEN audits.auditable_type::text = 'App\Models\InsuranceCompany'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\InsuranceCompany'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Company'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Company'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Facility'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Facility'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Patient'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Patient'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Procedure'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Procedure'::text)
                        else 0
                    end
                else 0
            end as firstHrs,
            case
                when extract(hour from  audits.created_at::timestamp)::numeric >= 14::numeric 
                and extract(hour from  audits.created_at::timestamp)::numeric <= 16::numeric 
                then
                    case
                        WHEN audits.auditable_type::text = 'App\Models\User'::text 
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\User'::text)
                        WHEN audits.auditable_type::text = 'App\Models\HealthProfessional'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\HealthProfessional'::text)
                        WHEN audits.auditable_type::text = 'App\Models\BillingCompany'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\BillingCompany'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Claims\Claim'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Claims\Claim'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Modifier'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Modifier'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Diagnosis'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Diagnosis'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Report'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Report'::text)
                        WHEN audits.auditable_type::text = 'App\Models\InsurancePlan'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\InsurancePlan'::text)
                        WHEN audits.auditable_type::text = 'App\Models\InsuranceCompany'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\InsuranceCompany'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Company'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Company'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Facility'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Facility'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Patient'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Patient'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Procedure'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Procedure'::text)
                        else 0
                    end
                else 0
            end as secondHrs,
            case
                when extract(hour from  audits.created_at::timestamp)::numeric >= 16::numeric 
                and extract(hour from  audits.created_at::timestamp)::numeric <= 18::numeric 
                then
                    case
                        WHEN audits.auditable_type::text = 'App\Models\User'::text 
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\User'::text)
                        WHEN audits.auditable_type::text = 'App\Models\HealthProfessional'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\HealthProfessional'::text)
                        WHEN audits.auditable_type::text = 'App\Models\BillingCompany'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\BillingCompany'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Claims\Claim'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Claims\Claim'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Modifier'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Modifier'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Diagnosis'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Diagnosis'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Report'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Report'::text)
                        WHEN audits.auditable_type::text = 'App\Models\InsurancePlan'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\InsurancePlan'::text)
                        WHEN audits.auditable_type::text = 'App\Models\InsuranceCompany'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\InsuranceCompany'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Company'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Company'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Facility'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Facility'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Patient'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Patient'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Procedure'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Procedure'::text)
                        else 0
                    end
                else 0
            end as thirdhrs,
            case
                when extract(hour from  audits.created_at::timestamp)::numeric >= 18::numeric 
                and extract(hour from  audits.created_at::timestamp)::numeric <= 20::numeric 
                then
                    case
                        WHEN audits.auditable_type::text = 'App\Models\User'::text 
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\User'::text)
                        WHEN audits.auditable_type::text = 'App\Models\HealthProfessional'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\HealthProfessional'::text)
                        WHEN audits.auditable_type::text = 'App\Models\BillingCompany'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\BillingCompany'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Claims\Claim'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Claims\Claim'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Modifier'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Modifier'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Diagnosis'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Diagnosis'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Report'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Report'::text)
                        WHEN audits.auditable_type::text = 'App\Models\InsurancePlan'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\InsurancePlan'::text)
                        WHEN audits.auditable_type::text = 'App\Models\InsuranceCompany'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\InsuranceCompany'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Company'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Company'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Facility'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Facility'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Patient'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Patient'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Procedure'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Procedure'::text)
                        else 0
                    end
                else 0
            end as quarterhrs,
            case
                when extract(hour from  audits.created_at::timestamp)::numeric >= 20::numeric 
                and extract(hour from  audits.created_at::timestamp)::numeric <= 22::numeric 
                then
                    case
                        WHEN audits.auditable_type::text = 'App\Models\User'::text 
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\User'::text)
                        WHEN audits.auditable_type::text = 'App\Models\HealthProfessional'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\HealthProfessional'::text)
                        WHEN audits.auditable_type::text = 'App\Models\BillingCompany'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\BillingCompany'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Claims\Claim'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Claims\Claim'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Modifier'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Modifier'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Diagnosis'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Diagnosis'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Report'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Report'::text)
                        WHEN audits.auditable_type::text = 'App\Models\InsurancePlan'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\InsurancePlan'::text)
                        WHEN audits.auditable_type::text = 'App\Models\InsuranceCompany'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\InsuranceCompany'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Company'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Company'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Facility'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Facility'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Patient'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Patient'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Procedure'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Procedure'::text)
                        else 0
                    end
                else 0
            end as fifthhrs,
            case
                when extract(hour from  audits.created_at::timestamp)::numeric >= 22::numeric 
                and extract(hour from  audits.created_at::timestamp)::numeric <= 24::numeric 
                then
                    case
                        WHEN audits.auditable_type::text = 'App\Models\User'::text 
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\User'::text)
                        WHEN audits.auditable_type::text = 'App\Models\HealthProfessional'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\HealthProfessional'::text)
                        WHEN audits.auditable_type::text = 'App\Models\BillingCompany'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\BillingCompany'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Claims\Claim'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Claims\Claim'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Modifier'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Modifier'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Diagnosis'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Diagnosis'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Report'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Report'::text)
                        WHEN audits.auditable_type::text = 'App\Models\InsurancePlan'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\InsurancePlan'::text)
                        WHEN audits.auditable_type::text = 'App\Models\InsuranceCompany'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\InsuranceCompany'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Company'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Company'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Facility'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Facility'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Patient'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Patient'::text)
                        WHEN audits.auditable_type::text = 'App\Models\Procedure'::text
                        THEN (select count(*) from audits where audits.user_id = users.id and audits.auditable_type::text = 'App\Models\Procedure'::text)
                        else 0
                    end
                else 0
            end as sixthrs
        from users
        LEFT JOIN profiles ON users.profile_id = profiles.id
        inner join audits on audits.user_id = users.id
        WHERE
            audits.auditable_type IN (
                'App\Models\User',
                'App\Models\Company',
                'App\Models\HealthProfessional',
                'App\Models\BillingCompany',
                'App\Models\Claims\Claim',
                'App\Models\Modifier',
                'App\Models\Diagnosis',
                'App\Models\Report',
                'App\Models\InsurancePlan',
                'App\Models\InsuranceCompany',
                'App\Models\Facility',
                'App\Models\Patient',
                'App\Models\Procedure'
            )
    ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_change_by_module');
    }
};

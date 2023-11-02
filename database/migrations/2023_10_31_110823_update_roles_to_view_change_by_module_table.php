<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared("
            DROP VIEW IF EXISTS view_change_by_module;
            CREATE OR REPLACE VIEW view_change_by_module AS
            SELECT
                audits.id as id_change,
                audits.user_id,
                CASE
                    WHEN CONCAT_WS(' ', COALESCE(profiles.first_name, ''), COALESCE(profiles.last_name, '')) = ' '
                        THEN 'Console'
                    ELSE CONCAT_WS(' ', COALESCE(profiles.first_name, ''), COALESCE(profiles.last_name, ''))
                END AS user_name,
                (
                    CASE
                        WHEN users.type = '1' THEN
                            (
                                SELECT string_agg(DISTINCT roles.name, ', ')
                                FROM rollables r2
                                LEFT JOIN roles ON r2.role_id = roles.id
                                WHERE r2.rollable_type = 'App\Models\User' AND r2.rollable_id = users.id
                            )
                        WHEN users.type = '2' THEN
                            (
                                SELECT string_agg(DISTINCT roles.name, ', ')
                                FROM rollables r2
                                LEFT JOIN roles ON r2.role_id = roles.id
                                LEFT JOIN billing_company_user ON users.id = billing_company_user.user_id
                                WHERE r2.rollable_type = 'App\Models\BillingCompany\Membership'
                                AND r2.rollable_id = billing_company_user.id
                                AND billing_company_user.billing_company_id = users.billing_company_id
                            )
                        WHEN users.type = '3' THEN
                            (
                                SELECT string_agg(DISTINCT roles.name, ', ')
                                FROM rollables r2
                                LEFT JOIN roles ON r2.role_id = roles.id
                                LEFT JOIN health_professionals ON users.profile_id = health_professionals.profile_id
                                LEFT JOIN billing_company_health_professional ON health_professionals.id = billing_company_health_professional.health_professional_id
                                WHERE r2.rollable_type = 'App\Models\HealthProfessional\Membership'
                                AND r2.rollable_id = billing_company_health_professional.id
                                AND billing_company_health_professional.billing_company_id = users.billing_company_id
                            )
                        WHEN users.type = '4' THEN
                            (
                                SELECT string_agg(DISTINCT roles.name, ', ')
                                FROM rollables r2
                                LEFT JOIN roles ON r2.role_id = roles.id
                                LEFT JOIN patients ON users.profile_id = patients.profile_id
                                LEFT JOIN billing_company_patient ON patients.id = billing_company_patient.patient_id
                                WHERE r2.rollable_type = 'App\Models\Patient\Membership'
                                AND r2.rollable_id = billing_company_patient.id
                                AND billing_company_patient.billing_company_id = users.billing_company_id
                            )
                        ELSE
                            NULL
                    END
                ) AS user_role,
                audits.ip_address,
                CASE
                    WHEN audits.auditable_type = 'App\Models\User' THEN 'User'
                    WHEN audits.auditable_type = 'App\Models\HealthProfessional' THEN 'Health Professional'
                    WHEN audits.auditable_type = 'App\Models\BillingCompany' THEN 'Billing Company'
                    WHEN audits.auditable_type = 'App\Models\Claims\Claim' THEN 'Claim'
                    WHEN audits.auditable_type = 'App\Models\Modifier' THEN 'Modifier'
                    WHEN audits.auditable_type = 'App\Models\Diagnosis' THEN 'Diagnosis'
                    WHEN audits.auditable_type = 'App\Models\Report' THEN 'Report'
                    WHEN audits.auditable_type = 'App\Models\InsurancePlan' THEN 'Insurance Plan'
                    WHEN audits.auditable_type = 'App\Models\InsuranceCompany' THEN 'Insurance Company'
                    WHEN audits.auditable_type = 'App\Models\Company' THEN 'Company'
                    WHEN audits.auditable_type = 'App\Models\Facility' THEN 'Facility'
                    WHEN audits.auditable_type = 'App\Models\Patient' THEN 'Patient'
                    WHEN audits.auditable_type = 'App\Models\Procedure' THEN 'Procedure'
                    ELSE audits.auditable_type
                END AS module,
                CASE
                    WHEN audits.event = 'deleted' THEN 'Deleted'
                    WHEN audits.event = 'restored' THEN 'Restored'
                    WHEN audits.event = 'updated' AND EXISTS (
                        SELECT 1
                        FROM audits AS prev
                        WHERE prev.user_id = audits.user_id
                        AND prev.auditable_type = audits.auditable_type
                        AND prev.event = 'updated'
                        AND prev.created_at < audits.created_at
                        AND (prev.old_values)::jsonb::text = (audits.new_values)::jsonb::text
                        AND (prev.new_values)::jsonb::text = (audits.old_values)::jsonb::text
                    ) THEN 'Roll Back'
                    WHEN audits.event = 'created' THEN 'Created'
                    WHEN audits.event = 'updated' THEN 'Updated'
                    ELSE audits.event
                END AS event,
                audits.created_at AS date_of_event,
                (
                    SELECT MAX(login.created_at)
                    FROM audits AS login
                    WHERE
                        login.auditable_type = 'App\Models\User'
                        AND login.url LIKE '%auth/login'
                        AND (login.old_values)::jsonb::text LIKE '%\"isLogged\": false%'
                        AND (login.new_values)::jsonb::text LIKE '%\"isLogged\": true%'
                        AND login.user_id = audits.user_id
                        AND login.created_at <= audits.created_at
                ) AS date_of_login,
                audits.old_values,
                audits.new_values
            FROM
                audits
            LEFT JOIN users ON audits.user_id = users.id
            LEFT JOIN profiles ON users.profile_id = profiles.id
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
            AND NOT (
                audits.auditable_type = 'App\Models\User'
                AND audits.url LIKE '%auth/login%'
                AND (
                    (audits.old_values)::jsonb::text LIKE '%\"isLogged\": false%' AND (audits.new_values)::jsonb::text LIKE '%\"isLogged\": true%'
                    OR
                    (audits.old_values)::jsonb::text LIKE '%\"isLogged\": true%' AND (audits.new_values)::jsonb::text LIKE '%\"isLogged\": false%'
                    OR
                    (audits.old_values)::jsonb::text LIKE '%\"last_login\"%'
                    OR
                    (audits.new_values)::jsonb::text LIKE '%\"last_login\"%'
                )
            )
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW view_change_by_module');
    }
};

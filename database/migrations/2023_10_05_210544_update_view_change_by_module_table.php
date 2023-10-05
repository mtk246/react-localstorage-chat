<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW view_change_by_module AS
            SELECT
                audits.id as id_change,
                audits.user_id,
                CASE
                    WHEN CONCAT_WS(' ', COALESCE(profiles.first_name, ''), COALESCE(profiles.last_name, '')) = ' '
                        THEN 'Console'
                    ELSE CONCAT_WS(' ', COALESCE(profiles.first_name, ''), COALESCE(profiles.last_name, ''))
                END AS user_name,
                (SELECT string_agg(DISTINCT roles.name, ', ') FROM role_user
                LEFT JOIN roles ON role_user.role_id = roles.id
                WHERE role_user.user_id = users.id) AS user_role,
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
                    WHEN audits.event = 'created' THEN 'Created'
                    WHEN audits.event = 'updated' THEN 'Updated'
                    WHEN audits.event = 'deleted' THEN 'Deleted'
                    WHEN audits.event = 'restored' THEN 'Restored'
                    WHEN audits.event = 'roll-back' THEN 'Roll Back'
                    ELSE audits.event
                END AS event,
                audits.created_at AS date_of_event,
                (
                    SELECT created_at
                    FROM audits AS login
                    WHERE
                        login.auditable_type = 'App\Models\User'
                        AND login.url LIKE '%auth/login'
                        AND (login.old_values)::jsonb::text LIKE '%\"isLogged\": false%'
                        AND (login.new_values)::jsonb::text LIKE '%\"isLogged\": true%'
                        AND login.user_id = audits.user_id
                    LIMIT 1
                ) AS date_of_login,
                audits.old_values,
                audits.new_values
            FROM
                audits
            LEFT JOIN users ON audits.user_id = users.id
            LEFT JOIN profiles ON users.profile_id = profiles.id
            LEFT JOIN role_user ON users.id = role_user.user_id
            LEFT JOIN roles ON role_user.role_id = roles.id
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
                AND audits.url LIKE '%auth/login'
                AND (audits.old_values)::jsonb::text LIKE '%\"isLogged\": false%'
                AND (audits.new_values)::jsonb::text LIKE '%\"isLogged\": true%'
            )
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW view_change_by_module');
    }
};

<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared("
            CREATE OR REPLACE VIEW users_information AS
            SELECT
                users.id as user_id,
                CASE
                    WHEN CONCAT_WS(' ', COALESCE(profiles.first_name, ''), COALESCE(profiles.last_name, '')) = ' '
                        THEN 'Console'
                    ELSE CONCAT_WS(' ', COALESCE(profiles.first_name, ''), COALESCE(profiles.last_name, ''))
                END AS user_complete_name,
                (
                    CASE
                        WHEN users.profile_id IS NOT NULL THEN
                            (
                                SELECT profiles.date_of_birth
                                FROM profiles
                                WHERE profiles.id = users.profile_id
                            )
                        ELSE
                            NULL
                    END
                ) as dob,
                (
                    CASE
                        WHEN users.profile_id IS NOT NULL THEN
                            (
                                SELECT profiles.ssn
                                FROM profiles
                                WHERE profiles.id = users.profile_id
                            )
                        ELSE
                            NULL
                    END
                ) as ssn,
                (
                    CASE
                        WHEN users.type = '2' THEN 'Billing User'
                        WHEN users.type = '3' THEN 'Patient'
                        WHEN users.type = '4' THEN 'Health professional'
                        ELSE
                            NULL
                    END
                ) AS user_type,
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
                users.email as email,
                billing_companies.name as billing_company
            FROM users
            LEFT JOIN profiles ON users.profile_id = profiles.id
            LEFT JOIN billing_companies ON users.billing_company_id = billing_companies.id
            WHERE users.billing_company_id IS NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW users_information');
    }
};

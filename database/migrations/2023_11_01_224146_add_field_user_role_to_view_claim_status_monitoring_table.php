<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared("
            DROP VIEW IF EXISTS view_claims_status_monitoring;
            CREATE VIEW view_claims_status_monitoring AS
            SELECT
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
                companies.name AS company,
                claims.created_at AS day_created,
                claims.code AS claim_code,
                (
                    SELECT claim_statuses.status
                    FROM claim_status_claim
                    INNER JOIN claim_statuses ON claim_statuses.id = claim_status_claim.claim_status_id
                    WHERE claim_status_claim.claim_status_type = 'App\Models\Claims\ClaimStatus'
                    AND claim_status_claim.claim_id = claims.id
                    ORDER BY claim_status_claim.created_at DESC, claim_status_claim.id DESC
                    LIMIT 1
                ) AS status_current,
                (
                    SELECT claim_sub_statuses.name
                    FROM claim_status_claim
                    INNER JOIN claim_sub_statuses ON claim_sub_statuses.id = claim_status_claim.claim_status_id
                    WHERE claim_status_claim.claim_status_type = 'App\Models\Claims\ClaimSubStatus'
                    AND claim_status_claim.claim_id = claims.id
                    ORDER BY claim_status_claim.created_at DESC, claim_status_claim.id DESC
                    LIMIT 1
                ) AS sub_status_Current
            FROM claims
            LEFT JOIN (
                SELECT auditable_id, user_id
                FROM audits
                WHERE audits.id IN (
                    SELECT MIN(id)
                    FROM audits
                    WHERE audits.auditable_type = 'App\Models\Claims\Claim'
                    GROUP BY auditable_id
                )
            ) AS first_audits ON claims.id = first_audits.auditable_id
            LEFT JOIN users ON first_audits.user_id = users.id
            LEFT JOIN profiles ON users.profile_id = profiles.id
            JOIN claim_demographic ON claim_demographic.claim_id = claims.id
            JOIN companies ON claim_demographic.company_id = companies.id
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW view_claims_status_monitoring');
    }
};

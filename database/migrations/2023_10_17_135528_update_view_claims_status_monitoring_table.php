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

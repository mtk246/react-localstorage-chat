<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared("
            CREATE OR REPLACE VIEW view_user_productivity AS
            SELECT
                billing_companies.name AS billing_company,
                billing_companies.abbreviation AS billing_company_abbreviation,
                CASE
                    WHEN CONCAT_WS(' ', COALESCE(user_profile.first_name, ''), COALESCE(user_profile.last_name, '')) = ' '
                        THEN 'Console'
                    ELSE CONCAT_WS(' ', COALESCE(user_profile.first_name, ''), COALESCE(user_profile.last_name, ''))
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
                claims.code AS claim_code,
                (
                    CASE
                        WHEN claims.type = '1' THEN 'Professional'
                        WHEN claims.type = '2' THEN 'Institutional'
                        ELSE
                            NULL
                        END
                ) AS claim_type,
                claim_batches.code AS batch_code,
                claims.created_at AS claim_creation_date,
                CASE
                    WHEN CONCAT_WS(' ', COALESCE(profiles_p.first_name, ''), COALESCE(profiles_p.last_name, '')) = ' '
                        THEN 'Console'
                    ELSE CONCAT_WS(' ', COALESCE(profiles_p.first_name, ''), COALESCE(profiles_p.last_name, ''))
                END AS patient_name,
                (
                    SELECT MIN(services.from_service)
                    FROM claim_services
                    JOIN services ON claim_services.id = services.claim_service_id
                    WHERE claim_services.claim_id = claims.id
                ) AS date_of_service,
                (
                    CASE
                        WHEN claims.type = '1' THEN (
                            SELECT date_information.to_date
                            FROM claim_date_informations AS date_information
                            WHERE date_information.claim_id = claims.id AND date_information.field_id = '4'
                            LIMIT 1
                        )
                        WHEN claims.type = '2' THEN (
                            SELECT patient_information.discharge_date
                            FROM patient_information
                            WHERE patient_information.claim_id = claims.id
                            LIMIT 1
                        )
                        ELSE
                            NULL
                        END
                ) AS discharge_date,
                claim_batches.shipping_date AS shipping_date,
                companies.name AS company,
                facilities.name as facility,
                facility_types.type as facility_type,
                place_of_services.name AS place_of_service,
                (
                    SELECT
                        CASE
                            WHEN CONCAT_WS(' ', COALESCE(profiles_h.first_name, ''), COALESCE(profiles_h.last_name, '')) = ' '
                                THEN 'Console'
                            ELSE CONCAT_WS(' ', COALESCE(profiles_h.first_name, ''), COALESCE(profiles_h.last_name, ''))
                        END
                    FROM profiles as profiles_h
                    LEFT JOIN health_professionals ON health_professionals.profile_id = profiles_h.id
                    LEFT JOIN claim_health_professional ON claim_health_professional.health_professional_id = health_professionals.id
                    WHERE claim_health_professional.field_id = '7' AND claim_health_professional.claim_id = claims.id
                ) AS service_provider,
                (
                    SELECT
                        CASE
                            WHEN CONCAT_WS(' ', COALESCE(profiles_h.first_name, ''), COALESCE(profiles_h.last_name, '')) = ' '
                                THEN 'Console'
                            ELSE CONCAT_WS(' ', COALESCE(profiles_h.first_name, ''), COALESCE(profiles_h.last_name, ''))
                        END
                    FROM profiles as profiles_h
                    LEFT JOIN health_professionals ON health_professionals.profile_id = profiles_h.id
                    LEFT JOIN claim_health_professional ON claim_health_professional.health_professional_id = health_professionals.id
                    WHERE claim_health_professional.field_id = '6' AND claim_health_professional.claim_id = claims.id
                ) AS referred_provider,
                (
                    SELECT
                        CASE
                            WHEN CONCAT_WS(' ', COALESCE(profiles_h.first_name, ''), COALESCE(profiles_h.last_name, '')) = ' '
                                THEN 'Console'
                            ELSE CONCAT_WS(' ', COALESCE(profiles_h.first_name, ''), COALESCE(profiles_h.last_name, ''))
                        END
                    FROM profiles as profiles_h
                    LEFT JOIN health_professionals ON health_professionals.profile_id = profiles_h.id
                    LEFT JOIN claim_health_professional ON claim_health_professional.health_professional_id = health_professionals.id
                    WHERE claim_health_professional.field_id = '5' AND claim_health_professional.claim_id = claims.id
                ) AS billing_provider,
                (
                    SELECT
                        CASE
                            WHEN CONCAT_WS(' ', COALESCE(profiles_h.first_name, ''), COALESCE(profiles_h.last_name, '')) = ' '
                                THEN 'Console'
                            ELSE CONCAT_WS(' ', COALESCE(profiles_h.first_name, ''), COALESCE(profiles_h.last_name, ''))
                        END
                    FROM profiles as profiles_h
                    LEFT JOIN health_professionals ON health_professionals.profile_id = profiles_h.id
                    LEFT JOIN claim_health_professional ON claim_health_professional.health_professional_id = health_professionals.id
                    WHERE claim_health_professional.field_id = '1' OR claim_health_professional.field_id = '76'
                    AND claim_health_professional.claim_id = claims.id
                ) AS attending,
                (
                    SELECT
                        CASE
                            WHEN CONCAT_WS(' ', COALESCE(profiles_h.first_name, ''), COALESCE(profiles_h.last_name, '')) = ' '
                                THEN 'Console'
                            ELSE CONCAT_WS(' ', COALESCE(profiles_h.first_name, ''), COALESCE(profiles_h.last_name, ''))
                        END
                    FROM profiles as profiles_h
                    LEFT JOIN health_professionals ON health_professionals.profile_id = profiles_h.id
                    LEFT JOIN claim_health_professional ON claim_health_professional.health_professional_id = health_professionals.id
                    WHERE claim_health_professional.field_id = '2' OR claim_health_professional.field_id = '77'
                    AND claim_health_professional.claim_id = claims.id
                ) AS open_attending,
                (
                    SELECT
                        CASE
                            WHEN CONCAT_WS(' ', COALESCE(profiles_h.first_name, ''), COALESCE(profiles_h.last_name, '')) = ' '
                                THEN 'Console'
                            ELSE CONCAT_WS(' ', COALESCE(profiles_h.first_name, ''), COALESCE(profiles_h.last_name, ''))
                        END
                    FROM profiles as profiles_h
                    LEFT JOIN health_professionals ON health_professionals.profile_id = profiles_h.id
                    LEFT JOIN claim_health_professional ON claim_health_professional.health_professional_id = health_professionals.id
                    WHERE claim_health_professional.field_id = '3' OR claim_health_professional.field_id = '78'
                    AND claim_health_professional.claim_id = claims.id
                ) AS other_1,
                (
                    SELECT
                        CASE
                            WHEN CONCAT_WS(' ', COALESCE(profiles_h.first_name, ''), COALESCE(profiles_h.last_name, '')) = ' '
                                THEN 'Console'
                            ELSE CONCAT_WS(' ', COALESCE(profiles_h.first_name, ''), COALESCE(profiles_h.last_name, ''))
                        END
                    FROM profiles as profiles_h
                    LEFT JOIN health_professionals ON health_professionals.profile_id = profiles_h.id
                    LEFT JOIN claim_health_professional ON claim_health_professional.health_professional_id = health_professionals.id
                    WHERE claim_health_professional.field_id = '4' OR claim_health_professional.field_id = '79'
                    AND claim_health_professional.claim_id = claims.id
                ) AS other_2,
                procedures.code AS procedure_code,
                procedures.description AS procedure_description,
                (
                    CASE
                        WHEN procedures.type = '1' THEN 'CPT'
                        WHEN procedures.type = '2' THEN 'HCPCS'
                        WHEN procedures.type = '3' THEN 'HIPPS'
                        WHEN procedures.type = '4' THEN 'REVENUE'
                        ELSE
                            NULL
                        END
                ) AS procedure_type,
                revenue.code AS revenue_code,
                revenue.description AS revenue_description,
                COALESCE(services.days_or_units::numeric, 1) AS days_or_units,
                services.copay AS copay,
                services.price AS price,
                (COALESCE(services.days_or_units::numeric, 1) * services.price::numeric) AS charges,
                insurance_companies.name AS insurance_company,
                insurance_plans.name AS insurance_plan,
                ins_type.description AS insurance_type,
                plan_type.description AS insurance_plan_type,
                insurance_policies.policy_number AS insurance_policy_number,
                insurance_policy_type.description AS insurance_policy_type,
                type_responsibility.description AS type_responsibility
            FROM claims
            LEFT JOIN claim_claim_batch ON claim_claim_batch.claim_id = claims.id
            LEFT JOIN claim_batches ON claim_batches.id = claim_claim_batch.claim_batch_id
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
            LEFT JOIN profiles as user_profile ON users.profile_id = user_profile.id
            JOIN billing_companies ON billing_companies.id = claims.billing_company_id
            JOIN claim_demographic ON claim_demographic.claim_id = claims.id
            JOIN patients ON claim_demographic.patient_id = patients.id
            JOIN profiles AS profiles_p ON patients.profile_id = profiles_p.id
            JOIN claim_services ON claim_services.claim_id = claims.id
            JOIN companies ON claim_demographic.company_id = companies.id
            LEFT JOIN facilities ON claim_demographic.facility_id = facilities.id
            LEFT JOIN facility_facility_type ON facilities.id = facility_facility_type.facility_id
            LEFT JOIN facility_types ON facility_facility_type.facility_type_id = facility_types.id
            LEFT JOIN services ON claim_services.id = services.claim_service_id
            LEFT JOIN place_of_services ON services.place_of_service_id::numeric = place_of_services.id
            LEFT JOIN procedures ON services.procedure_id::numeric = procedures.id
            LEFT JOIN procedures as revenue ON services.revenue_code_id::numeric = revenue.id
            LEFT JOIN claim_insurance_policy ON claim_insurance_policy.claim_id = claims.id
            LEFT JOIN insurance_policies ON insurance_policies.id = claim_insurance_policy.insurance_policy_id AND insurance_policies.billing_company_id = claims.billing_company_id
            LEFT JOIN insurance_plans ON insurance_plans.id = insurance_policies.insurance_plan_id
            LEFT JOIN insurance_companies ON insurance_companies.id = insurance_plans.insurance_company_id
            LEFT JOIN type_catalogs as insurance_policy_type ON insurance_policy_type.id = insurance_policies.insurance_policy_type_id
            LEFT JOIN type_catalogs as ins_type ON ins_type.id = insurance_plans.ins_type_id
            LEFT JOIN type_catalogs as plan_type ON plan_type.id = insurance_plans.plan_type_id
            LEFT JOIN type_catalogs as type_responsibility ON type_responsibility.id = insurance_policies.type_responsibility_id
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW view_user_productivity');
    }
};

<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared("
            CREATE OR REPLACE VIEW view_diagnostics_and_procedures AS
            SELECT
                billing_companies.name AS billing_company,
                claims.code AS claim_code,
                (
                    CASE
                        WHEN claims.type = '1' THEN 'Professional'
                        WHEN claims.type = '2' THEN 'Institutional'
                        ELSE
                            NULL
                        END
                ) AS claim_type,
                companies.name AS company,
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
                CASE
                    WHEN CONCAT_WS(' ', COALESCE(profiles_p.first_name, ''), COALESCE(profiles_p.last_name, '')) = ' '
                        THEN 'Console'
                    ELSE CONCAT_WS(' ', COALESCE(profiles_p.first_name, ''), COALESCE(profiles_p.last_name, ''))
                END AS patient_name,
                company_patient.med_num as medical_no,
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
                (
                    SELECT diagnoses.code
                    FROM diagnoses
                    JOIN claim_diagnosis ON claim_diagnosis.diagnosis_id = diagnoses.id
                    WHERE claim_diagnosis.claim_service_id = claim_services.id AND claim_diagnosis.item = 'A'
                    LIMIT 1
                ) AS Dx_A,
                (
                    SELECT diagnoses.code
                    FROM diagnoses
                    JOIN claim_diagnosis ON claim_diagnosis.diagnosis_id = diagnoses.id
                    WHERE claim_diagnosis.claim_service_id = claim_services.id AND claim_diagnosis.item = 'B'
                    LIMIT 1
                ) AS Dx_B,
                (
                    SELECT diagnoses.code
                    FROM diagnoses
                    JOIN claim_diagnosis ON claim_diagnosis.diagnosis_id = diagnoses.id
                    WHERE claim_diagnosis.claim_service_id = claim_services.id AND claim_diagnosis.item = 'C'
                    LIMIT 1
                ) AS Dx_C,
                (
                    SELECT diagnoses.code
                    FROM diagnoses
                    JOIN claim_diagnosis ON claim_diagnosis.diagnosis_id = diagnoses.id
                    WHERE claim_diagnosis.claim_service_id = claim_services.id AND claim_diagnosis.item = 'D'
                    LIMIT 1
                ) AS Dx_D,
                (
                    SELECT diagnoses.code
                    FROM diagnoses
                    JOIN claim_diagnosis ON claim_diagnosis.diagnosis_id = diagnoses.id
                    WHERE claim_diagnosis.claim_service_id = claim_services.id AND claim_diagnosis.item = 'E'
                    LIMIT 1
                ) AS Dx_E,
                (
                    SELECT diagnoses.code
                    FROM diagnoses
                    JOIN claim_diagnosis ON claim_diagnosis.diagnosis_id = diagnoses.id
                    WHERE claim_diagnosis.claim_service_id = claim_services.id AND claim_diagnosis.item = 'F'
                    LIMIT 1
                ) AS Dx_F,
                (
                    SELECT diagnoses.code
                    FROM diagnoses
                    JOIN claim_diagnosis ON claim_diagnosis.diagnosis_id = diagnoses.id
                    WHERE claim_diagnosis.claim_service_id = claim_services.id AND claim_diagnosis.item = 'G'
                    LIMIT 1
                ) AS Dx_G,
                (
                    SELECT diagnoses.code
                    FROM diagnoses
                    JOIN claim_diagnosis ON claim_diagnosis.diagnosis_id = diagnoses.id
                    WHERE claim_diagnosis.claim_service_id = claim_services.id AND claim_diagnosis.item = 'H'
                    LIMIT 1
                ) AS Dx_H,
                (
                    SELECT diagnoses.code
                    FROM diagnoses
                    JOIN claim_diagnosis ON claim_diagnosis.diagnosis_id = diagnoses.id
                    WHERE claim_diagnosis.claim_service_id = claim_services.id AND claim_diagnosis.item = 'I'
                    LIMIT 1
                ) AS Dx_I,
                (
                    SELECT diagnoses.code
                    FROM diagnoses
                    JOIN claim_diagnosis ON claim_diagnosis.diagnosis_id = diagnoses.id
                    WHERE claim_diagnosis.claim_service_id = claim_services.id AND claim_diagnosis.item = 'J'
                    LIMIT 1
                ) AS Dx_J,
                (
                    SELECT diagnoses.code
                    FROM diagnoses
                    JOIN claim_diagnosis ON claim_diagnosis.diagnosis_id = diagnoses.id
                    WHERE claim_diagnosis.claim_service_id = claim_services.id AND claim_diagnosis.item = 'K'
                    LIMIT 1
                ) AS Dx_K,
                (
                    SELECT diagnoses.code
                    FROM diagnoses
                    JOIN claim_diagnosis ON claim_diagnosis.diagnosis_id = diagnoses.id
                    WHERE claim_diagnosis.claim_service_id = claim_services.id AND claim_diagnosis.item = 'L'
                    LIMIT 1
                ) AS Dx_L,
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
                (
                    SELECT
                        CASE WHEN EXISTS (
                            SELECT 1
                                FROM company_services
                                JOIN medications ON medications.company_service_id = company_services.id
                                WHERE company_services.company_id = companies.id AND company_services.procedure_id = procedures.id AND company_services.billing_company_id = billing_companies.id
                        )
                        THEN 'Yes'
                        ELSE 'No'
                    END
                ) AS is_medicine,
                revenue.code AS revenue_code,
                revenue.description AS revenue_description,
                COALESCE(services.days_or_units::numeric, 1) AS days_or_units,
                services.price AS price,
                (COALESCE(services.days_or_units::numeric, 1) * services.price::numeric) AS charges
            FROM claims
            JOIN billing_companies ON billing_companies.id = claims.billing_company_id
            JOIN claim_demographic ON claim_demographic.claim_id = claims.id
            JOIN claim_services ON claim_services.claim_id = claims.id
            JOIN companies ON claim_demographic.company_id = companies.id
            JOIN patients ON claim_demographic.patient_id = patients.id
            JOIN profiles AS profiles_p ON patients.profile_id = profiles_p.id
            LEFT JOIN company_patient ON patients.id = company_patient.patient_id AND company_patient.company_id = companies.id
            LEFT JOIN services ON claim_services.id = services.claim_service_id
            LEFT JOIN procedures ON services.procedure_id::numeric = procedures.id
            LEFT JOIN procedures as revenue ON services.revenue_code_id::numeric = revenue.id
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW view_diagnostics_and_procedures');
    }
};

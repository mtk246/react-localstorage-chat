<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared("
            CREATE OR REPLACE VIEW view_patients_information AS
            SELECT
                patients.id,
                CASE
                    WHEN CONCAT_WS(' ', COALESCE(profiles.first_name, ''), COALESCE(profiles.last_name, '')) = ' '
                        THEN 'Console'
                    ELSE CONCAT_WS(' ', COALESCE(profiles.first_name, ''), COALESCE(profiles.last_name, ''))
                END AS patient,
                profiles.date_of_birth as dob,
                company_patient.med_num as medical_no,
                patients.code as system_code,
                insurance_policies.policy_number as  policy_number,
                insurance_plans.name as insurance_plan,
                insurance_companies.name as insurance_company,
                claim_eligibility_statuses.status as eligibility,
                insurance_policies.status as policy_status
            FROM patients
            LEFT OUTER JOIN profiles ON patients.profile_id = profiles.id
            LEFT OUTER JOIN insurance_plan_patient ON patients.id = insurance_plan_patient.patient_id
            LEFT OUTER JOIN insurance_plans ON insurance_plan_patient.insurance_plan_id = insurance_plans.id
            LEFT OUTER JOIN insurance_policies ON patients.id = insurance_policies.patient_id
            LEFT OUTER JOIN insurance_companies ON insurance_plans.insurance_company_id = insurance_companies.id
            LEFT OUTER JOIN company_patient ON patients.id = company_patient.patient_id
            LEFT OUTER JOIN claim_eligibilities ON patients.id = claim_eligibilities.patient_id
            LEFT OUTER JOIN claim_eligibility_statuses ON claim_eligibilities.claim_eligibility_status_id = claim_eligibility_statuses.id
        ");
    }

    public function down(): void
    {
        DB::unprepared("
            CREATE OR REPLACE VIEW view_patients_information AS
            SELECT
                patients.id,
                CASE
                    WHEN CONCAT_WS(' ', COALESCE(profiles.first_name, ''), COALESCE(profiles.last_name, '')) = ' '
                        THEN 'Console'
                    ELSE CONCAT_WS(' ', COALESCE(profiles.first_name, ''), COALESCE(profiles.last_name, ''))
                END AS patient,
                profiles.date_of_birth as dob,
                company_patient.med_num as medical_no,
                patients.code as system_code,
                insurance_policies.policy_number as  policy_number,
                insurance_plans.name as insurance_plan,
                insurance_companies.name as insurance_company,
                claim_eligibility_statuses.status as eligibility,
                insurance_policies.status as policy_status
            FROM patients
            LEFT JOIN profiles ON patients.profile_id = profiles.id
            JOIN users ON profiles.id = users.profile_id
            JOIN insurance_plan_patient ON patients.id = insurance_plan_patient.patient_id
            LEFT JOIN insurance_plans ON insurance_plan_patient.insurance_plan_id = insurance_plans.id
            JOIN insurance_policies ON patients.id = insurance_policies.patient_id
            JOIN insurance_companies ON insurance_plans.insurance_company_id = insurance_companies.id
            JOIN company_patient ON patients.id = company_patient.patient_id
            LEFT OUTER JOIN claim_eligibilities ON patients.id = claim_eligibilities.patient_id
            LEFT OUTER JOIN claim_eligibility_statuses ON claim_eligibilities.claim_eligibility_status_id = claim_eligibility_statuses.id
        ");
    }
};

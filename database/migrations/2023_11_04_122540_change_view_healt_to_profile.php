<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class() extends Migration {
    public function up(): void
    {
        DB::unprepared("
            CREATE OR REPLACE VIEW view_health_professional_information AS
            SELECT
                health_professionals.id,
                CASE
                    WHEN CONCAT_WS(' ', COALESCE(profiles.first_name, ''), COALESCE(profiles.last_name, '')) = ' '
                        THEN 'Console'
                    ELSE CONCAT_WS(' ', COALESCE(profiles.first_name, ''), COALESCE(profiles.last_name, ''))
                END AS health_professional_name,
                health_professionals.npi as npi,
                (
                    CASE
                        WHEN health_professional_types.type = '1' THEN 'Medical doctor'
                        WHEN health_professional_types.type = '2' THEN 'Nurse practitioners'
                        WHEN health_professional_types.type = '3' THEN 'Physician assistants'
                        WHEN health_professional_types.type = '4' THEN 'Certified nurse specialists trained in a particular field such as E/R, pediatric or diabetic nursing'
                        WHEN health_professional_types.type = '5' THEN 'Certified nurse midwives'
                        WHEN health_professional_types.type = '6' THEN 'Certified registered nurse anesthetists'
                        WHEN health_professional_types.type = '7' THEN 'Clinical social worker'
                        WHEN health_professional_types.type = '8' THEN 'Physical therapists'
                        ELSE
                            NULL
                    END
                ) AS type,
                billing_companies.name as billing_company,
                companies.name as company,
                contacts.contact_name as contact_name,
                contacts.phone as phone,
                contacts.fax as fax,
                contacts.email as email
            FROM health_professionals
            LEFT JOIN profiles ON health_professionals.profile_id = profiles.id
            JOIN health_professional_types ON health_professionals.id = health_professional_types.health_professional_id
            JOIN billing_companies ON health_professional_types.billing_company_id = billing_companies.id
            LEFT JOIN company_health_professional ON health_professionals.id = company_health_professional.health_professional_id
            LEFT JOIN companies ON company_health_professional.company_id = companies.id
            LEFT JOIN contacts On profiles.id = contacts.contactable_id
                    WHERE contacts.contactable_type = 'App\Models\Profile'
                    AND contacts.billing_company_id = health_professional_types.billing_company_id

        ");
    }

    public function down(): void
    {
        DB::unprepared("
            CREATE OR REPLACE VIEW view_health_professional_information AS
            SELECT
                health_professionals.id,
                CASE
                    WHEN CONCAT_WS(' ', COALESCE(profiles.first_name, ''), COALESCE(profiles.last_name, '')) = ' '
                        THEN 'Console'
                    ELSE CONCAT_WS(' ', COALESCE(profiles.first_name, ''), COALESCE(profiles.last_name, ''))
                END AS health_professional_name,
                health_professionals.npi as npi,
                (
                    CASE
                        WHEN health_professional_types.type = '1' THEN 'Medical doctor'
                        WHEN health_professional_types.type = '2' THEN 'Nurse practitioners'
                        WHEN health_professional_types.type = '3' THEN 'Physician assistants'
                        WHEN health_professional_types.type = '4' THEN 'Certified nurse specialists trained in a particular field such as E/R, pediatric or diabetic nursing'
                        WHEN health_professional_types.type = '5' THEN 'Certified nurse midwives'
                        WHEN health_professional_types.type = '6' THEN 'Certified registered nurse anesthetists'
                        WHEN health_professional_types.type = '7' THEN 'Clinical social worker'
                        WHEN health_professional_types.type = '8' THEN 'Physical therapists'
                        ELSE
                            NULL
                    END
                ) AS type,
                billing_companies.name as billing_company,
                companies.name as company,
                contacts.contact_name as contact_name,
                contacts.phone as phone,
                contacts.fax as fax,
                contacts.email as email
            FROM health_professionals
            LEFT JOIN profiles ON health_professionals.profile_id = profiles.id
            JOIN users ON profiles.id = users.profile_id
            JOIN health_professional_types ON health_professionals.id = health_professional_types.health_professional_id
            JOIN billing_companies ON health_professional_types.billing_company_id = billing_companies.id
            LEFT JOIN company_health_professional ON health_professionals.id = company_health_professional.health_professional_id
            LEFT JOIN companies ON company_health_professional.company_id = companies.id
            LEFT JOIN contacts On profiles.id = contacts.contactable_id
                    WHERE contacts.contactable_type = 'App\Models\Profile'
                    AND contacts.billing_company_id = health_professional_types.billing_company_id

        ");
    }
};

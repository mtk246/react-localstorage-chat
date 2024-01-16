<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW public.view_sobg_dpr
            AS select
                billing_companies.id AS billing_id,
                concat(billing_companies.abbreviation, ' - ', billing_companies.name) AS billing_companies,
                concat( (
                        SELECT
                            entity_abbreviations.abbreviation
                        FROM
                            entity_abbreviations
                        WHERE
                            entity_abbreviations.abbreviable_type::text = 'App\Models\Company'::text
                            AND entity_abbreviations.abbreviable_id = companies.id
                        LIMIT
                            1
                    ), ' - ', companies.name
                ) as provider,
                concat(( SELECT entity_abbreviations.abbreviation
                    FROM entity_abbreviations
                    WHERE entity_abbreviations.abbreviable_type::text = 'App\Models\Company'::text AND entity_abbreviations.abbreviable_id = companies.id
                    LIMIT 1), ' - ', companies.name) AS companies,
                    concat(
                    UPPER( 
                        (
                            SELECT entity_abbreviations.abbreviation 
                            FROM entity_abbreviations 
                            WHERE entity_abbreviations.abbreviable_type::text = 'App\Models\InsuranceCompany'::text AND entity_abbreviations.abbreviable_id = insurance_companies.id LIMIT 1
                        )
                    ), 
                    ': ', insurance_companies.name
                ) AS insurance,
                concat(profiles.first_name, ', ', profiles.last_name) as patient_name,
                (	
                    select 
                        claim_transmission_responses.response_details::json->'request'->'claimInformation'->>'patientControlNumber' 
                    from claim_transmission_responses 
                    where claim_transmission_responses.response_details notnull and claim_transmission_responses.claim_id = claim_insurance_policy.id limit 1
                ) as account,
                case
                    when (DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 31 and 60) then '31-60'
                    when (DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 31 and 90) then '31-90'
                    when (DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 91 and 130) then '91-120'
                    when (DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 121 and 150) then '121-150'
                    when (DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 151 and 180) then '151-180'
                    when (DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 31 and 241) then '181-210'
                    when (DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 61 and 90) then '61-90'
                    when (DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) between 31 and 241) then '31-241 +'
                    when (DATE_PART('day', CURRENT_DATE - services.from_service::timestamp) > 241) then '241 +'
                    else ''
                end as aging,
                ( SELECT claim_services_1.from
                    FROM claim_services claim_services_1
                    WHERE claim_services_1.claim_id = claim_insurance_policy.claim_id
                    LIMIT 1) AS dos,
                claim_statuses.status as action_type,
                coalesce(services.price::numeric * services.days_or_units::numeric, 0) as unpaid_amount,
                (
                    select 
                        private_notes.note 
                    from claim_status_claim
                    inner join private_notes on private_notes.publishable_type::text = 'App\Models\Claims\ClaimStatusClaim' and private_notes.publishable_id = claim_status_claim.id
                    where claim_status_claim.claim_id = claim_insurance_policy.claim_id
                    limit 1
                ) as status
            from claim_insurance_policy
            inner join claim_services on claim_services.claim_id = claim_insurance_policy.claim_id
            inner join (select distinct on(services.claim_service_id) claim_service_id, services.from_service, services.price, services.days_or_units, services.id from services) as services on services.claim_service_id = claim_services.id 
            inner join (select distinct on (insurance_policies.insurance_plan_id) insurance_plan_id, insurance_policies.id from insurance_policies ) as insurance_policies on insurance_policies.id = claim_insurance_policy.insurance_policy_id 
            inner join insurance_plans on insurance_plans.id = insurance_policies.insurance_plan_id
            inner join insurance_companies on insurance_companies.id = insurance_plans.insurance_company_id 
            inner join claim_demographic on claim_demographic.claim_id = claim_insurance_policy.claim_id 
            inner join companies on companies.id = claim_demographic.company_id 
            inner join patients on patients.id = claim_demographic.patient_id
            inner join profiles on profiles.id = patients.profile_id
            inner join (select distinct on (billing_company_insurance_company.insurance_company_id) insurance_company_id, billing_company_insurance_company.billing_company_id from billing_company_insurance_company) as billing_company_insurance_company on billing_company_insurance_company.insurance_company_id = insurance_companies.id
            inner join billing_companies on billing_companies.id = billing_company_insurance_company.billing_company_id
            inner join (select distinct on (claim_status_claim.claim_id) claim_id, claim_status_claim.claim_status_id from claim_status_claim) as claim_status_claim on claim_status_claim.claim_id = claim_insurance_policy.claim_id 
            inner join claim_statuses on claim_statuses.id = claim_status_claim.claim_status_id
            order by insurance asc
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_sobg_dpr');
    }
};

<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;

return new class() extends Migration {
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW public.view_posted_payment_transaction_audit
            AS select
                billing_companies.id as billing_id,
                concat(billing_companies.abbreviation, '-', billing_companies.name) as billing_companies,
                concat((
                    select
                        entity_abbreviations.abbreviation
                    from
                        entity_abbreviations
                    where
                        entity_abbreviations.abbreviable_type::text = 'App\Models\Company'::text 
                    and entity_abbreviations.abbreviable_id = companies.id
                    limit 1),
                    ' - ',
                    companies.name
                ) as companies,
                concat(
                    UPPER( 
                        (
                            select entity_abbreviations.abbreviation 
                            from entity_abbreviations 
                            where entity_abbreviations.abbreviable_type::text = 'App\Models\InsuranceCompany'::text and entity_abbreviations.abbreviable_id = insurance_companies.id limit 1
                        )
                    ), 
                    ': ',
                    insurance_companies.name
                ) as insurance,
                concat(
                    UPPER( 
                        (
                            select entity_abbreviations.abbreviation 
                            from entity_abbreviations 
                            where entity_abbreviations.abbreviable_type::text = 'App\Models\Facility'::text and entity_abbreviations.abbreviable_id = facilities.id limit 1
                        )
                    ), 
                    ': ',
                    facilities.name
                ) as fascilities,
                to_char(payment_batches.updated_at, 'MM/YYYY') as deposit_date,
                count(payments.id) as trans_count,
                sum(payments.total_amount) as amount
            from payments
            inner join (select * from payment_batches where payment_batches.status::integer = 3::integer) as payment_batches on payment_batches.id = payments.payment_batch_id
            inner join companies on companies.id = payment_batches.company_id
            inner join billing_companies on	billing_companies.id = payment_batches.billing_company_id
            inner join insurance_plans on insurance_plans.id = payments.insurance_plan_id
            inner join insurance_companies on insurance_companies.id = insurance_plans.insurance_company_id
            inner join claim_payment on claim_payment.payment_id = payments.id
            inner join claim_demographic on claim_demographic.claim_id = claim_payment.claim_id 
            inner join facilities on facilities.id = claim_demographic.facility_id 
            group by insurance, companies.id, billing_id, deposit_date, fascilities
        ");
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_posted_payment_transaction_audit');
    }
};

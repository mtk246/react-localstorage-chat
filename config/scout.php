<?php

declare(strict_types=1);

use App\Enums\SearchFilterType;
use App\Models\BillingCompany;
use App\Models\Claims\Claim;
use App\Models\Claims\DenialRefile;
use App\Models\Claims\DenialTracking;
use App\Models\Claims\Rules;
use App\Models\ClearingHouse;
use App\Models\Company;
use App\Models\Diagnosis;
use App\Models\Facility;
use App\Models\HealthProfessional;
use App\Models\InsuranceCompany;
use App\Models\InsurancePlan;
use App\Models\Modifier;
use App\Models\Patient;
use App\Models\Payments\Batch as PaymentsBatch;
use App\Models\Procedure;
use App\Models\User;

return [
    'index' => [
        SearchFilterType::BILLING_COMPANY->value => BillingCompany::class,
        SearchFilterType::CLAIM->value => Claim::class,
        SearchFilterType::CLAIM_RULE->value => Rules::class,
        SearchFilterType::COMPANY->value => Company::class,
        SearchFilterType::FACILITY->value => Facility::class,
        SearchFilterType::HEALTH_PROFESSIONAL->value => HealthProfessional::class,
        SearchFilterType::PATIENT->value => Patient::class,
        SearchFilterType::INSURANCE_COMPANY->value => InsuranceCompany::class,
        SearchFilterType::INSURANCE_PLAN->value => InsurancePlan::class,
        SearchFilterType::PROCEDURE->value => Procedure::class,
        SearchFilterType::DIACNOSIS->value => Diagnosis::class,
        SearchFilterType::MODIFIER->value => Modifier::class,
        SearchFilterType::USER->value => User::class,
        SearchFilterType::CLEARING_HOUSE->value => ClearingHouse::class,
        SearchFilterType::PAYMENT_BATCH->value => PaymentsBatch::class,
        SearchFilterType::DENIAL_TRACKING->value => DenialTracking::class,
    ],
    /*
    |--------------------------------------------------------------------------
    | Default Search Engine
    |--------------------------------------------------------------------------
    |
    | This option controls the default search connection that gets used while
    | using Laravel Scout. This connection is used when syncing all models
    | to the search service. You should adjust this based on your needs.
    |
    | Supported: "algolia", "meilisearch", "database", "collection", "null"
    |
    */

    'driver' => env('SCOUT_DRIVER', 'algolia'),

    /*
    |--------------------------------------------------------------------------
    | Index Prefix
    |--------------------------------------------------------------------------
    |
    | Here you may specify a prefix that will be applied to all search index
    | names used by Scout. This prefix may be useful if you have multiple
    | "tenants" or applications sharing the same search infrastructure.
    |
    */

    'prefix' => env('SCOUT_PREFIX', ''),

    /*
    |--------------------------------------------------------------------------
    | Queue Data Syncing
    |--------------------------------------------------------------------------
    |
    | This option allows you to control if the operations that sync your data
    | with your search engines are queued. When this is set to "true" then
    | all automatic data syncing will get queued for better performance.
    |
    */

    'queue' => env('SCOUT_QUEUE', false),

    /*
    |--------------------------------------------------------------------------
    | Database Transactions
    |--------------------------------------------------------------------------
    |
    | This configuration option determines if your data will only be synced
    | with your search indexes after every open database transaction has
    | been committed, thus preventing any discarded data from syncing.
    |
    */

    'after_commit' => true,

    /*
    |--------------------------------------------------------------------------
    | Chunk Sizes
    |--------------------------------------------------------------------------
    |
    | These options allow you to control the maximum chunk size when you are
    | mass importing data into the search engine. This allows you to fine
    | tune each of these chunk sizes based on the power of the servers.
    |
    */

    'chunk' => [
        'searchable' => 500,
        'unsearchable' => 500,
    ],

    /*
    |--------------------------------------------------------------------------
    | Soft Deletes
    |--------------------------------------------------------------------------
    |
    | This option allows to control whether to keep soft deleted records in
    | the search indexes. Maintaining soft deleted records can be useful
    | if your application still needs to search for the records later.
    |
    */

    'soft_delete' => false,

    /*
    |--------------------------------------------------------------------------
    | Identify User
    |--------------------------------------------------------------------------
    |
    | This option allows you to control whether to notify the search engine
    | of the user performing the search. This is sometimes useful if the
    | engine supports any analytics based on this application's users.
    |
    | Supported engines: "algolia"
    |
    */

    'identify' => env('SCOUT_IDENTIFY', false),

    /*
    |--------------------------------------------------------------------------
    | Algolia Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Algolia settings. Algolia is a cloud hosted
    | search engine which works great with Scout out of the box. Just plug
    | in your application ID and admin API key to get started searching.
    |
    */

    'algolia' => [
        'id' => env('ALGOLIA_APP_ID', ''),
        'secret' => env('ALGOLIA_SECRET', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Meilisearch Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your Meilisearch settings. Meilisearch is an open
    | source search engine with minimal configuration. Below, you can state
    | the host and key information for your own Meilisearch installation.
    |
    | See: https://docs.meilisearch.com/guides/advanced_guides/configuration.html
    |
    */

    'meilisearch' => [
        'host' => env('MEILISEARCH_HOST', 'http://localhost:7700'),
        'key' => env('MEILISEARCH_KEY'),
        'index-settings' => [
            BillingCompany::class => [
                'filterableAttributes' => [
                    'tax_id',
                    'name',
                    'code',
                    'icon',
                    'abbreviation',
                    'contact.email',
                    'contacts.email',
                    'active',
                ],
                'sortableAttributes' => [
                    'tax_id',
                    'name',
                    'code',
                    'icon',
                    'abbreviation',
                    'contact.email',
                    'contacts.email',
                    'active',
                ],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            Claim::class => [
                'filterableAttributes' => [
                    'id',
                    'code',
                    'type',
                    'format',
                    'submitter_name',
                    'submitter_contact',
                    'submitter_phone',
                    'billing_company.code',
                    'billing_company.name',
                    'billing_company.abbreviation',
                    'last_modified',
                    'billed_amount',
                    'amount_paid',
                    'past_due_date',
                    'date_of_service',
                    'company.name',
                    'company.abbreviation',
                    'patient.name',
                    'policy.number',
                    'insurance_plan.name',
                    'transmitted',
                    'status',
                    'sub_status',
                    'user_created',
                    'follow_up',
                ],
                'sortableAttributes' => [
                    'id',
                    'code',
                    'type',
                    'format',
                    'date_of_service',
                    'submitter_name',
                    'submitter_contact',
                    'submitter_phone',
                    'billing_company.code',
                    'billing_company.name',
                    'billing_company.abbreviation',
                    'company.name',
                    'company.abbreviation',
                    'patient.name',
                    'policy.number',
                    'insurance_plan.name',
                    'transmitted',
                    'status',
                    'sub_status',
                    'user_created',
                    'follow_up',
                ],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            Rules::class => [
                'filterableAttributes' => [
                    'id',
                    'name',
                    'description',
                    'billing_company_id',
                    'billing_company',
                    'insurance_plans',
                ],
                'sortableAttributes' => [
                    'id',
                    'created_at',
                    'name',
                    'description',
                    'billing_company_id',
                    'billing_company',
                    'insurance_plans',
                ],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            Company::class => [
                'filterableAttributes' => [
                    'id',
                    'code',
                    'name',
                    'npi',
                    'ein',
                    'clia',
                    'abbreviations',
                    'contacts.phone',
                    'contacts.fax',
                    'contacts.email',
                    'contacts.mobile',
                    'billingCompanies.id',
                    'billingCompanies.name',
                ],
                'sortableAttributes' => [
                    'id',
                    'name',
                    'code',
                    'npi',
                    'ein',
                    'created_at',
                ],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            Facility::class => [
                'filterableAttributes' => [
                    'id',
                    'code',
                    'name',
                    'npi',
                    'companies',
                    'facilityTypes',
                    'billingCompanies.id',
                    'billingCompanies.name',
                ],
                'sortableAttributes' => [
                    'id',
                    'name',
                    'code',
                    'npi',
                    'created_at',
                ],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            HealthProfessional::class => [
                'filterableAttributes' => [
                    'id',
                    'code',
                    'npi',
                    'name',
                    'profile.first_name',
                    'profile.middle_name',
                    'profile.last_name',
                    'profiles.date_of_birth',
                    'user.email',
                    'user.ssn',
                    'user.phone',
                    'company.name',
                    'company.npi',
                    'company.code',
                    'billingCompanies.id',
                    'billingCompanies.name',
                ],
                'sortableAttributes' => [
                    'id',
                    'profile.first_name',
                    'profile.middle_name',
                    'profile.last_name',
                    'npi',
                    'created_at',
                ],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            Patient::class => [
                'filterableAttributes' => [
                    'code',
                    'name',
                    'profile.first_name',
                    'profile.middle_name',
                    'profile.last_name',
                    'profile.date_of_birth',
                    'companies',
                    'billingCompanies.id',
                    'billingCompanies.name',
                    'user.code',
                    'user.mail',
                ],
                'sortableAttributes' => [
                    'id',
                    'code',
                    'profile.first_name',
                    'profile.middle_name',
                    'profile.last_name',
                    'profile.date_of_birth',
                    'created_at',
                ],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            InsuranceCompany::class => [
                'filterableAttributes' => [
                    'code',
                    'name',
                    'naic',
                    'public_note',
                    'contacts',
                    'addresses',
                ],
                'sortableAttributes' => ['created_at'],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            InsurancePlan::class => [
                'filterableAttributes' => [
                    'code',
                    'name',
                    'public_note',
                    'contacts',
                    'addresses',
                ],
                'sortableAttributes' => ['created_at'],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            Procedure::class => [
                'filterableAttributes' => [
                    'code',
                    'public_note',
                    'start_date',
                    'end_date',
                    'short_description',
                    'description',
                    'type',
                    'clasifications',
                ],
                'sortableAttributes' => [
                    'code',
                    'public_note',
                    'start_date',
                    'end_date',
                    'short_description',
                    'description',
                    'type',
                    'clasifications',
                ],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            Diagnosis::class => [
                'filterableAttributes' => [
                    'code',
                    'start_date',
                    'end_date',
                    'description',
                    'public_note',
                ],
                'sortableAttributes' => ['created_at'],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            Modifier::class => [
                'filterableAttributes' => [
                    'modifier',
                    'start_date',
                    'end_date',
                    'special_coding_instructions',
                    'classification',
                    'type',
                    'description',
                    'public_note',
                ],
                'sortableAttributes' => ['created_at'],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            User::class => [
                'filterableAttributes' => [
                    'usercode',
                    'email',
                    'contacts',
                    'addresses',
                    'profile.first_name',
                    'profile.last_name',
                    'profile.ssn',
                    'profile.phone',
                ],
                'sortableAttributes' => ['created_at'],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            ClearingHouse::class => [
                'filterableAttributes' => [
                    'code',
                    'name',
                    'contacts',
                    'addresses',
                ],
                'sortableAttributes' => ['created_at'],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            PaymentsBatch::class => [
                'filterableAttributes' => [
                    'name',
                    'posting_date',
                    'currency',
                    'amount',
                    'status',
                    'payments',
                    'created_at',
                    'updated_at',
                    'company.name',
                    'company.code',
                    'company.npi',
                    'company.ein',
                    'company.clia',
                    'billing_company.id',
                    'billing_company.name',
                ],
                'sortableAttributes' => [
                    'name',
                    'posting_date',
                    'currency',
                    'amount',
                    'status',
                    'payments',
                    'company.name',
                    'company.code',
                    'billing_company.name',
                    'created_at',
                ],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            DenialRefile::class => [
                'filterableAttributes' => [
                    'refile_type',
                    'policy_id',
                    'is_cross_over',
                    'cross_over_date',
                    'note',
                    'original_claim_id',
                    'refile_reason',
                    'claim_id',
                    'private_note_id',
                    'created_at',
                    'updated_at',
                    'refile_reason.description',
                    'insurance_policy.policy_id',
                    'insurance_policy.policy_number',
                    'private_notes.id',
                    'private_notes.note',
                    'private_notes.billing_company_id',
                    'private_notes.publishable_type',
                    'private_notes.publishable_id',
                    'claim.claim_number',
                    'claim.status',
                    'claim.sub_status',
                ],
                'sortableAttributes' => [
                    'refile_type',
                    'policy_id',
                    'is_cross_over',
                    'cross_over_date',
                    'note',
                    'original_claim_id',
                    'refile_reason',
                    'claim_id',
                    'private_note_id',
                    'refile_reason.description',
                    'insurance_policy.policy_id',
                    'insurance_policy.policy_number',
                    'private_notes.id',
                    'private_notes.note',
                    'private_notes.billing_company_id',
                    'private_notes.publishable_type',
                    'private_notes.publishable_id',
                    'claim.code',
                ],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
            DenialTracking::class => [
                'filterableAttributes' => [
                    'interface_type',
                    'is_reprocess_claim',
                    'is_contact_to_patient',
                    'contact_through',
                    'claim_number',
                    'rep_name',
                    'ref_number',
                    'claim_status',
                    'claim_sub_status',
                    'created_at',
                    'updated_at',
                    'tracking_date',
                    'resolution_time',
                    'past_due_date',
                    'follow_up',
                    'department_responsible',
                    'policy_responsible',
                    'response_details',
                    'private_note_id',
                    'claim_id',
                    'policy_id',
                ],
                'sortableAttributes' => [
                    'interface_type',
                    'is_reprocess_claim',
                    'is_contact_to_patient',
                    'contact_through',
                    'claim_number',
                    'rep_name',
                    'ref_number',
                    'claim_status',
                    'claim_sub_status',
                    'created_at',
                    'updated_at',
                    'tracking_date',
                    'resolution_time',
                    'past_due_date',
                    'follow_up',
                    'department_responsible',
                    'policy_responsible',
                    'response_details',
                    'private_note_id',
                    'claim_id',
                    'policy_id',
                ],
                'rankingRules' => ['sort', 'words', 'typo', 'proximity', 'attribute', 'exactness'],
            ],
        ],
    ],
];

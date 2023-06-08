<?php

declare(strict_types=1);

use App\Enums\SearchFilterType;
use App\Models\BillingCompany;
use App\Models\Claim;
use App\Models\ClearingHouse;
use App\Models\Company;
use App\Models\Diagnosis;
use App\Models\Facility;
use App\Models\HealthProfessional;
use App\Models\InsuranceCompany;
use App\Models\InsurancePlan;
use App\Models\Modifier;
use App\Models\Patient;
use App\Models\Procedure;
use App\Models\User;

return [
    'index' => [
        SearchFilterType::BILLING_COMPANY->value => BillingCompany::class,
        SearchFilterType::CLAIM->value => Claim::class,
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
                'filterableAttributes' => ['name', 'code', 'abbreviation'],
                'sortableAttributes' => ['created_at'],
            ],
            Claim::class => [
                'filterableAttributes' => [
                    'control_number',
                    'company.code',
                    'company.name',
                    'company.npi',
                    'company.ein',
                    'company.upin',
                    'company.clia',
                ],
                'sortableAttributes' => ['created_at'],
            ],
            Company::class => [
                'filterableAttributes' => ['code', 'name', 'npi', 'ein', 'upin', 'clia'],
                'sortableAttributes' => ['created_at'],
            ],
            Facility::class => [
                'filterableAttributes' => ['code', 'name', 'npi'],
                'sortableAttributes' => ['created_at'],
            ],
            HealthProfessional::class => [
                'filterableAttributes' => [
                    'code',
                    'npi',
                    'user.full_name',
                    'user.first_name',
                    'user.last_name',
                    'user.email',
                    'user.ssn',
                    'user.phone',
                    'company.name',
                    'company.npi',
                    'company.code',
                ],
                'sortableAttributes' => ['created_at'],
            ],
            Patient::class => [
                'filterableAttributes' => [
                    'code',
                    'driver_license',
                    'marital_status',
                    'user.code',
                    'user.mail',
                ],
                'sortableAttributes' => ['created_at'],
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
                'sortableAttributes' => ['created_at'],
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
            ],
            ClearingHouse::class => [
                'filterableAttributes' => [
                    'code',
                    'name',
                    'contacts',
                    'addresses',
                ],
                'sortableAttributes' => ['created_at'],
            ],
        ],
    ],
];

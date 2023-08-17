<?php

declare(strict_types=1);

// declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\HealthProfessional\HealthProfessionalType as HealthProfessionalTypeEnum;
use App\Models\Address;
use App\Models\AddressType;
use App\Models\BillingCompany;
use App\Models\BillingCompany\MembershipRole;
use App\Models\ClearingHouse;
use App\Models\Company;
use App\Models\CompanyHealthProfessionalType;
use App\Models\CompanyStatement;
use App\Models\Contact;
use App\Models\EmergencyContact;
use App\Models\Employment;
use App\Models\EntityAbbreviation;
use App\Models\EntityNickname;
use App\Models\ExceptionInsuranceCompany;
use App\Models\Facility;
use App\Models\Guarantor;
use App\Models\HealthProfessional;
use App\Models\HealthProfessionalType;
use App\Models\InsuranceCompany;
use App\Models\InsuranceCompanyTimeFailed;
use App\Models\InsurancePlan;
use App\Models\InsurancePlanPrivate;
use App\Models\InsurancePolicy;
use App\Models\Marital;
use App\Models\MaritalStatus;
use App\Models\Patient;
use App\Models\PrivateNote;
use App\Models\Profile;
use App\Models\PublicNote;
use App\Models\SocialMedia;
use App\Models\SocialNetwork;
use App\Models\Subscriber;
use App\Models\Taxonomy;
use App\Models\TypeCatalog;
use App\Models\User;
use App\Roles\Models\Role;
use Illuminate\Database\Seeder;

class DataTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*****SEEDER DE BILLING COMPANIES *****/

        /** Crear BillingCompany */
        $billingCompanies = [
            [
                'name' => 'Medical Claims Consultants',
                'logo' => 'http://31.220.55.211:81/img-billing-company/1675262605.png',
                'abbreviation' => 'MCC',
                'address' => [
                    'address' => '780 Northwest Le Jeune Road',
                    'city' => 'Miami',
                    'state' => 'FL - Florida',
                    'zip' => '331265540',
                ],
                'contact' => [
                    'mobile' => '7862089235',
                    'phone' => '7862089235',
                    'fax' => '8003341041',
                    'email' => 'sales@mccondemand.net',
                ],
            ],
            [
                'name' => 'Billing Paradise Revenue Cyde Master',
                'logo' => null,
                'abbreviation' => 'BillingP',
                'address' => [
                    'address' => '23441 Golden Springs Drive',
                    'city' => 'Diamond Bar',
                    'state' => 'CA - California',
                    'zip' => '917652030',
                ],
                'contact' => [
                    'mobile' => '4702858986',
                    'phone' => '4702858986',
                    'fax' => '8003341041',
                    'email' => 'info@billingparadise.com',
                ],
            ],
            [
                'name' => 'Advanced Pacific Medical, Llc',
                'logo' => null,
                'abbreviation' => 'AdvancedMD',
                'address' => [
                    'address' => 'San Diego Street',
                    'city' => 'Oceanside',
                    'state' => '920582744',
                    'zip' => '917652030',
                ],
                'contact' => [
                    'mobile' => '8452842771',
                    'phone' => '8542842771',
                    'fax' => '8123341041',
                    'email' => 'info@Advancedpacific.com',
                ],
            ],
        ];

        foreach ($billingCompanies as $bcompany) {
            $bc = BillingCompany::firstOrCreate([
                'name' => $bcompany['name'],
            ], [
                'code' => generateNewCode('BC', 5, date('Y'), BillingCompany::class, 'code'),
                'status' => true,
                'logo' => $bcompany['logo'],
                'abbreviation' => $bcompany['abbreviation'],
            ]);
            if ('' != $bcompany['address']['address']) {
                Address::firstOrCreate([
                    'billing_company_id' => $bc->id,
                    'addressable_type' => BillingCompany::class,
                    'addressable_id' => $bc->id,
                ], [
                    'address' => $bcompany['address']['address'],
                    'city' => $bcompany['address']['city'],
                    'state' => $bcompany['address']['state'],
                    'zip' => $bcompany['address']['zip'],
                    // 'address_type_id'    => '',
                    // 'country'            => '',
                    // 'country_subdivision_code' => '',
                ]);
            }
            if ('' != $bcompany['contact']['email']) {
                Contact::updateOrCreate([
                    'billing_company_id' => $bc->id,
                    'contactable_type' => BillingCompany::class,
                    'contactable_id' => $bc->id,
                ], [
                    // 'contact_name'       => '',
                    'mobile' => $bcompany['contact']['mobile'],
                    'phone' => $bcompany['contact']['phone'],
                    'fax' => $bcompany['contact']['fax'],
                    'email' => $bcompany['contact']['email'],
                    'billing_company_id' => $bc->id,
                ]);
            }

            collect(config('memberships.default_roles'))
                ->map(function (array $role) use ($bc) {
                    $role['billing_company_id'] = $bc->id;

                    return $role;
                })
                ->each(fn (array $role) => MembershipRole::query()->updateOrCreate($role));
        }

        /****** SEDEER DE COMPANIES - FACILITIES *****/

        /** Crear Company */
        $companies = [
            [
                'billing_company' => 'MCC',
                'name' => 'Nexus Medical Centers, Llc',
                'npi' => '1750811915',
                // 'ein'            => '',
                // 'upin'           => '',
                // 'clia'           => '',
                // 'nickname'       => '',
                'abbreviation' => 'NEXUS',
                'taxonomies' => [
                    [
                        'tax_id' => '207RC0000X',
                        'name' => 'Internal Medicine, Cardiovascular Disease',
                        'primary' => false,
                    ],
                    [
                        'tax_id' => '207Q00000X',
                        'name' => 'Family Medicine',
                        'primary' => true,
                    ],
                ],
                'address' => [
                    'address' => '1914 Northwest 84th Avenue',
                    'city' => 'Doral',
                    'state' => 'FL - Florida',
                    'zip' => '331261030',
                ],
                'contact' => [
                    'mobile' => '3052548900',
                    'phone' => '3052548900',
                    'fax' => '3052548902',
                    'email' => 'info@nexus.com',
                ],
                'facilities' => [
                    [
                        'name' => 'CARING FAMILY CORP',
                        'npi' => '1215297064',
                        'nppes_verified_at' => now(),
                        'taxonomies' => [
                            [
                                'tax_id' => '310400000X',
                                'name' => 'Assisted Living Facility',
                                'primary' => true,
                            ],
                        ],
                    ],
                ],
            ],
            [
                'billing_company' => 'MCC',
                'name' => 'Isle Of Palms Recovery Center, Llc',
                'npi' => '1538603873',
                // 'ein'            => '',
                // 'upin'           => '',
                // 'clia'           => '',
                // 'nickname'       => '',
                'abbreviation' => 'ISLECENTER',
                'taxonomies' => [
                    [
                        'tax_id' => '324500000X',
                        'name' => 'Substance Abuse Rehabilitation Facility',
                        'primary' => true,
                    ],
                ],
                'address' => [
                    'address' => '5027 Tamiami Trail East',
                    'city' => 'Naples',
                    'state' => 'FL - Florida',
                    'zip' => '341134126',
                ],
                'contact' => [
                    'mobile' => '8444223446',
                    'phone' => '8444223446',
                    'fax' => '8444223447',
                    'email' => 'info@islepalmscenter.com',
                ],
                'facilities' => [
                    [
                        'name' => 'ISA HOME CORP.',
                        'npi' => '1205277944',
                        'nppes_verified_at' => now(),
                        'taxonomies' => [
                            [
                                'tax_id' => '310400000X',
                                'name' => 'Assisted Living Facility',
                                'primary' => true,
                            ],
                        ],
                        'address' => [
                            'address' => '13316 Southwest 112th Court',
                            'city' => 'Miami',
                            'state' => 'FL - Florida',
                            'zip' => '331765345',
                        ],
                        'contact' => [
                            'mobile' => '7865921119',
                            'phone' => '7865921119',
                            'fax' => '7865921119',
                            'email' => 'info@isahome.com',
                        ],
                    ],
                    [
                        'name' => 'MACARENA ASSISTED LIVING FACILITY, INC.',
                        'npi' => '1851778658',
                        'nppes_verified_at' => now(),
                        'taxonomies' => [
                            [
                                'tax_id' => '310400000X',
                                'name' => 'Assisted Living Facility',
                                'primary' => true,
                            ],
                        ],
                        'address' => [
                            'address' => '8000 Southwest 88th Street',
                            'city' => 'Kendall',
                            'state' => 'FL - Florida',
                            'zip' => '331567458',
                        ],
                        'contact' => [
                            'mobile' => '3059720375',
                            'phone' => '3059720375',
                            'fax' => '3054686504',
                            'email' => 'info@macarenalivingfacility.com',
                        ],
                    ],
                    [
                        'name' => 'MY NEW HOME ALF I, INC.',
                        'npi' => '1699160762',
                        'nppes_verified_at' => now(),
                        'taxonomies' => [
                            [
                                'tax_id' => '310400000X',
                                'name' => 'Assisted Living Facility',
                                'primary' => true,
                            ],
                        ],
                        'address' => [
                            'address' => '7151 Southwest 42nd Street',
                            'city' => 'Miami',
                            'state' => 'FL - Florida',
                            'zip' => '331554603',
                        ],
                        'contact' => [
                            'mobile' => '7868371569',
                            'phone' => '7868371569',
                            'fax' => '7868371568',
                            'email' => 'info@newhome.com',
                        ],
                    ],
                ],
            ],
        ];

        foreach ($companies as $data) {
            $company = Company::firstOrcreate([
                'name' => $data['name'],
            ], [
                'code' => generateNewCode('CO', 5, date('Y'), Company::class, 'code'),
                'npi' => $data['npi'],
                'ein' => $data['ein'] ?? null,
                'clia' => $data['clia'] ?? null,
            ]);

            if (isset($data['taxonomies'])) {
                $tax_array = [];
                foreach ($data['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate(['tax_id' => $taxonomy['tax_id']], $taxonomy);
                    array_push($tax_array, $tax->id);
                }
                $company->taxonomies()->sync($tax_array);
            }

            $billingCompany = BillingCompany::whereAbbreviation($data['billing_company'])->first();

            /* Attach billing company */
            $company->billingCompanies()->attach($billingCompany->id ?? $billingCompany);

            if (isset($data['nickname'])) {
                EntityNickname::firstOrCreate([
                    'nicknamable_id' => $company->id,
                    'nicknamable_type' => Company::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'nickname' => $data['nickname'],
                ]);
            }

            if (isset($data['abbreviation'])) {
                EntityAbbreviation::firstOrCreate([
                    'abbreviable_id' => $company->id,
                    'abbreviable_type' => Company::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'abbreviation' => $data['abbreviation'],
                ]);
            }

            if (isset($data['address']['address'])) {
                Address::firstOrCreate([
                    'address_type_id' => '1',
                    'addressable_id' => $company->id,
                    'addressable_type' => Company::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], $data['address']);
            }

            if (isset($data['payment_address']['address'])) {
                Address::firstOrCreate([
                    'address_type_id' => '3',
                    'addressable_id' => $company->id,
                    'addressable_type' => Company::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], $data['payment_address']);
            }

            if (isset($data['contact']['email'])) {
                Contact::firstOrCreate([
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'contactable_id' => $company->id,
                    'contactable_type' => Company::class,
                ], $data['contact']);
            }

            if (isset($data['statements'])) {
                foreach ($data['statements'] as $statement) {
                    if (isset($statement['name'])) {
                        CompanyStatement::firstOrCreate([
                            'name' => $statement['name'],
                            'company_id' => $company->id,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ], [
                            'start_date' => $statement['start_date'] ?? null,
                            'end_date' => $statement['end_date'] ?? null,
                            'date' => $statement['date'] ?? null,
                            'rule_id' => $statement['rule_id'] ?? null,
                            'when_id' => $statement['when_id'] ?? null,
                            'apply_to_id' => $statement['apply_to_id'] ?? null,
                        ]);
                    }
                }
            }
            if (isset($data['exception_insurance_companies'])) {
                foreach ($data['exception_insurance_companies'] as $exceptionIC) {
                    ExceptionInsuranceCompany::firstOrCreate([
                        'company_id' => $company->id,
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        'insurance_company_id' => $exceptionIC,
                    ]);
                }
            }

            if (isset($data['private_note'])) {
                PrivateNote::firstOrCreate([
                    'publishable_type' => Company::class,
                    'publishable_id' => $company->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'note' => $data['private_note'],
                ]);
            }

            if (isset($data['public_note'])) {
                PublicNote::firstOrCreate([
                    'publishable_type' => Company::class,
                    'publishable_id' => $company->id,
                ], [
                    'note' => $data['public_note'],
                ]);
            }

            /*** FACILITIES **/

            foreach ($data['facilities'] as $dataF) {
                $facility = Facility::firstOrCreate([
                    'npi' => $dataF['npi'],
                ], [
                    'code' => generateNewCode('FA', 5, date('Y'), Facility::class, 'code'),
                    'name' => $dataF['name'],
                    'nppes_verified_at' => $dataF['nppes_verified_at'],
                ]);

                $facility->companies()->attach($company->id);

                if (isset($dataF['taxonomies'])) {
                    $tax_array = [];
                    foreach ($dataF['taxonomies'] as $taxonomy) {
                        $tax = Taxonomy::updateOrCreate(['tax_id' => $taxonomy['tax_id']], $taxonomy);
                        array_push($tax_array, $tax->id);
                    }
                    $facility->taxonomies()->sync($tax_array);
                }

                /* Attach billing company */
                $facility->billingCompanies()->attach($billingCompany->id ?? $billingCompany);

                if (isset($dataF['place_of_services'])) {
                    foreach ($dataF['place_of_services'] as $pos) {
                        if (is_null($facility->placeOfServices()
                                ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)->find($pos))) {
                            $facility->placeOfServices()->attach($pos, [
                                'billing_company_id' => $billingCompany->id ?? $billingCompany,
                            ]);
                        } else {
                            $facility->placeOfServices()
                                     ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)
                                     ->updateExistingPivot($pos, [
                                'billing_company_id' => $billingCompany->id ?? $billingCompany,
                            ]);
                        }
                    }
                }

                if (isset($dataF['nickname'])) {
                    EntityNickname::firstOrCreate([
                        'nicknamable_id' => $facility->id,
                        'nicknamable_type' => Facility::class,
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    ], [
                        'nickname' => $dataF['nickname'],
                    ]);
                }

                if (isset($dataF['abbreviation'])) {
                    EntityAbbreviation::firstOrCreate([
                        'abbreviable_id' => $facility->id,
                        'abbreviable_type' => Facility::class,
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    ], [
                        'abbreviation' => $dataF['abbreviation'],
                    ]);
                }

                if (isset($dataF['address']['address'])) {
                    Address::firstOrCreate([
                        'addressable_id' => $facility->id,
                        'addressable_type' => Facility::class,
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    ], $dataF['address']);
                }
                if (isset($dataF['contact']['email'])) {
                    Contact::firstOrCreate([
                        'contactable_id' => $facility->id,
                        'contactable_type' => Facility::class,
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    ], $dataF['contact']);
                }
            }
        }

        /****** SEDEER DE CLEARING HOUSE *****/

        $clearinghouses = [
            [
                'name' => 'Change Health Care',
                'org_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                'nickname' => null,
                'transmission_format_id' => TypeCatalog::whereDescription('JSON')->first()->id,
                'abbreviation' => 'CHANGE',

                'billing_company' => 'MCC',

                'address' => [
                    'address' => 'Change Street',
                    'city' => 'Walpole',
                    'state' => 'MA - Massachusetts',
                    'zip' => '020814267',
                ],
                'contact' => [
                    'contact_name' => 'Christophe Simmonet',
                    'mobile' => '330557896382',
                    'phone' => '330557896382',
                    'fax' => '330557896381',
                    'email' => 'Christophe.simmonet@maincare.fr',
                ],
            ],
            [
                'name' => 'Availity Healthcare Connects',
                'org_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                'nickname' => 'Availity',
                'transmission_format_id' => TypeCatalog::whereDescription('JSON')->first()->id,
                'abbreviation' => 'Availity',

                'billing_company' => 'MCC',

                'address' => [
                    'address' => 'Baldwin Avenue',
                    'city' => 'Jacksonville',
                    'state' => 'FL - Florida',
                    'zip' => '322081363',
                ],
                'contact' => [
                    'contact_name' => 'Rheana Cottrell',
                    'mobile' => '330557896382',
                    'phone' => '330557896382',
                    'fax' => '330557896381',
                    'email' => 'info@availity.com',
                ],
            ],
        ];
        foreach ($clearinghouses as $dataCH) {
            $clearing = ClearingHouse::firstOrCreate([
                'name' => $dataCH['name'],
            ], [
                'code' => generateNewCode('CH', 5, date('Y'), ClearingHouse::class, 'code'),
                'org_type_id' => $dataCH['org_type_id'],
                'transmission_format_id' => $dataCH['transmission_format_id'],
            ]);

            $billingCompany = BillingCompany::whereAbbreviation($dataCH['billing_company'])->first();

            /* Attach billing company */
            $clearing->billingCompanies()->attach($billingCompany->id ?? $billingCompany);

            if (isset($dataCH['nickname'])) {
                EntityNickname::firstOrCreate([
                    'nicknamable_id' => $clearing->id,
                    'nicknamable_type' => ClearingHouse::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'nickname' => $dataCH['nickname'],
                ]);
            }

            if (isset($dataCH['abbreviation'])) {
                EntityAbbreviation::firstOrCreate([
                    'abbreviable_id' => $clearing->id,
                    'abbreviable_type' => ClearingHouse::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'abbreviation' => $dataCH['abbreviation'],
                ]);
            }

            if (isset($dataCH['address']['address'])) {
                Address::firstOrCreate([
                    'addressable_id' => $clearing->id,
                    'addressable_type' => ClearingHouse::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], $dataCH['address']);
            }

            if (isset($dataCH['contact']['email'])) {
                Contact::firstOrCreate([
                    'contactable_id' => $clearing->id,
                    'contactable_type' => ClearingHouse::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], $dataCH['contact']);
            }
        }

        /*****  SEEDER DE INSURANCE COMPANY  ***/

        /** Create insurance company */
        $insuranceCompanies = [
            [
                'billing_company' => 'MCC',
                'insurance' => [
                    'payer_id' => 'PAS01',
                    'name' => 'Providence Administrative Services',
                    'abbreviation' => null,
                    'naic' => '1101',
                    'file_method_id' => 1,
                    'nickname' => null,
                ],

                'time_failed' => null,

                'address' => [
                    'address' => 'Box-T Drive',
                    'city' => 'San Antonio',
                    'state' => 'TX - Texas',
                    'zip' => '782535461',
                    'country' => null,
                    'country_subdivision_code' => null,
                ],

                'contact' => [
                    'phone' => '12106833891',
                    'mobile' => '12106833891',
                    'fax' => '12106833890',
                    'email' => 'info@providenceservice.com',
                    'contact_name' => null,
                ],

                'billing_incomplete_reasons' => null,
                'appeal_reasons' => null,
                'public_note' => null,
                'private_note' => null,

                'insurance_plans' => [
                    [
                        'name' => 'Connect 1500 Gold',
                        'nickname' => 'Gold',
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '11023',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'Box-T Drive',
                            'city' => 'San Antonio',
                            'state' => 'TX - Texas',
                            'zip' => '782535461',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '12106833891',
                            'mobile' => '12106833891',
                            'fax' => '12106833890',
                            'email' => 'info@providenceservice.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'Connect 5000 Silver',
                        'nickname' => 'Silver',
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '11023',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'Box-T Drive',
                            'city' => 'San Antonio',
                            'state' => 'TX - Texas',
                            'zip' => '782535461',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '12106833891',
                            'mobile' => '12106833891',
                            'fax' => '12106833890',
                            'email' => 'info@providenceservice.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'Connect Direct 5000 Silver',
                        'nickname' => 'Direct Silver',
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '11023',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'Box-T Drive',
                            'city' => 'San Antonio',
                            'state' => 'TX - Texas',
                            'zip' => '782535461',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '12106833891',
                            'mobile' => '12106833891',
                            'fax' => '12106833890',
                            'email' => 'info@providenceservice.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'Connect 9000 Bronze',
                        'nickname' => 'Bronze',
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '11023',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'Box-T Drive',
                            'city' => 'San Antonio',
                            'state' => 'TX - Texas',
                            'zip' => '782535461',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '12106833891',
                            'mobile' => '12106833891',
                            'fax' => '12106833890',
                            'email' => 'info@providenceservice.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'Qualified 7050 Bronze - Choice Network',
                        'nickname' => 'Choice Network',
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '11023',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'Box-T Drive',
                            'city' => 'San Antonio',
                            'state' => 'TX - Texas',
                            'zip' => '782535461',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '12106833891',
                            'mobile' => '12106833891',
                            'fax' => '12106833890',
                            'email' => 'info@providenceservice.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'Qualified 7050 Bronze - Signature Network',
                        'nickname' => 'Signature Network',
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '11023',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'Box-T Drive',
                            'city' => 'San Antonio',
                            'state' => 'TX - Texas',
                            'zip' => '782535461',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '12106833891',
                            'mobile' => '12106833891',
                            'fax' => '12106833890',
                            'email' => 'info@providenceservice.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ],
                ],
            ],
            [
                'billing_company' => 'MCC',
                'insurance' => [
                    'payer_id' => 'KGA15',
                    'name' => 'Kg Administrative Services',
                    'abbreviation' => null,
                    'naic' => '1102',
                    'file_method_id' => 2,
                    'nickname' => null,
                ],

                'time_failed' => null,

                'address' => [
                    'address' => '8181 East Kaiser Boulevard',
                    'city' => 'Anaheim',
                    'state' => 'CA - California',
                    'zip' => '928082225',
                    'country' => null,
                    'country_subdivision_code' => null,
                ],

                'contact' => [
                    'phone' => '18009917635',
                    'mobile' => '18009917635',
                    'fax' => '18009917634',
                    'email' => 'info@kgservice.com',
                    'contact_name' => null,
                ],

                'billing_incomplete_reasons' => null,
                'appeal_reasons' => null,
                'public_note' => null,
                'private_note' => null,

                'insurance_plans' => [
                    [
                        'name' => 'Oregon Standard Gold - Choice Network',
                        'nickname' => 'Gold Choice Network',
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '11023',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'Box-T Drive',
                            'city' => 'San Antonio',
                            'state' => 'TX - Texas',
                            'zip' => '782535461',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '12106833891',
                            'mobile' => '12106833891',
                            'fax' => '12106833890',
                            'email' => 'info@kgservice.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'Oregon Standard Silver - Choice Network',
                        'nickname' => 'Silver Choice Network',
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '11023',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'Box-T Drive',
                            'city' => 'San Antonio',
                            'state' => 'TX - Texas',
                            'zip' => '782535461',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '12106833891',
                            'mobile' => '12106833891',
                            'fax' => '12106833890',
                            'email' => 'info@kgservice.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'Oregon Direct Silver - Choice Network',
                        'nickname' => 'Direct Silver Choice Network',
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '11023',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'Box-T Drive',
                            'city' => 'San Antonio',
                            'state' => 'TX - Texas',
                            'zip' => '782535461',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '12106833891',
                            'mobile' => '12106833891',
                            'fax' => '12106833890',
                            'email' => 'info@kgservice.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'Oregon Standard Bronze - Choice Network',
                        'nickname' => 'Bronze Choice Network',
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '11023',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'Box-T Drive',
                            'city' => 'San Antonio',
                            'state' => 'TX - Texas',
                            'zip' => '782535461',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '12106833891',
                            'mobile' => '12106833891',
                            'fax' => '12106833890',
                            'email' => 'info@kgservice.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'Columbia 1500 Gold',
                        'nickname' => 'Columbia Gold',
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '11023',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'Box-T Drive',
                            'city' => 'San Antonio',
                            'state' => 'TX - Texas',
                            'zip' => '782535461',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '12106833891',
                            'mobile' => '12106833891',
                            'fax' => '12106833890',
                            'email' => 'info@kgservice.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'Columbia 8700 Bronze',
                        'nickname' => 'Columbia Bronze',
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '11023',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'Box-T Drive',
                            'city' => 'San Antonio',
                            'state' => 'TX - Texas',
                            'zip' => '782535461',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '12106833891',
                            'mobile' => '12106833891',
                            'fax' => '12106833890',
                            'email' => 'info@kgservice.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ],
                ],
            ],
            [
                'billing_company' => 'MCC',
                'insurance' => [
                    'payer_id' => '61115',
                    'name' => 'Humana Long Term Care',
                    'abbreviation' => null,
                    'naic' => '1104',
                    'file_method_id' => 2,
                    'nickname' => null,
                ],

                'time_failed' => null,

                'address' => [
                    'address' => 'North Flag City Boulevard',
                    'city' => 'Lodi',
                    'state' => 'CA - California',
                    'zip' => '952429313',
                    'country' => null,
                    'country_subdivision_code' => null,
                ],

                'contact' => [
                    'phone' => '14076030522',
                    'mobile' => '14076030522',
                    'fax' => '14076030521',
                    'email' => 'info@humanatermcare.com',
                    'contact_name' => null,
                ],

                'billing_incomplete_reasons' => null,
                'appeal_reasons' => null,
                'public_note' => null,
                'private_note' => null,

                'insurance_plans' => [
                    [
                        'name' => 'High Option - Self Only',
                        'nickname' => null,
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '751',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'North Flag City Boulevard',
                            'city' => 'Lodi',
                            'state' => 'CA - California',
                            'zip' => '952429313',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '14076030522',
                            'mobile' => '14076030522',
                            'fax' => '14076030521',
                            'email' => 'info@humanatermcare.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'High Option - Self And Family',
                        'nickname' => null,
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '752',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'North Flag City Boulevard',
                            'city' => 'Lodi',
                            'state' => 'CA - California',
                            'zip' => '952429313',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '14076030522',
                            'mobile' => '14076030522',
                            'fax' => '14076030521',
                            'email' => 'info@humanatermcare.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'Standard Option - Self Plus One',
                        'nickname' => null,
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '756',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'North Flag City Boulevard',
                            'city' => 'Lodi',
                            'state' => 'CA - California',
                            'zip' => '952429313',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '14076030522',
                            'mobile' => '14076030522',
                            'fax' => '14076030521',
                            'email' => 'info@humanatermcare.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'Standard Option - Self And Family',
                        'nickname' => null,
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => '755',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'North Flag City Boulevard',
                            'city' => 'Lodi',
                            'state' => 'CA - California',
                            'zip' => '952429313',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '14076030522',
                            'mobile' => '14076030522',
                            'fax' => '14076030521',
                            'email' => 'info@humanatermcare.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'Basic Option - Self Only',
                        'nickname' => null,
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => 'RW1',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'North Flag City Boulevard',
                            'city' => 'Lodi',
                            'state' => 'CA - California',
                            'zip' => '952429313',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '14076030522',
                            'mobile' => '14076030522',
                            'fax' => '14076030521',
                            'email' => 'info@humanatermcare.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ], [
                        'name' => 'Basic Option - Self Plus One',
                        'nickname' => null,
                        'ins_type_id' => TypeCatalog::whereDescription('Medicare')->first()->id,
                        'plan_type_id' => TypeCatalog::whereDescription('Health Maintenance Organization')->first()->id,
                        'abbreviation' => null,
                        'eff_date' => '2020-10-09',

                        'accept_assign' => true,
                        'pre_authorization' => true,
                        'file_zero_changes' => true,
                        'referral_required' => false,
                        'accrue_patient_resp' => false,
                        'require_abn' => true,
                        'pqrs_eligible' => true,
                        'allow_attached_files' => false,

                        'format_professional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_institutional_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_cms_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'format_ub_id' => TypeCatalog::whereCode('Standard')->first()->id,
                        'method' => 'Deducible Max',
                        'naic' => 'RW3',

                        'time_failed' => null,

                        'address' => [
                            'address' => 'North Flag City Boulevard',
                            'city' => 'Lodi',
                            'state' => 'CA - California',
                            'zip' => '952429313',
                            'country' => null,
                            'country_subdivision_code' => null,
                        ],

                        'contact' => [
                            'phone' => '14076030522',
                            'mobile' => '14076030522',
                            'fax' => '14076030521',
                            'email' => 'info@humanatermcare.com',
                            'contact_name' => null,
                        ],

                        'private_note' => null,
                        'public_note' => null,
                    ],
                ],
            ],
        ];

        foreach ($insuranceCompanies as $dataIC) {
            $insurance = InsuranceCompany::where('payer_id', $dataIC['insurance']['payer_id'])->first();
            if (isset($insurance)) {
                $insurance->update([
                    'naic' => $dataIC['insurance']['naic'] ?? '',
                    'file_method_id' => $dataIC['insurance']['file_method_id'],
                ]);
            } else {
                $insurance = InsuranceCompany::create([
                    'code' => generateNewCode('IC', 5, date('Y'), InsuranceCompany::class, 'code'),
                    'name' => $dataIC['insurance']['name'],
                    'naic' => $dataIC['insurance']['naic'] ?? '',
                    'payer_id' => $dataIC['insurance']['payer_id'],
                    'file_method_id' => $dataIC['insurance']['file_method_id'],
                ]);
            }

            $billingCompany = BillingCompany::whereAbbreviation($dataIC['billing_company'])->first();

            /* Attach billing company */
            $insurance->billingCompanies()->attach($billingCompany->id ?? $billingCompany);

            if (isset($dataIC['billing_incomplete_reasons'])) {
                foreach ($dataIC['billing_incomplete_reasons'] as $bir) {
                    if (is_null($insurance->billingIncompleteReasons()
                            ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)->find($bir))) {
                        $insurance->billingIncompleteReasons()->attach($bir, [
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ]);
                    } else {
                        $insurance->billingIncompleteReasons()
                                 ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)
                                 ->updateExistingPivot($bir, [
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ]);
                    }
                }
            }

            if (isset($dataIC['appeal_reasons'])) {
                foreach ($dataIC['appeal_reasons'] as $ar) {
                    if (is_null($insurance->appealReasons()
                            ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)->find($ar))) {
                        $insurance->appealReasons()->attach($ar, [
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ]);
                    } else {
                        $insurance->appealReasons()
                                 ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)
                                 ->updateExistingPivot($ar, [
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ]);
                    }
                }
            }

            if (isset($dataIC['time_failed']['days']) || isset($dataIC['time_failed']['from_id'])) {
                InsuranceCompanyTimeFailed::create([
                    'days' => $dataIC['time_failed']['days'],
                    'from_id' => $dataIC['time_failed']['from_id'],
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    'insurance_company_id' => $insurance->id,
                ]);
            }

            if (isset($dataIC['insurance']['nickname'])) {
                EntityNickname::firstOrCreate([
                    'nicknamable_id' => $insurance->id,
                    'nicknamable_type' => InsuranceCompany::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'nickname' => $dataIC['insurance']['nickname'],
                ]);
            }

            if (isset($dataIC['insurance']['abbreviation'])) {
                EntityAbbreviation::firstOrCreate([
                    'abbreviable_id' => $insurance->id,
                    'abbreviable_type' => InsuranceCompany::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'abbreviation' => $dataIC['insurance']['abbreviation'],
                ]);
            }

            if (isset($dataIC['address']['address'])) {
                Address::firstOrCreate([
                    'addressable_id' => $insurance->id,
                    'addressable_type' => InsuranceCompany::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], $dataIC['address']);
            }
            if (isset($dataIC['contact']['email'])) {
                Contact::firstOrCreate([
                    'contactable_id' => $insurance->id,
                    'contactable_type' => InsuranceCompany::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], $dataIC['contact']);
            }

            if (isset($dataIC['private_note'])) {
                PrivateNote::firstOrCreate([
                    'publishable_id' => $insurance->id,
                    'publishable_type' => InsuranceCompany::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'note' => $dataIC['private_note'],
                ]);
            }

            if (isset($dataIC['public_note'])) {
                PublicNote::firstOrCreate([
                    'publishable_id' => $insurance->id,
                    'publishable_type' => InsuranceCompany::class,
                ], [
                    'note' => $dataIC['public_note'],
                ]);
            }

            if (isset($dataIC['insurance_plans'])) {
                foreach ($dataIC['insurance_plans'] as $dataIP) {
                    $insurancePlan = InsurancePlan::firstOrCreate([
                        'name' => $dataIP['name'],
                    ], [
                        'code' => generateNewCode('IP', 5, date('Y'), InsurancePlan::class, 'code'),
                        'ins_type_id' => $dataIP['ins_type_id'],
                        'accept_assign' => $dataIP['accept_assign'],
                        'pre_authorization' => $dataIP['pre_authorization'],
                        'file_zero_changes' => $dataIP['file_zero_changes'],
                        'referral_required' => $dataIP['referral_required'],
                        'accrue_patient_resp' => $dataIP['accrue_patient_resp'],
                        'require_abn' => $dataIP['require_abn'],
                        'pqrs_eligible' => $dataIP['pqrs_eligible'],
                        'allow_attached_files' => $dataIP['allow_attached_files'],
                        'eff_date' => $dataIP['eff_date'],

                        'insurance_company_id' => $insurance->id,
                    ]);

                    InsurancePlanPrivate::updateOrCreate([
                        'insurance_plan_id' => $insurancePlan->id,
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    ], [
                        'naic' => $dataIP['naic'] ?? null,
                        'format_professional_id' => $dataIP['format_professional_id'] ?? null,
                        'format_institutional_id' => $dataIP['format_institutional_id'] ?? null,
                        'format_cms_id' => $dataIP['format_cms_id'] ?? null,
                        'format_ub_id' => $dataIP['format_ub_id'] ?? null,
                        'file_method_id' => $dataIP['file_method_id'] ?? null,
                    ]);

                    /* Attach billing company */
                    $insurancePlan->billingCompanies()->attach($billingCompany->id ?? $billingCompany);

                    if (isset($dataIP['nickname'])) {
                        EntityNickname::firstOrCreate([
                            'nicknamable_id' => $insurancePlan->id,
                            'nicknamable_type' => InsurancePlan::class,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ], [
                            'nickname' => $dataIP['nickname'],
                        ]);
                    }

                    if (isset($dataIP['note'])) {
                        $note = PublicNote::firstOrCreate([
                            'publishable_id' => $insurancePlan->id,
                            'publishable_type' => InsurancePlan::class,
                        ], [
                            'note' => $dataIP['note'],
                        ]);
                    }
                }
            }
        }

        /******  SEEDER DE HEALTH PROFESIONAL  *********/

        $healthProfessionals = [
            [
                'npi' => '1588659353',
                'email' => 'leonardo@mail.net',
                'is_provider' => false,

                'billing_company' => 'MCC',
                'health_professional_type_id' => HealthProfessionalTypeEnum::MEDICAL_DOCTOR->value,
                'company_id' => Company::whereName('Isle Of Palms Recovery Center, Llc')->first()->id,
                'authorization' => [
                    CompanyHealthProfessionalType::whereType('Service provider')->first()->id,
                    CompanyHealthProfessionalType::whereType('Billing provider')->first()->id,
                ],

                'taxonomies_company' => null,
                'npi_company' => null,
                'name_company' => null,
                'nickname' => null,

                'private_note' => null,
                'public_note' => null,

                'taxonomies' => [
                    [
                        'tax_id' => '207Q00000X',
                        'name' => 'Family Medicine',
                        'primary' => true,
                    ],
                ],

                'profile' => [
                    'sex' => 'M',
                    'first_name' => 'Leonard',
                    'avatar' => 'http://31.220.55.211:81/img-profile/1675264136png',
                    'last_name' => 'Berkowitz',
                    'middle_name' => 'Kyle',
                    'ssn' => '158865935',
                    'date_of_birth' => '2005-09-16',

                    'social_medias' => null,
                ],

                'address' => [
                    'address' => '880 Northwest 13th Street',
                    'city' => 'Boca Raton',
                    'state' => 'FL - Florida',
                    'zip' => '334862342',
                ],
                'contact' => [
                    'mobile' => '5615665328',
                    'phone' => '5615665328',
                    'fax' => '5612994220',
                    'email' => 'leonardo@mail.net',
                ],
            ], [
                'npi' => '1235387440',
                'email' => 'rafael@mail.net',
                'is_provider' => false,

                'billing_company' => 'MCC',
                'health_professional_type_id' => HealthProfessionalTypeEnum::MEDICAL_DOCTOR->value,
                'company_id' => Company::whereName('Nexus Medical Centers, Llc')->first()->id,
                'authorization' => [
                    CompanyHealthProfessionalType::whereType('Service provider')->first()->id,
                    CompanyHealthProfessionalType::whereType('Billing provider')->first()->id,
                    CompanyHealthProfessionalType::whereType('Referred')->first()->id,
                ],

                'taxonomies_company' => null,
                'npi_company' => null,
                'name_company' => null,
                'nickname' => null,

                'private_note' => null,
                'public_note' => null,

                'taxonomies' => [
                    [
                        'tax_id' => '103TC0700X',
                        'name' => 'Psychologist, Clinical',
                        'primary' => true,
                    ],
                ],

                'profile' => [
                    'sex' => 'M',
                    'avatar' => 'http://31.220.55.211:81/img-profile/1675264136png',
                    'first_name' => 'Rafael',
                    'last_name' => 'Botta',
                    'middle_name' => 'Jesse',
                    'ssn' => '123538744',
                    'date_of_birth' => '1990-09-16',

                    'social_medias' => null,
                ],

                'address' => [
                    'address' => '17900 Northwest 5th Street',
                    'city' => 'Pembroke Pines',
                    'state' => 'FL - Florida',
                    'zip' => '330292808',
                ],
                'contact' => [
                    'mobile' => '9544946813',
                    'phone' => '9544946813',
                    'fax' => '9544946811',
                    'email' => 'rafael@mail.net',
                ],
            ], [
                'npi' => '1770883027',
                'email' => 'aliuska@mail.net',
                'is_provider' => false,

                'billing_company' => 'MCC',
                'health_professional_type_id' => HealthProfessionalTypeEnum::MEDICAL_DOCTOR->value,
                'company_id' => Company::whereName('Nexus Medical Centers, Llc')->first()->id,
                'authorization' => [
                    CompanyHealthProfessionalType::whereType('Service provider')->first()->id,
                    CompanyHealthProfessionalType::whereType('Billing provider')->first()->id,
                    CompanyHealthProfessionalType::whereType('Referred')->first()->id,
                ],

                'taxonomies_company' => null,
                'npi_company' => null,
                'name_company' => null,
                'nickname' => null,

                'private_note' => null,
                'public_note' => null,

                'taxonomies' => [
                    [
                        'tax_id' => '207RG0300X',
                        'name' => 'Internal Medicine, Geriatric Medicine',
                        'primary' => false,
                    ], [
                        'tax_id' => '207R00000X',
                        'name' => 'Internal Medicine',
                        'primary' => true,
                    ],
                ],

                'profile' => [
                    'sex' => 'F',
                    'avatar' => 'http://31.220.55.211:81/img-profile/1675263673png',
                    'first_name' => 'Aliuska',
                    'last_name' => 'Carmenate',
                    'middle_name' => null,
                    'ssn' => '177088302',
                    'date_of_birth' => '1990-09-16',

                    'social_medias' => null,
                ],

                'address' => [
                    'address' => '4770 Biscayne Boulevard',
                    'city' => 'Miami',
                    'state' => 'FL - Florida',
                    'zip' => '331373202',
                ],
                'contact' => [
                    'mobile' => '7865362003',
                    'phone' => '7865362003',
                    'fax' => '7865362003',
                    'email' => 'aliuska@mail.net',
                ],
            ],
        ];

        foreach ($healthProfessionals as $dataHP) {
            if (isset($dataHP['profile']['ssn'])) {
                $profile = Profile::updateOrCreate([
                    'first_name' => $dataHP['profile']['first_name'],
                    'last_name' => $dataHP['profile']['last_name'],
                    'date_of_birth' => $dataHP['profile']['date_of_birth'],
                    'ssn' => $dataHP['profile']['ssn'],
                ], [
                    'ssn' => $dataHP['profile']['ssn'],
                    'avatar' => $dataHP['profile']['avatar'] ?? null,
                    'first_name' => $dataHP['profile']['first_name'],
                    'middle_name' => $dataHP['profile']['middle_name'] ?? '',
                    'last_name' => $dataHP['profile']['last_name'],
                    'sex' => $dataHP['profile']['sex'],
                    'date_of_birth' => $dataHP['profile']['date_of_birth'],
                ]);
            } else {
                $profile = Profile::updateOrCreate([
                    'first_name' => $dataHP['profile']['first_name'],
                    'last_name' => $dataHP['profile']['last_name'],
                    'date_of_birth' => $dataHP['profile']['date_of_birth'],
                ], [
                    'ssn' => $dataHP['profile']['ssn'],
                    'avatar' => $dataHP['profile']['avatar'] ?? null,
                    'first_name' => $dataHP['profile']['first_name'],
                    'middle_name' => $dataHP['profile']['middle_name'] ?? '',
                    'last_name' => $dataHP['profile']['last_name'],
                    'sex' => $dataHP['profile']['sex'],
                    'date_of_birth' => $dataHP['profile']['date_of_birth'],
                ]);
            }

            if (isset($dataHP['profile']['social_medias'])) {
                $socialMedias = $profile->socialMedias;
                /* Delete socialMedia */
                foreach ($socialMedias as $socialMedia) {
                    $validated = false;
                    $socialNetwork = $socialMedia->SocialNetwork;
                    if (isset($socialNetwork)) {
                        foreach ($dataHP['profile']['social_medias'] ?? [] as $socialM) {
                            if ($socialM['name'] == $socialNetwork->name) {
                                $validated = true;
                                break;
                            }
                        }
                    }
                    if (!$validated) {
                        $socialMedia->delete();
                    }
                }

                /* update or create new social medias */
                foreach ($dataHP['profile']['social_medias'] ?? [] as $socialMedia) {
                    $socialNetwork = SocialNetwork::whereName($socialMedia['name'])->first();
                    if (isset($socialNetwork)) {
                        SocialMedia::updateOrCreate([
                            'profile_id' => $profile->id,
                            'social_network_id' => $socialNetwork->id,
                        ], [
                            'link' => $socialMedia['link'],
                        ]);
                    }
                }
            }

            /** Create User */
            $user = User::query()->firstOrCreate([
                'email' => $dataHP['email'],
            ], [
                'usercode' => generateNewCode('US', 5, date('Y'), User::class, 'usercode'),
                'userkey' => encrypt(uniqid('', true)),
                'profile_id' => $profile->id,
                'billing_company_id' => null,
            ]);

            $billingCompany = BillingCompany::whereAbbreviation($dataHP['billing_company'])->first();

            /* Attach billing company */
            $user->billingCompanies()->syncWithoutDetaching($billingCompany->id ?? $billingCompany);
            $user->billingCompanies()
                ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)
                ->first()
                ->membership
                ->roles()
                ->syncWithoutDetaching(MembershipRole::whereSlug('healthprofessional')->first()->id);

            if (isset($dataHP['contact'])) {
                Contact::firstOrCreate([
                    'contactable_id' => $user->profile_id,
                    'contactable_type' => Profile::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], $dataHP['contact']);
            }

            if (isset($dataHP['address'])) {
                Address::firstOrCreate([
                    'addressable_id' => $user->profile_id,
                    'addressable_type' => Profile::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], $dataHP['address']);
            }
            if ($dataHP['is_provider'] ?? false) {
                if (isset($dataHP['npi_company'])) {
                    $company = Company::where('npi', $dataHP['npi_company'])->first();
                    if (!isset($company)) {
                        $company = Company::firstOrCreate([
                            'name' => $dataHP['name_company'],
                        ], [
                            'code' => generateNewCode('CO', 5, date('Y'), Company::class, 'code'),
                            'npi' => $dataHP['npi_company'],
                        ]);
                    }
                    if (isset($dataHP['taxonomies_company'])) {
                        $tax_array = [];
                        foreach ($dataHP['taxonomies_company'] as $taxonomy) {
                            $tax = Taxonomy::updateOrCreate(['tax_id' => $taxonomy['tax_id']], $taxonomy);
                            array_push($tax_array, $tax->id);
                        }
                        $company->taxonomies()->sync($tax_array);
                    }
                    if (is_null($company->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                        $company->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
                    } else {
                        $company->billingCompanies()->updateExistingPivot($billingCompany->id ?? $billingCompany, [
                            'status' => true,
                        ]);
                    }

                    if (isset($dataHP['nickname'])) {
                        EntityNickname::firstOrCreate([
                            'nicknamable_id' => $company->id,
                            'nicknamable_type' => Company::class,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ], [
                            'nickname' => $dataHP['nickname'],
                        ]);
                    }
                } else {
                    $company = Company::where('npi', $dataHP['npi'])->first();
                    if (!isset($company)) {
                        $company = Company::create([
                            'code' => generateNewCode('CO', 5, date('Y'), Company::class, 'code'),
                            'name' => $dataHP['profile']['first_name'].' '.$dataHP['profile']['last_name'],
                            'npi' => $dataHP['npi'],
                        ]);
                    }
                    if (isset($dataHP['taxonomies'])) {
                        $tax_array = [];
                        foreach ($dataHP['taxonomies'] as $taxonomy) {
                            $tax = Taxonomy::updateOrCreate(['tax_id' => $taxonomy['tax_id']], $taxonomy);
                            array_push($tax_array, $tax->id);
                        }
                        $company->taxonomies()->sync($tax_array);
                    }
                    if (is_null($company->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                        $company->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
                    } else {
                        $company->billingCompanies()->updateExistingPivot($billingCompany->id ?? $billingCompany, [
                            'status' => true,
                        ]);
                    }
                    if (isset($dataHP['nickname'])) {
                        EntityNickname::firstOrCreate([
                            'nicknamable_id' => $company->id,
                            'nicknamable_type' => Company::class,
                            'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        ], [
                            'nickname' => $dataHP['nickname'],
                        ]);
                    }
                }
            }
            $healthP = HealthProfessional::firstOrCreate([
                'npi' => $dataHP['npi'],
            ], [
                'code' => generateNewCode('HP', 5, date('Y'), HealthProfessional::class, 'code'),
                'is_provider' => $dataHP['is_provider'] ?? false,
                'npi_company' => $dataHP['npi_company'] ?? '',
                'company_id' => $company->id ?? $dataHP['company_id'],
                'profile_id' => $profile->id,
            ]);

            HealthProfessionalType::query()->create([
                'type' => (string) $dataHP['health_professional_type_id'],
                'billing_company_id' => $billingCompany->id ?? $billingCompany,
                'health_professional_id' => $healthP->id,
            ]);

            $auth = [];
            foreach ($dataHP['authorization'] as $authorization) {
                if (is_numeric($authorization)) {
                    array_push($auth, $authorization);
                }
            }
            if (is_null($healthP->companies()->find($company->id ?? $dataHP['company_id']))) {
                $healthP->companies()->attach($company->id ?? $dataHP['company_id'], [
                    'authorization' => $auth,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ]);
            } else {
                $healthP->companies()->updateExistingPivot($company->id ?? $dataHP['company_id'], [
                    'authorization' => $auth,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ]);
            }

            if (isset($dataHP['private_note'])) {
                PrivateNote::firstOrCreate([
                    'publishable_id' => $healthP->id,
                    'publishable_type' => HealthProfessional::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'note' => $dataHP['private_note'],
                ]);
            }

            if (isset($dataHP['public_note'])) {
                PublicNote::updateOrCreate([
                    'publishable_id' => $healthP->id,
                    'publishable_type' => HealthProfessional::class,
                ], [
                    'note' => $dataHP['public_note'],
                ]);
            }

            if (is_null($healthP->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $healthP->billingCompanies()->attach($billingCompany->id ?? $billingCompany);
            } else {
                $healthP->billingCompanies()->updateExistingPivot(
                    $billingCompany->id ?? $billingCompany,
                    [
                        'status' => true,
                    ]
                );
            }

            if (isset($dataHP['taxonomies'])) {
                $tax_array = [];
                foreach ($dataHP['taxonomies'] as $taxonomy) {
                    $tax = Taxonomy::updateOrCreate(['tax_id' => $taxonomy['tax_id']], $taxonomy);
                    array_push($tax_array, $tax->id);
                }
                $healthP->taxonomies()->sync($tax_array);
            }

            if (!is_null($healthP) && !is_null($user)) {
                $role = Role::whereSlug('healthprofessional')->first();
                if (isset($role)) {
                    $user->attachRole($role);
                    $permissions = $role->permissions;
                    foreach ($permissions as $perm) {
                        $user->attachPermission($perm);
                    }
                }
                $user->password = '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q';
                $token = encrypt($user->id.'@#@#$'.$user->email);
                $user->token = $token;
                $user->save();
            }
        }

        /***********   SEEDER DE PATIENT **********/

        $patients = [
            [
                'billing_company' => 'MCC',
                'driver_license' => '152435',

                'profile' => [
                    'ssn' => '100322476',
                    'avatar' => 'http://31.220.55.211:81/img-profile/1675263673png',
                    'first_name' => 'Leonela',
                    'last_name' => 'Fonseca',
                    'middle_name' => null,
                    'date_of_birth' => '2014-07-25',
                    'sex' => 'F',
                    'social_medias' => null,
                ],

                'marital_status_id' => MaritalStatus::whereName('Married')->first()->id,
                'marital' => [
                    'spuse_name' => 'Rafael Monser',
                    'spuse_work' => 'Development',
                    'spuse_work_phone' => '04241233243',
                ],

                'company_id' => Company::whereName('Isle Of Palms Recovery Center, Llc')->first()->id,
                'company_med_num' => '0000101',

                'language' => 'en',

                'addresses' => [
                    [
                        'address_type_id' => AddressType::whereName('House / Residence')->first()->id,
                        'address' => '13004 Southwest 88th Terrace North',
                        'city' => 'Miami',
                        'state' => 'FL - Florida',
                        'zip' => '331861768',
                    ],
                ],
                'contact' => [
                    'mobile' => '3059652601',
                    'phone' => '3059652601',
                    'fax' => '3059652600',
                    'email' => 'leonela@mail.net',
                ],
                'insurance_policies' => [
                    [
                        'policy_number' => '122587',
                        'group_number' => 'A1234',
                        'insurance_company' => InsuranceCompany::wherePayerId('PAS01')->first()->id,
                        'insurance_plan' => InsurancePlan::where([
                            'name' => 'Connect 1500 Gold',
                            'insurance_company_id' => InsuranceCompany::wherePayerId('PAS01')->first()->id])->first()->id,
                        'type_responsibility_id' => TypeCatalog::where(['code' => 'P', 'description' => 'Primary'])->first()->id,
                        'insurance_policy_type_id' => TypeCatalog::where(['code' => '1', 'description' => 'Health'])->first()->id,
                        'eff_date' => '2014-07-25',
                        'end_date' => '2023-07-25',
                        'assign_benefits' => true,
                        'release_info' => true,
                        'own_insurance' => false,

                        'subscriber' => [
                            'relationship_id' => TypeCatalog::whereDescription('Step Child')->first()->id,
                            'ssn' => null,
                            'date_of_birth' => '2020-04-11',
                            'first_name' => 'David',
                            'last_name' => 'Ochoa',
                            'address' => [
                                'address' => '13004 Southwest 88th Terrace North',
                                'city' => 'Miami',
                                'state' => 'FL - Florida',
                                'zip' => '331861768',
                            ],
                            'contact' => [
                                'mobile' => '7862089235',
                                'phone' => '7862089235',
                                'fax' => '8003341041',
                                'email' => 'memo@davidochoa.net',
                            ],
                        ],
                    ],
                    [
                        'policy_number' => '142536',
                        'group_number' => 'B1436',
                        'insurance_company' => InsuranceCompany::wherePayerId('PAS01')->first()->id,
                        'insurance_plan' => 6,
                        'type_responsibility_id' => TypeCatalog::where(['code' => 'S', 'description' => 'Secundary'])->first()->id,
                        'insurance_policy_type_id' => TypeCatalog::where(['code' => '1', 'description' => 'Health'])->first()->id,
                        'eff_date' => '2014-07-25',
                        'end_date' => '2023-07-25',
                        'assign_benefits' => true,
                        'release_info' => true,
                        'own_insurance' => false,

                        'subscriber' => [
                            'relationship_id' => TypeCatalog::whereDescription('Other')->first()->id,
                            'ssn' => null,
                            'date_of_birth' => '2020-04-11',
                            'first_name' => 'Josefina',
                            'last_name' => 'Gonzales',
                            'address' => [
                                'address' => '13004 Southwest 88th Terrace North',
                                'city' => 'Miami',
                                'state' => 'FL - Florida',
                                'zip' => '331861768',
                            ],
                            'contact' => [
                                'mobile' => '7862089235',
                                'phone' => '7862089235',
                                'fax' => '8003341041',
                                'email' => 'josefina@gonzales.net',
                            ],
                        ],
                    ],
                ],
                'guarantor' => [
                    'name' => 'Estela Cardenas',
                    'phone' => '7862089235',
                ],

                'emergency_contacts' => [
                    [
                        'name' => 'Estela Cardenas',
                        'cellphone' => '7862089235',
                        'relationship_id' => TypeCatalog::whereDescription('Parent')->first()->id,
                    ],
                ],

                'employments' => [
                    [
                        'employer_name' => 'Kevin Peres',
                        'position' => 'Development',
                        'employer_address' => '13004 Southwest 88th Terrace North',
                        'employer_phone' => '7862089235',
                    ],
                ],
                'public_note' => 'Generate seeder patient',
                'private_note' => 'Generate seeder patient',
            ], [
                'billing_company' => 'MCC',
                'driver_license' => '155555',

                'profile' => [
                    'ssn' => '767121246',
                    'avatar' => 'http://31.220.55.211:81/img-profile/1675263673png',
                    'first_name' => 'Maria',
                    'last_name' => 'Alfonso',
                    'middle_name' => null,
                    'date_of_birth' => '1934-09-02',
                    'sex' => 'F',
                    'social_medias' => null,
                ],

                'marital_status_id' => MaritalStatus::whereName('Married')->first()->id,
                'marital' => [
                    'spuse_name' => 'Andres Rosales',
                    'spuse_work' => 'Doctor',
                    'spuse_work_phone' => '04241233245',
                ],

                'company_id' => Company::whereName('Isle Of Palms Recovery Center, Llc')->first()->id,
                'company_med_num' => 'MDALFMA',

                'language' => 'en',

                'addresses' => [
                    [
                        'address_type_id' => AddressType::whereName('House / Residence')->first()->id,
                        'address' => '16000 SW 103 PL',
                        'city' => 'Miami',
                        'state' => 'FL - Florida',
                        'zip' => '331571768',
                    ],
                ],
                'contact' => [
                    'mobile' => '7863188984',
                    'phone' => '7863188984',
                    'fax' => '7863188984',
                    'email' => 'mariac@mail.net',
                ],
                'insurance_policies' => [
                    [
                        'policy_number' => '767121246M',
                        'group_number' => 'B1436',
                        'insurance_company' => InsuranceCompany::wherePayerId('PAS01')->first()->id,
                        'insurance_plan' => InsurancePlan::where([
                            'name' => 'Connect 1500 Gold',
                            'insurance_company_id' => InsuranceCompany::wherePayerId('PAS01')->first()->id])->first()->id,
                        'type_responsibility_id' => TypeCatalog::where(['code' => 'P', 'description' => 'Primary'])->first()->id,
                        'insurance_policy_type_id' => TypeCatalog::where(['code' => '1', 'description' => 'Health'])->first()->id,
                        'eff_date' => '2012-07-25',
                        'end_date' => '2025-07-25',
                        'assign_benefits' => true,
                        'release_info' => true,
                        'own_insurance' => false,

                        'subscriber' => [
                            'relationship_id' => TypeCatalog::whereDescription('Step Child')->first()->id,
                            'ssn' => null,
                            'date_of_birth' => '1999-04-11',
                            'first_name' => 'Davidd',
                            'last_name' => 'Ochoaa',
                            'address' => [
                                'address' => '13004 Southwest 88th Terrace North',
                                'city' => 'Miami',
                                'state' => 'FL - Florida',
                                'zip' => '331861768',
                            ],
                            'contact' => [
                                'mobile' => '7862089222',
                                'phone' => '7862089222',
                                'fax' => '8003341000',
                                'email' => 'memows@davidochoa.net',
                            ],
                        ],
                    ],
                    [
                        'policy_number' => '8183745890',
                        'group_number' => '818374',
                        'insurance_company' => InsuranceCompany::wherePayerId('PAS01')->first()->id,
                        'insurance_plan' => 6,
                        'type_responsibility_id' => TypeCatalog::where(['code' => 'S', 'description' => 'Secundary'])->first()->id,
                        'insurance_policy_type_id' => TypeCatalog::where(['code' => '1', 'description' => 'Health'])->first()->id,
                        'eff_date' => '2010-07-25',
                        'end_date' => '2028-07-25',
                        'assign_benefits' => true,
                        'release_info' => true,
                        'own_insurance' => false,

                        'subscriber' => [
                            'relationship_id' => TypeCatalog::whereDescription('Other')->first()->id,
                            'ssn' => null,
                            'date_of_birth' => '2020-04-11',
                            'first_name' => 'Josefa',
                            'last_name' => 'Gonza',
                            'address' => [
                                'address' => 'Southwest 88th Terrace North',
                                'city' => 'Miami',
                                'state' => 'FL - Florida',
                                'zip' => '331861768',
                            ],
                            'contact' => [
                                'mobile' => '7862089999',
                                'phone' => '7862089999',
                                'fax' => '8003341046',
                                'email' => 'josefa@gonzales.net',
                            ],
                        ],
                    ],
                ],
                'guarantor' => [
                    'name' => 'Carlos Cardenas',
                    'phone' => '7862089222',
                ],

                'emergency_contacts' => [
                    [
                        'name' => 'Dioshila Cardenas',
                        'cellphone' => '7862089999',
                        'relationship_id' => TypeCatalog::whereDescription('Parent')->first()->id,
                    ],
                ],

                'employments' => [
                    [
                        'employer_name' => 'Kevin Per',
                        'position' => 'Development',
                        'employer_address' => '1300455 Southwest 88th Terrace North',
                        'employer_phone' => '7862089235',
                    ],
                ],
                'public_note' => 'Generate seeder patient',
                'private_note' => 'Generate seeder patient',
            ], [
                'billing_company' => 'MCC',
                'driver_license' => '1666666',

                'profile' => [
                    'ssn' => '777121246',
                    'avatar' => 'http://31.220.55.211:81/img-profile/1675263673png',
                    'first_name' => 'Wendy',
                    'last_name' => 'Barrueto',
                    'middle_name' => null,
                    'date_of_birth' => '1979-09-02',
                    'sex' => 'F',
                    'social_medias' => null,
                ],

                'marital_status_id' => MaritalStatus::whereName('Married')->first()->id,
                'marital' => [
                    'spuse_name' => 'Carlos Rosales',
                    'spuse_work' => 'Engineer',
                    'spuse_work_phone' => '04241235555',
                ],

                'company_id' => Company::whereName('Isle Of Palms Recovery Center, Llc')->first()->id,
                'company_med_num' => '441',

                'language' => 'en',

                'addresses' => [
                    [
                        'address_type_id' => AddressType::whereName('House / Residence')->first()->id,
                        'address' => '1571 SW 103 PL',
                        'city' => 'Miami',
                        'state' => 'FL - Florida',
                        'zip' => '331571700',
                    ],
                ],
                'contact' => [
                    'mobile' => '3053188984',
                    'phone' => '7863188984',
                    'fax' => '7863188984',
                    'email' => 'wendy@mail.net',
                ],
                'insurance_policies' => [
                    [
                        'policy_number' => 'XJGH60100767',
                        'group_number' => 'A1436',
                        'insurance_company' => InsuranceCompany::wherePayerId('PAS01')->first()->id,
                        'insurance_plan' => InsurancePlan::where([
                            'name' => 'Connect 1500 Gold',
                            'insurance_company_id' => InsuranceCompany::wherePayerId('PAS01')->first()->id])->first()->id,
                        'type_responsibility_id' => TypeCatalog::where(['code' => 'P', 'description' => 'Primary'])->first()->id,
                        'insurance_policy_type_id' => TypeCatalog::where(['code' => '1', 'description' => 'Health'])->first()->id,
                        'eff_date' => '2018-07-25',
                        'end_date' => '2028-07-25',
                        'assign_benefits' => true,
                        'release_info' => true,
                        'own_insurance' => false,

                        'subscriber' => [
                            'relationship_id' => TypeCatalog::whereDescription('Step Child')->first()->id,
                            'ssn' => null,
                            'date_of_birth' => '1998-04-11',
                            'first_name' => 'Carlos',
                            'last_name' => 'Ochoa',
                            'address' => [
                                'address' => '13000 Southwest 88th Terrace North',
                                'city' => 'Miami',
                                'state' => 'FL - Florida',
                                'zip' => '331861768',
                            ],
                            'contact' => [
                                'mobile' => '7862089555',
                                'phone' => '7862089555',
                                'fax' => '8003341000',
                                'email' => 'carlos@davidochoa.net',
                            ],
                        ],
                    ],
                 ],
                'guarantor' => [
                    'name' => 'Andres Cardenas',
                    'phone' => '7862089999',
                ],

                'emergency_contacts' => [
                    [
                        'name' => 'Carlos Cardenas',
                        'cellphone' => '7862089888',
                        'relationship_id' => TypeCatalog::whereDescription('Parent')->first()->id,
                    ],
                ],

                'employments' => [
                    [
                        'employer_name' => 'Andres Per',
                        'position' => 'Development',
                        'employer_address' => '1300400 Southwest 88th Terrace North',
                        'employer_phone' => '7862089200',
                    ],
                ],
                'public_note' => 'Generate seeder patient',
                'private_note' => 'Generate seeder patient',
            ], [
                'billing_company' => 'MCC',
                'driver_license' => '1777777',

                'profile' => [
                    'ssn' => '777121255',
                    'avatar' => 'http://31.220.55.211:81/img-profile/1675263673png',
                    'first_name' => 'Sara',
                    'last_name' => 'Barrueto',
                    'middle_name' => null,
                    'date_of_birth' => '1955-09-02',
                    'sex' => 'F',
                    'social_medias' => null,
                ],

                'marital_status_id' => MaritalStatus::whereName('Married')->first()->id,
                'marital' => [
                    'spuse_name' => 'Antonio contreras',
                    'spuse_work' => 'Engineer',
                    'spuse_work_phone' => '04241237777',
                ],

                'company_id' => Company::whereName('Isle Of Palms Recovery Center, Llc')->first()->id,
                'company_med_num' => '451',

                'language' => 'en',

                'addresses' => [
                    [
                        'address_type_id' => AddressType::whereName('House / Residence')->first()->id,
                        'address' => '1570 SW 103 PL',
                        'city' => 'Miami',
                        'state' => 'FL - Florida',
                        'zip' => '331571700',
                    ],
                ],
                'contact' => [
                    'mobile' => '7863188984',
                    'phone' => '7863188984',
                    'fax' => '7863188984',
                    'email' => 'sara@mail.net',
                ],
                'insurance_policies' => [
                    [
                        'policy_number' => '917114965',
                        'group_number' => 'Y1436',
                        'insurance_company' => InsuranceCompany::wherePayerId('PAS01')->first()->id,
                        'insurance_plan' => InsurancePlan::where([
                            'name' => 'Connect 1500 Gold',
                            'insurance_company_id' => InsuranceCompany::wherePayerId('PAS01')->first()->id])->first()->id,
                        'type_responsibility_id' => TypeCatalog::where(['code' => 'P', 'description' => 'Primary'])->first()->id,
                        'insurance_policy_type_id' => TypeCatalog::where(['code' => '1', 'description' => 'Health'])->first()->id,
                        'eff_date' => '2017-07-25',
                        'end_date' => '2027-07-25',
                        'assign_benefits' => true,
                        'release_info' => true,
                        'own_insurance' => false,

                        'subscriber' => [
                            'relationship_id' => TypeCatalog::whereDescription('Step Child')->first()->id,
                            'ssn' => null,
                            'date_of_birth' => '1950-04-11',
                            'first_name' => 'Antonio',
                            'last_name' => 'Contretas',
                            'address' => [
                                'address' => '13111 Southwest 88th Terrace North',
                                'city' => 'Miami',
                                'state' => 'FL - Florida',
                                'zip' => '331861768',
                            ],
                            'contact' => [
                                'mobile' => '7862089898',
                                'phone' => '7862089898',
                                'fax' => '8003341011',
                                'email' => 'antonio@contreras.net',
                            ],
                        ],
                    ],
                 ],
                'guarantor' => [
                    'name' => 'Antonio Contreras Cardenas',
                    'phone' => '7862089999',
                ],

                'emergency_contacts' => [
                    [
                        'name' => 'Antonio Cardenas',
                        'cellphone' => '7862089444',
                        'relationship_id' => TypeCatalog::whereDescription('Parent')->first()->id,
                    ],
                ],

                'employments' => [
                    [
                        'employer_name' => 'Andres Per',
                        'position' => 'Development',
                        'employer_address' => '1300400 Southwest 88th Terrace North',
                        'employer_phone' => '7862089200',
                    ],
                ],
                'public_note' => 'Generate seeder patient',
                'private_note' => 'Generate seeder patient',
            ], [
                'billing_company' => 'MCC',
                'driver_license' => '17777798',

                'profile' => [
                    'ssn' => '563612988',
                    'avatar' => 'http://31.220.55.211:81/img-profile/1675263673png',
                    'first_name' => 'George',
                    'last_name' => 'Borg',
                    'middle_name' => null,
                    'date_of_birth' => '1957-09-02',
                    'sex' => 'M',
                    'social_medias' => null,
                ],

                'marital_status_id' => MaritalStatus::whereName('Married')->first()->id,
                'marital' => [
                    'spuse_name' => 'Carla Contreras',
                    'spuse_work' => 'Engineer',
                    'spuse_work_phone' => '04241237722',
                ],

                'company_id' => Company::whereName('Isle Of Palms Recovery Center, Llc')->first()->id,
                'company_med_num' => '9311',

                'language' => 'en',

                'addresses' => [
                    [
                        'address_type_id' => AddressType::whereName('House / Residence')->first()->id,
                        'address' => '3600 SW 103 PL',
                        'city' => 'Miami',
                        'state' => 'FL - Florida',
                        'zip' => '331571700',
                    ],
                ],
                'contact' => [
                    'mobile' => '3863188984',
                    'phone' => '3863188984',
                    'fax' => '3863188984',
                    'email' => 'george@mail.net',
                ],
                'insurance_policies' => [
                    [
                        'policy_number' => '942794810',
                        'group_number' => '3W0885',
                        'insurance_company' => InsuranceCompany::wherePayerId('PAS01')->first()->id,
                        'insurance_plan' => InsurancePlan::where([
                            'name' => 'Connect 1500 Gold',
                            'insurance_company_id' => InsuranceCompany::wherePayerId('PAS01')->first()->id])->first()->id,
                        'type_responsibility_id' => TypeCatalog::where(['code' => 'P', 'description' => 'Primary'])->first()->id,
                        'insurance_policy_type_id' => TypeCatalog::where(['code' => '1', 'description' => 'Health'])->first()->id,
                        'eff_date' => '2016-07-25',
                        'end_date' => '2027-07-25',
                        'assign_benefits' => true,
                        'release_info' => true,
                        'own_insurance' => false,

                        'subscriber' => [
                            'relationship_id' => TypeCatalog::whereDescription('Step Child')->first()->id,
                            'ssn' => null,
                            'date_of_birth' => '1940-04-11',
                            'first_name' => 'Carla',
                            'last_name' => 'Contreras',
                            'address' => [
                                'address' => '13121 Southwest 88th Terrace North',
                                'city' => 'Miami',
                                'state' => 'FL - Florida',
                                'zip' => '331861768',
                            ],
                            'contact' => [
                                'mobile' => '7862089844',
                                'phone' => '78620898948',
                                'fax' => '8003341011',
                                'email' => 'carla@contreras.net',
                            ],
                        ],
                    ],
                 ],
                'guarantor' => [
                    'name' => 'Carla Contreras Cardenas',
                    'phone' => '7562089999',
                ],

                'emergency_contacts' => [
                    [
                        'name' => 'Carla Cardenas',
                        'cellphone' => '7867089444',
                        'relationship_id' => TypeCatalog::whereDescription('Parent')->first()->id,
                    ],
                ],

                'employments' => [
                    [
                        'employer_name' => 'Andres Per',
                        'position' => 'Development',
                        'employer_address' => '1300400 Southwest 88th Terrace North',
                        'employer_phone' => '7862089200',
                    ],
                ],
                'public_note' => 'Generate seeder patient',
                'private_note' => 'Generate seeder patient',
            ], [
                'billing_company' => 'MCC',
                'driver_license' => '1898989',

                'profile' => [
                    'ssn' => '592490688',
                    'avatar' => 'http://31.220.55.211:81/img-profile/1675263673png',
                    'first_name' => 'Laura',
                    'last_name' => 'Diaz',
                    'middle_name' => null,
                    'date_of_birth' => '1985-09-02',
                    'sex' => 'F',
                    'social_medias' => null,
                ],

                'marital_status_id' => MaritalStatus::whereName('Married')->first()->id,
                'marital' => [
                    'spuse_name' => 'Fabricio Rosales',
                    'spuse_work' => 'Doctor',
                    'spuse_work_phone' => '04241234565',
                ],

                'company_id' => Company::whereName('Isle Of Palms Recovery Center, Llc')->first()->id,
                'company_med_num' => 'MDDELMA',

                'language' => 'en',

                'addresses' => [
                    [
                        'address_type_id' => AddressType::whereName('House / Residence')->first()->id,
                        'address' => '16089 SW 103 PL',
                        'city' => 'Miami',
                        'state' => 'FL - Florida',
                        'zip' => '331571768',
                    ],
                ],
                'contact' => [
                    'mobile' => '7864488984',
                    'phone' => '7864488984',
                    'fax' => '7864488984',
                    'email' => 'laura@mail.net',
                ],
                'insurance_policies' => [
                    [
                        'policy_number' => '8251957729',
                        'group_number' => '589658',
                        'insurance_company' => InsuranceCompany::wherePayerId('PAS01')->first()->id,
                        'insurance_plan' => InsurancePlan::where([
                            'name' => 'Connect 1500 Gold',
                            'insurance_company_id' => InsuranceCompany::wherePayerId('PAS01')->first()->id])->first()->id,
                        'type_responsibility_id' => TypeCatalog::where(['code' => 'P', 'description' => 'Primary'])->first()->id,
                        'insurance_policy_type_id' => TypeCatalog::where(['code' => '1', 'description' => 'Health'])->first()->id,
                        'eff_date' => '2018-07-25',
                        'end_date' => '2029-07-25',
                        'assign_benefits' => true,
                        'release_info' => true,
                        'own_insurance' => false,

                        'subscriber' => [
                            'relationship_id' => TypeCatalog::whereDescription('Step Child')->first()->id,
                            'ssn' => null,
                            'date_of_birth' => '1996-04-11',
                            'first_name' => 'Car',
                            'last_name' => 'Diaz',
                            'address' => [
                                'address' => '13044 Southwest 88th Terrace North',
                                'city' => 'Miami',
                                'state' => 'FL - Florida',
                                'zip' => '331861768',
                            ],
                            'contact' => [
                                'mobile' => '7862077222',
                                'phone' => '7862077222',
                                'fax' => '80033471000',
                                'email' => 'Car@ads.net',
                            ],
                        ],
                    ],
                    [
                        'policy_number' => '592490688A',
                        'group_number' => '8183747',
                        'insurance_company' => InsuranceCompany::wherePayerId('PAS01')->first()->id,
                        'insurance_plan' => 6,
                        'type_responsibility_id' => TypeCatalog::where(['code' => 'S', 'description' => 'Secundary'])->first()->id,
                        'insurance_policy_type_id' => TypeCatalog::where(['code' => '1', 'description' => 'Health'])->first()->id,
                        'eff_date' => '2012-07-25',
                        'end_date' => '2026-07-25',
                        'assign_benefits' => true,
                        'release_info' => true,
                        'own_insurance' => false,

                        'subscriber' => [
                            'relationship_id' => TypeCatalog::whereDescription('Other')->first()->id,
                            'ssn' => null,
                            'date_of_birth' => '2020-04-11',
                            'first_name' => 'Car',
                            'last_name' => 'Gonza',
                            'address' => [
                                'address' => 'Southwest 688th Terrace North',
                                'city' => 'Miami',
                                'state' => 'FL - Florida',
                                'zip' => '331861768',
                            ],
                            'contact' => [
                                'mobile' => '7862089925',
                                'phone' => '7862089925',
                                'fax' => '8003341025',
                                'email' => 'car@gonzales.net',
                            ],
                        ],
                    ],
                ],
                'guarantor' => [
                    'name' => 'Car Cardenas',
                    'phone' => '7862089722',
                ],

                'emergency_contacts' => [
                    [
                        'name' => 'Car Cardenas',
                        'cellphone' => '7862879999',
                        'relationship_id' => TypeCatalog::whereDescription('Parent')->first()->id,
                    ],
                ],

                'employments' => [
                    [
                        'employer_name' => 'Kevin Per',
                        'position' => 'Development',
                        'employer_address' => '1300455 Southwest 88th Terrace North',
                        'employer_phone' => '7862089235',
                    ],
                ],
                'public_note' => 'Generate seeder patient',
                'private_note' => 'Generate seeder patient',
            ], [
                'billing_company' => 'MCC',
                'driver_license' => '17896325',

                'profile' => [
                    'ssn' => '593470117',
                    'avatar' => 'http://31.220.55.211:81/img-profile/1675263673png',
                    'first_name' => 'Juan',
                    'last_name' => 'Diaz',
                    'middle_name' => null,
                    'date_of_birth' => '1975-09-02',
                    'sex' => 'M',
                    'social_medias' => null,
                ],

                'marital_status_id' => MaritalStatus::whereName('Married')->first()->id,
                'marital' => [
                    'spuse_name' => 'Fabiana Rosales',
                    'spuse_work' => 'Doctor',
                    'spuse_work_phone' => '04241234565',
                ],

                'company_id' => Company::whereName('Isle Of Palms Recovery Center, Llc')->first()->id,
                'company_med_num' => 'MDDELMAR',

                'language' => 'en',

                'addresses' => [
                    [
                        'address_type_id' => AddressType::whereName('House / Residence')->first()->id,
                        'address' => '160879 SW 103 PL',
                        'city' => 'Miami',
                        'state' => 'FL - Florida',
                        'zip' => '331571768',
                    ],
                ],
                'contact' => [
                    'mobile' => '7864488912',
                    'phone' => '7864488912',
                    'fax' => '7864488912',
                    'email' => 'juan@mail.net',
                ],
                'insurance_policies' => [
                    [
                        'policy_number' => '8251533376',
                        'group_number' => '5896588',
                        'insurance_company' => InsuranceCompany::wherePayerId('PAS01')->first()->id,
                        'insurance_plan' => InsurancePlan::where([
                            'name' => 'Connect 1500 Gold',
                            'insurance_company_id' => InsuranceCompany::wherePayerId('PAS01')->first()->id])->first()->id,
                        'type_responsibility_id' => TypeCatalog::where(['code' => 'P', 'description' => 'Primary'])->first()->id,
                        'insurance_policy_type_id' => TypeCatalog::where(['code' => '1', 'description' => 'Health'])->first()->id,
                        'eff_date' => '2018-07-01',
                        'end_date' => '2029-07-01',
                        'assign_benefits' => true,
                        'release_info' => true,
                        'own_insurance' => false,

                        'subscriber' => [
                            'relationship_id' => TypeCatalog::whereDescription('Step Child')->first()->id,
                            'ssn' => null,
                            'date_of_birth' => '1965-04-11',
                            'first_name' => 'Fab',
                            'last_name' => 'Diaz',
                            'address' => [
                                'address' => '13044 Southwest 88th Terrace North',
                                'city' => 'Miami',
                                'state' => 'FL - Florida',
                                'zip' => '331861768',
                            ],
                            'contact' => [
                                'mobile' => '7861077222',
                                'phone' => '7861077222',
                                'fax' => '80013471000',
                                'email' => 'fab@ads.net',
                            ],
                        ],
                    ],
                    [
                        'policy_number' => 'XJMH93116737',
                        'group_number' => '81837475',
                        'insurance_company' => InsuranceCompany::wherePayerId('PAS01')->first()->id,
                        'insurance_plan' => 6,
                        'type_responsibility_id' => TypeCatalog::where(['code' => 'S', 'description' => 'Secundary'])->first()->id,
                        'insurance_policy_type_id' => TypeCatalog::where(['code' => '1', 'description' => 'Health'])->first()->id,
                        'eff_date' => '2012-08-25',
                        'end_date' => '2026-08-25',
                        'assign_benefits' => true,
                        'release_info' => true,
                        'own_insurance' => false,

                        'subscriber' => [
                            'relationship_id' => TypeCatalog::whereDescription('Other')->first()->id,
                            'ssn' => null,
                            'date_of_birth' => '2020-04-11',
                            'first_name' => 'Fab',
                            'last_name' => 'Gonza',
                            'address' => [
                                'address' => 'Southwest 688th Terrace North',
                                'city' => 'Miami',
                                'state' => 'FL - Florida',
                                'zip' => '331861744',
                            ],
                            'contact' => [
                                'mobile' => '7862089933',
                                'phone' => '7862089933',
                                'fax' => '8003341033',
                                'email' => 'fab@gonzales.net',
                            ],
                        ],
                    ],
                ],
                'guarantor' => [
                    'name' => 'Fab Cardenas',
                    'phone' => '7862089422',
                ],

                'emergency_contacts' => [
                    [
                        'name' => 'Fab Cardenas',
                        'cellphone' => '7862879933',
                        'relationship_id' => TypeCatalog::whereDescription('Parent')->first()->id,
                    ],
                ],

                'employments' => [
                    [
                        'employer_name' => 'Kevin Per',
                        'position' => 'Development',
                        'employer_address' => '1300455 Southwest 88th Terrace North',
                        'employer_phone' => '7862089235',
                    ],
                ],
                'public_note' => 'Generate seeder patient',
                'private_note' => 'Generate seeder patient',
            ], [
                'billing_company' => 'MCC',
                'driver_license' => '17846325',

                'profile' => [
                    'ssn' => '267687061',
                    'avatar' => 'http://31.220.55.211:81/img-profile/1675263673png',
                    'first_name' => 'Diego',
                    'last_name' => 'Medina',
                    'middle_name' => null,
                    'date_of_birth' => '2020-09-02',
                    'sex' => 'M',
                    'social_medias' => null,
                ],

                'marital_status_id' => MaritalStatus::whereName('Married')->first()->id,
                'marital' => [
                    'spuse_name' => 'Yesenia Diaz',
                    'spuse_work' => 'Student',
                    'spuse_work_phone' => '04241234585',
                ],

                'company_id' => Company::whereName('Isle Of Palms Recovery Center, Llc')->first()->id,
                'company_med_num' => '2445',

                'language' => 'en',

                'addresses' => [
                    [
                        'address_type_id' => AddressType::whereName('House / Residence')->first()->id,
                        'address' => '1760879 SW 103 PL',
                        'city' => 'Miami',
                        'state' => 'FL - Florida',
                        'zip' => '331571768',
                    ],
                ],
                'contact' => [
                    'mobile' => '3058649949',
                    'phone' => '3058649949',
                    'fax' => '3058649949',
                    'email' => 'diego@mail.net',
                ],
                'insurance_policies' => [
                    [
                        'policy_number' => '267687061A',
                        'group_number' => '5896111',
                        'insurance_company' => InsuranceCompany::wherePayerId('PAS01')->first()->id,
                        'insurance_plan' => InsurancePlan::where([
                            'name' => 'Connect 1500 Gold',
                            'insurance_company_id' => InsuranceCompany::wherePayerId('PAS01')->first()->id])->first()->id,
                        'type_responsibility_id' => TypeCatalog::where(['code' => 'P', 'description' => 'Primary'])->first()->id,
                        'insurance_policy_type_id' => TypeCatalog::where(['code' => '1', 'description' => 'Health'])->first()->id,
                        'eff_date' => '2015-07-01',
                        'end_date' => '2025-07-01',
                        'assign_benefits' => true,
                        'release_info' => true,
                        'own_insurance' => false,

                        'subscriber' => [
                            'relationship_id' => TypeCatalog::whereDescription('Step Child')->first()->id,
                            'ssn' => null,
                            'date_of_birth' => '1975-04-11',
                            'first_name' => 'Mary',
                            'last_name' => 'Dante',
                            'address' => [
                                'address' => '13044 Southwest 88th Terrace North',
                                'city' => 'Miami',
                                'state' => 'FL - Florida',
                                'zip' => '331861768',
                            ],
                            'contact' => [
                                'mobile' => '8881077222',
                                'phone' => '8881077222',
                                'fax' => '88813471000',
                                'email' => 'mary@ads.net',
                            ],
                        ],
                    ],
                    [
                        'policy_number' => 'XJNH12299113',
                        'group_number' => '818374785',
                        'insurance_company' => InsuranceCompany::wherePayerId('PAS01')->first()->id,
                        'insurance_plan' => 6,
                        'type_responsibility_id' => TypeCatalog::where(['code' => 'S', 'description' => 'Secundary'])->first()->id,
                        'insurance_policy_type_id' => TypeCatalog::where(['code' => '1', 'description' => 'Health'])->first()->id,
                        'eff_date' => '2012-08-25',
                        'end_date' => '2026-08-25',
                        'assign_benefits' => true,
                        'release_info' => true,
                        'own_insurance' => false,

                        'subscriber' => [
                            'relationship_id' => TypeCatalog::whereDescription('Other')->first()->id,
                            'ssn' => null,
                            'date_of_birth' => '2020-04-11',
                            'first_name' => 'Jesus',
                            'last_name' => 'Medina',
                            'address' => [
                                'address' => 'Southwest 688th Terrace North',
                                'city' => 'Miami',
                                'state' => 'FL - Florida',
                                'zip' => '331861744',
                            ],
                            'contact' => [
                                'mobile' => '7882089933',
                                'phone' => '7882089933',
                                'fax' => '8083341033',
                                'email' => 'jesus@gonzales.net',
                            ],
                        ],
                    ],
                ],
                'guarantor' => [
                    'name' => 'Jesus Medina',
                    'phone' => '7862089482',
                ],

                'emergency_contacts' => [
                    [
                        'name' => 'Jesus Medina',
                        'cellphone' => '7862878883',
                        'relationship_id' => TypeCatalog::whereDescription('Parent')->first()->id,
                    ],
                ],

                'employments' => [
                    [
                        'employer_name' => 'Kevin Per',
                        'position' => 'Development',
                        'employer_address' => '1300455 Southwest 88th Terrace North',
                        'employer_phone' => '7862089235',
                    ],
                ],
                'public_note' => 'Generate seeder patient',
                'private_note' => 'Generate seeder patient',
            ],
        ];

        foreach ($patients as $dataP) {
            /* Create Profile */
            if (isset($dataP['profile']['ssn'])) {
                $profile = Profile::updateOrCreate([
                    'first_name' => $dataP['profile']['first_name'],
                    'last_name' => $dataP['profile']['last_name'],
                    'date_of_birth' => $dataP['profile']['date_of_birth'],
                    'ssn' => $dataP['profile']['ssn'],
                ], [
                    'ssn' => $dataP['profile']['ssn'],
                    'avatar' => $dataP['profile']['avatar'] ?? null,
                    'first_name' => $dataP['profile']['first_name'],
                    'middle_name' => $dataP['profile']['middle_name'] ?? '',
                    'last_name' => $dataP['profile']['last_name'],
                    'sex' => $dataP['profile']['sex'],
                    'date_of_birth' => $dataP['profile']['date_of_birth'],
                    'language' => $dataP['language'] ?? 'en',
                ]);
            } else {
                $profile = Profile::updateOrCreate([
                    'first_name' => $dataP['profile']['first_name'],
                    'last_name' => $dataP['profile']['last_name'],
                    'date_of_birth' => $dataP['profile']['date_of_birth'],
                ], [
                    'ssn' => $dataP['profile']['ssn'] ?? '',
                    'first_name' => $dataP['profile']['first_name'],
                    'middle_name' => $dataP['profile']['middle_name'] ?? '',
                    'last_name' => $dataP['profile']['last_name'],
                    'sex' => $dataP['profile']['sex'],
                    'date_of_birth' => $dataP['profile']['date_of_birth'],
                    'language' => $dataP['language'] ?? 'en',
                ]);
            }

            if (isset($dataP['profile']['social_medias'])) {
                $socialMedias = $profile->socialMedias;
                /* Delete socialMedia */
                foreach ($socialMedias as $socialMedia) {
                    $validated = false;
                    $socialNetwork = $socialMedia->SocialNetwork;
                    if (isset($socialNetwork)) {
                        foreach ($dataP['profile']['social_medias'] as $socialM) {
                            if ($socialM['name'] == $socialNetwork->name) {
                                $validated = true;
                                break;
                            }
                        }
                    }
                    if (!$validated) {
                        $socialMedia->delete();
                    }
                }

                /* update or create new social medias */
                foreach ($dataP['profile']['social_medias'] as $socialMedia) {
                    $socialNetwork = SocialNetwork::whereName($socialMedia['name'])->first();
                    if (isset($socialNetwork)) {
                        SocialMedia::updateOrCreate([
                            'profile_id' => $profile->id,
                            'social_network_id' => $socialNetwork->id,
                        ], [
                            'link' => $socialMedia['link'],
                        ]);
                    }
                }
            }

            /** Create User */
            $user = User::query()->firstOrCreate([
                'email' => $dataP['contact']['email'],
            ], [
                'usercode' => generateNewCode('US', 5, date('Y'), User::class, 'usercode'),
                'userkey' => encrypt(uniqid('', true)),
                'profile_id' => $profile->id,
            ]);

            $billingCompany = BillingCompany::whereAbbreviation($dataP['billing_company'])->first();

            /* Attach billing company */
            $user->billingCompanies()->syncWithoutDetaching($billingCompany->id ?? $billingCompany);
            $user->billingCompanies()
                ->wherePivot('billing_company_id', $billingCompany->id ?? $billingCompany)
                ->first()
                ->membership
                ->roles()
                ->syncWithoutDetaching(MembershipRole::query()->whereSlug('patient')->where('billing_company_id', null)->first()->id);

            /* Create Contact */
            if (isset($dataP['contact'])) {
                Contact::firstOrCreate([
                    'contactable_id' => $user->id,
                    'contactable_type' => User::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], $dataP['contact']);
            }

            /* Create Address */
            if (isset($dataP['addresses'])) {
                foreach ($dataP['addresses'] as $address) {
                    Address::firstOrCreate([
                        'addressable_id' => $user->id,
                        'addressable_type' => User::class,
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    ], $address);
                }
            }

            /** Create Patient */
            $patient = Patient::firstOrCreate([
                'driver_license' => $dataP['driver_license'] ?? '',
            ], [
                'code' => generateNewCode('PA', 5, date('Y'), Patient::class, 'code'),
                'marital_status_id' => $dataP['marital_status_id'] ?? null,
                'profile_id' => $profile->id,
            ]);

            if (is_null($patient->billingCompanies()->find($billingCompany->id ?? $billingCompany))) {
                $patient->billingCompanies()->attach($billingCompany->id ?? $billingCompany, [
                    'save_as_draft' => $dataP['save_as_draft'] ?? false,
                ]);
            } else {
                $patient->billingCompanies()->updateExistingPivot(
                    $billingCompany->id ?? $billingCompany,
                    [
                        'status' => true,
                        'save_as_draft' => $dataP['save_as_draft'] ?? false,
                    ]
                );
            }

            if (isset($dataP['public_note'])) {
                /* PublicNote */
                PublicNote::updateOrCreate([
                    'publishable_id' => $patient->id,
                    'publishable_type' => Patient::class,
                ], [
                    'note' => $dataP['public_note'],
                ]);
            }

            if (isset($dataP['private_note'])) {
                /* PrivateNote */
                PrivateNote::firstOrCreate([
                    'publishable_id' => $patient->id,
                    'publishable_type' => Patient::class,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], [
                    'note' => $dataP['private_note'],
                ]);
            }

            /* Create Marital */
            if (isset($dataP['marital']['spuse_name'])) {
                $dataP['marital']['patient_id'] = $patient->id;
                $marital = Marital::firstOrCreate([
                    'patient_id' => $patient->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], $dataP['marital']);
            }

            /* Create Guarantor */
            if (isset($dataP['guarantor']['name'])) {
                $data['guarantor']['patient_id'] = $patient->id;
                $guarantor = Guarantor::firstOrCreate([
                    'patient_id' => $patient->id,
                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                ], $dataP['guarantor']);
            }

            /* Create Employment */
            if (isset($dataP['employments'])) {
                foreach ($dataP['employments'] as $employment) {
                    $employment['patient_id'] = $patient->id;
                    Employment::firstOrCreate([
                        'patient_id' => $patient->id,
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    ], $employment);
                }
            }

            /* Emergency Contacts */
            if (isset($dataP['emergency_contacts'])) {
                $emergencyContacts = $patient->emergencyContacts;
                /* Delete energencyContact */
                foreach ($emergencyContacts as $emergencyContact) {
                    $validated = false;
                    foreach ($dataP['emergency_contacts'] as $emergencyC) {
                        if ($emergencyC['name'] == $emergencyContact->name) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) {
                        $emergencyContact->delete();
                    }
                }

                /* update or create new emergency contact */
                foreach ($dataP['emergency_contacts'] as $emergencyContact) {
                    EmergencyContact::updateOrCreate([
                        'name' => $emergencyContact['name'],
                        'patient_id' => $patient->id,
                    ], [
                        'name' => $emergencyContact['name'],
                        'cellphone' => $emergencyContact['cellphone'],
                        'relationship_id' => $emergencyContact['relationship_id'],
                        'patient_id' => $patient->id,
                    ]);
                }
            }

            /* Company */
            if (isset($dataP['company_id'])) {
                /** Attached patient to company */
                $company = Company::find($dataP['company_id']);
                if (is_null($patient->companies()->find($company->id))) {
                    $patient->companies()->attach($company->id, [
                        'med_num' => $dataP['company_med_num'] ?? '',
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                    ]);
                }
            }

            /* Insurance Policies */
            if (isset($dataP['insurance_policies'])) {
                $insurancePlans = $patient->insurancePlans;
                /* Detach Insurance plan */
                foreach ($insurancePlans as $insurancePlan) {
                    $validated = false;
                    foreach ($dataP['insurance_policies'] as $insurancePolicy) {
                        if ($insurancePolicy['insurance_plan'] == $insurancePlan->id) {
                            $validated = true;
                            break;
                        }
                    }
                    if (!$validated) {
                        $patient->insurancePlans()->detach($insurancePlan->id);
                    }
                }

                /* Attach new insurance plan */
                foreach ($dataP['insurance_policies'] as $insurance_policy) {
                    /** Attached patient to insurance plan */
                    $insurancePlan = InsurancePlan::find($insurance_policy['insurance_plan']);

                    $insurancePolicy = InsurancePolicy::updateOrCreate([
                        'patient_id' => $patient->id,
                        'billing_company_id' => $billingCompany->id ?? $billingCompany,
                        'policy_number' => $insurance_policy['policy_number'],
                        'insurance_plan_id' => $insurancePlan->id,
                    ], [
                        'own' => $insurance_policy['own_insurance'] ?? false,
                        'group_number' => $insurance_policy['group_number'] ?? '',
                        'eff_date' => $insurance_policy['eff_date'],
                        'end_date' => $insurance_policy['end_date'] ?? null,
                        'insurance_policy_type_id' => $insurance_policy['insurance_policy_type_id'] ?? null,
                        'type_responsibility_id' => $insurance_policy['type_responsibility_id'],
                        'release_info' => $insurance_policy['release_info'],
                        'assign_benefits' => $insurance_policy['assign_benefits'],
                    ]);

                    if (is_null($patient->insurancePlans()->find($insurancePlan->id))) {
                        $patient->insurancePlans()->attach($insurancePlan->id);
                    }

                    if (false == $insurance_policy['own_insurance']) {
                        /** The subscriber is searched for each billing company */
                        $subscriber = Subscriber::firstOrCreate([
                            'ssn' => $insurance_policy['subscriber']['ssn'],
                            'first_name' => upperCaseWords($insurance_policy['subscriber']['first_name']),
                            'last_name' => upperCaseWords($insurance_policy['subscriber']['last_name']),
                            'date_of_birth' => $insurance_policy['subscriber']['date_of_birth'] ?? null,
                        ], [
                            'first_name' => $insurance_policy['subscriber']['first_name'],
                            'last_name' => $insurance_policy['subscriber']['last_name'],
                            'date_of_birth' => $insurance_policy['subscriber']['date_of_birth'] ?? null,
                            'relationship_id' => $insurance_policy['subscriber']['relationship_id'] ?? null,
                        ]);

                        if (isset($subscriber)) {
                            /* Create Contact */
                            if (isset($insurance_policy['subscriber']['contact'])) {
                                Contact::firstOrCreate([
                                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                                    'contactable_id' => $subscriber->id,
                                    'contactable_type' => Subscriber::class,
                                ], $insurance_policy['subscriber']['contact']);
                            }

                            /* Create Address */
                            if (isset($insurance_policy['subscriber']['address'])) {
                                Address::firstOrCreate([
                                    'billing_company_id' => $billingCompany->id ?? $billingCompany,
                                    'addressable_id' => $subscriber->id,
                                    'addressable_type' => Subscriber::class,
                                ], $insurance_policy['subscriber']['address']);
                            }
                            /* Attached patient to subscriber */
                            if (is_null($patient->subscribers()->find($subscriber->id))) {
                                $patient->subscribers()->attach($subscriber->id);
                            }

                            /* Attached subscriber to insurance plan */
                            /**if (is_null($subscriber->insurancePlans()->find($insurance_policy['insurance_plan']))) {
                                $subscriber->insurancePlans()->attach($insurance_policy['insurance_plan']);
                            }*/

                            /* Attached patient to subscriber */
                            if (is_null($insurancePolicy->subscribers()->find($subscriber->id))) {
                                $insurancePolicy->subscribers()->attach($subscriber->id);
                            }
                        }
                    }
                }

                /**if (isset($dataP['injuries'])) {
                    foreach ($dataP['injuries'] as $injury) {
                        $patientInjury = Injury::updateOrCreate(
                            [
                                'diag_date'    => $injury['diag_date'],
                                'diagnosis_id' => $injury['diagnosis_id'],
                                'type_diag_id' => $injury['type_diag_id'],
                            ],
                            [
                                'diag_date'    => $injury['diag_date'],
                                'diagnosis_id' => $injury['diagnosis_id'],
                                'type_diag_id' => $injury['type_diag_id'],
                            ]
                        );
                        if (isset($injury['public_note'])) {
                            /** PublicNote
                            PublicNote::create([
                                'publishable_type' => Injury::class,
                                'publishable_id'   => $patientInjury->id,
                                'note'             => $injury['public_note'],
                            ]);
                        }
                        if (isset($patientInjury)) {
                            if (is_null($patient->injuries()->find($patientInjury->id))) {
                                $patient->injuries()->attach($patientInjury->id);
                            }
                        }
                    }
                }*/
            }
            if ($user && $patient) {
                $role = Role::where('slug', 'patient')->first();
                if (isset($role)) {
                    $user->attachRole($role);
                    $permissions = $role->permissions;
                    foreach ($permissions as $perm) {
                        $user->attachPermission($perm);
                    }
                }
                $user->password = '$2y$10$TQXo7iYTqVeO.ojMjDIMDO74CSkyFwjZOFp9PUuAG4CYaPNsihp.q';
                $token = encrypt($user->id.'@#@#$'.$user->email);
                $user->token = $token;
                $user->save();
            }
        }
    }
}

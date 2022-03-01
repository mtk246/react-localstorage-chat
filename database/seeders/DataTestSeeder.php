<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\BillingCompany;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Company;
use App\Models\ClearingHouse;
use App\Models\Doctor;
use App\Models\Facility;
use App\Models\User;
use App\Models\InsuranceCompany;
use App\Models\Patient;
use Faker;

class DataTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = new Faker\Generator();
        $faker->addProvider(new Faker\Provider\en_US\Person($faker));
        $faker->addProvider(new Faker\Provider\en_US\Address($faker));
        $faker->addProvider(new Faker\Provider\en_US\PhoneNumber($faker));
        $faker->addProvider(new Faker\Provider\en_US\Company($faker));
        $faker->addProvider(new Faker\Provider\Internet($faker));
        /** Crear BillingCompany */
        $billingCompanies = [
            [
                "name"    => $faker->company,
                "code"    => $faker->companySuffix,
                "address" => $faker->address,
                "city"    => $faker->city,
                "state"   => $faker->streetName,
                "zip"     => $faker->imei,

                "phone" => $faker->phoneNumber,
                "fax"   => $faker->phoneNumber,
                "email" => $faker->companyEmail,
            ],
            [
                "name"    => $faker->company,
                "code"    => $faker->companySuffix,
                "address" => $faker->address,
                "city"    => $faker->city,
                "state"   => $faker->streetName,
                "zip"     => $faker->imei,

                "phone" => $faker->phoneNumber,
                "fax"   => $faker->phoneNumber,
                "email" => $faker->companyEmail,
            ],
            [
                "name"    => $faker->company,
                "code"    => $faker->companySuffix,
                "address" => $faker->address,
                "city"    => $faker->city,
                "state"   => $faker->streetName,
                "zip"     => $faker->imei,

                "phone" => $faker->phoneNumber,
                "fax"   => $faker->phoneNumber,
                "email" => $faker->companyEmail,
            ],
            [
                "name"    => $faker->company,
                "code"    => $faker->companySuffix,
                "address" => $faker->address,
                "city"    => $faker->city,
                "state"   => $faker->streetName,
                "zip"     => $faker->imei,

                "phone" => $faker->phoneNumber,
                "fax"   => $faker->phoneNumber,
                "email" => $faker->companyEmail,
            ]
        ];

        foreach ($billingCompanies as $bcompany) {

            $bc = BillingCompany::updateOrCreate(
                ["name" => $bcompany["name"]],
                [
                    "name" => $bcompany["name"],
                    "code" => $bcompany["code"],
                ]
            );
            Address::updateOrCreate(
                ["billing_company_id" => $bc->id],
                [
                    "address"            => $bcompany["address"],
                    "city"               => $bcompany["city"],
                    "state"              => $bcompany["state"],
                    "zip"                => $bcompany["zip"],
                    "billing_company_id" => $bc->id
                ]
            );
            Contact::updateOrCreate(
                ["billing_company_id" => $bc->id],
                [
                    "phone"              => $bcompany["phone"],
                    "fax"                => $bcompany["fax"],
                    "email"              => $bcompany["email"],
                    "billing_company_id" => $bc->id
                ]
            );
        }
        /** Crear Company */
        $companies = [
            [
                "name"   => $faker->company,
                "code"   => $faker->companySuffix,
                "npi"    => $faker->imei,
                "email"  => $faker->companyEmail,
            ],
            [
                "name"   => $faker->company,
                "code"   => $faker->companySuffix,
                "npi"    => $faker->imei,
                "email"  => $faker->companyEmail,
            ],
            [
                "name"   => $faker->company,
                "code"   => $faker->companySuffix,
                "npi"    => $faker->imei,
                "email"  => $faker->companyEmail,
            ],
            [
                "name"   => $faker->company,
                "code"   => $faker->companySuffix,
                "npi"    => $faker->imei,
                "email"  => $faker->companyEmail,
            ],
        ];

        foreach ($companies as $company) {

            Company::updateOrCreate(
                ["name" => $company["name"]],
                [
                    "name" => $company["name"],
                    "code" => $company["code"],
                    "npi"    => $company["npi"],
                    "email"  => $company["email"],
                ]
            );
        }
        /** Create clearinghouse */
        $clearinghouses = [
            [
                "name"   => $faker->company,
                "code"   => $faker->companySuffix,
            ],
            [
                "name"   => $faker->company,
                "code"   => $faker->companySuffix,
            ],
            [
                "name"   => $faker->company,
                "code"   => $faker->companySuffix,
            ],
            [
                "name"   => $faker->company,
                "code"   => $faker->companySuffix,
            ],
        ];
        foreach ($clearinghouses as $clearinghouse) {

            ClearingHouse::updateOrCreate(
                ["name" => $clearinghouse["name"]],
                [
                    "name" => $clearinghouse["name"],
                    "code" => $clearinghouse["code"],
                ]
            );
        }
        /** Create doctor */
        $usr_doc = User::whereEmail("doctor@billing.com")->first();
        if (!is_null($usr_doc)) {
            Doctor::updateOrCreate(
                ["user_id" => $usr_doc->id],
                [
                    "npi"        => $faker->imei,
                    "taxonomy"   => $faker->jobTitle,
                    "speciality" => $faker->jobTitle,
                    "user_id"    => $usr_doc->id
                ]
            );
        }
        /** Create facility */
        $facilities = [
            [
                "type"         => 1,
                "name"         => $faker->name,
                "company_name" => $faker->company,
                "npi"          => $faker->imei,
                "taxonomy"     => $faker->jobTitle,
            ],
            [
                "type"         => 1,
                "name"         => $faker->name,
                "company_name" => $faker->company,
                "npi"          => $faker->imei,
                "taxonomy"     => $faker->jobTitle,
            ],
            [
                "type"         => 1,
                "name"         => $faker->name,
                "company_name" => $faker->company,
                "npi"          => $faker->imei,
                "taxonomy"     => $faker->jobTitle,
            ],
            [
                "type"         => 1,
                "name"         => $faker->name,
                "company_name" => $faker->company,
                "npi"          => $faker->imei,
                "taxonomy"     => $faker->jobTitle,
            ],
        ];

        foreach ($facilities as $facility) {

            Facility::updateOrCreate(
                ["name" => $facility["name"]],
                [
                    "type"         => $facility["type"],
                    "name"         => $facility["name"],
                    "company_name" => $facility["company_name"],
                    "npi"          => $facility["npi"],
                    "taxonomy"     => $facility["taxonomy"],
                ]
            );
        }
        /** Create insurance company */
        $insuranceCompanies = [
            [
                "code"        => randomNumber(6),
                "name"        => $faker->company,
                "naic"        => $faker->jobTitle,
                "file_method" => "method 1"
            ],
            [
                "code"        => randomNumber(6),
                "name"        => $faker->company,
                "naic"        => $faker->jobTitle,
                "file_method" => "method 1"
            ],
            [
                "code"        => randomNumber(6),
                "name"        => $faker->company,
                "naic"        => $faker->jobTitle,
                "file_method" => "method 1"
            ],
            [
                "code"        => randomNumber(6),
                "name"        => $faker->company,
                "naic"        => $faker->jobTitle,
                "file_method" => "method 1"
            ],
        ];

        foreach ($insuranceCompanies as $iCompany) {

            InsuranceCompany::updateOrCreate(
                ["code" => $iCompany["code"]],
                [
                    "code"        => $iCompany["code"],
                    "name"        => $iCompany["name"],
                    "naic"        => $iCompany["naic"],
                    "file_method" => $iCompany["file_method"]
                ]
            );
        }
        /** Create patient */
        $usr_pat = User::whereEmail("patient@billing.com")->first();
        if (!is_null($usr_doc)) {
            Patient::updateOrCreate(
                ["user_id" => $usr_doc->id],
                [
                    "marital_status"   => "married",
                    "driver_licence"   => randomNumber(6),
                    "guardian_name"    => $faker->name,
                    "guardian_phone"   => $faker->phoneNumber,
                    "spuse_name"       => $faker->name,
                    "employer"         => $faker->name,
                    "employer_address" => $faker->address,
                    "position"         => $faker->jobTitle,
                    "phone_employer"   => $faker->phoneNumber,
                    "spuse_employer"   => $faker->name,
                    "spuse_work_phone" => $faker->phoneNumber,
                    "user_id"          => $usr_doc->id
                ]
            );
        }
    }
}

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
                "address" => [
                    "address" => "Singleton Rd",
                    "city"    => "Calimesa",
                    "state"   => "California",
                    "zip"     => "923202207"
                ],
                "contact" => [
                    "mobile" => $faker->phoneNumber,
                    "phone"  => $faker->phoneNumber,
                    "fax"    => $faker->phoneNumber,
                    "email"  => $faker->companyEmail
                ]
            ],
            [
                "name"    => $faker->company,
                "address" => [
                    "address" => "Rodeo Dr",
                    "city"    => "Beverly Hills",
                    "state"   => "California",
                    "zip"     => "902122403"
                ],
                "contact" => [
                    "mobile" => $faker->phoneNumber,
                    "phone"  => $faker->phoneNumber,
                    "fax"    => $faker->phoneNumber,
                    "email"  => $faker->companyEmail
                ]
            ],
            [
                "name"    => $faker->company,
                "address" => [
                    "address" => "Zoo Dr",
                    "city"    => "Los Angeles",
                    "state"   => "California",
                    "zip"     => "900271422"
                ],
                "contact" => [
                    "mobile" => $faker->phoneNumber,
                    "phone"  => $faker->phoneNumber,
                    "fax"    => $faker->phoneNumber,
                    "email"  => $faker->companyEmail
                ]
            ],
            [
                "name"    => $faker->company,
                "address" => [
                    "address" => "",
                    "city"    => "",
                    "state"   => "",
                    "zip"     => ""
                ],
                "contact" => [
                    "mobile" => "",
                    "phone"  => "",
                    "fax"    => "",
                    "email"  => $faker->companyEmail
                ]
            ],
        ];

        foreach ($billingCompanies as $bcompany) {

            $bc = BillingCompany::updateOrCreate(
                ["name" => $bcompany["name"]],
                [
                    "name" => $bcompany["name"],
                    "code" => generateNewCode("BC", 5, date("Y"), BillingCompany::class, "code")
                ]
            );
            if ($bcompany["address"]["address"] != "") {
                Address::updateOrCreate(
                    ["billing_company_id" => $bc->id],
                    [
                        "address"            => $bcompany["address"]["address"],
                        "city"               => $bcompany["address"]["city"],
                        "state"              => $bcompany["address"]["state"],
                        "zip"                => $bcompany["address"]["zip"],
                        "billing_company_id" => $bc->id,
                        "addressable_type"   => BillingCompany::class,
                        "addressable_id"     => $bc->id
                    ]
                );
            }
            if ($bcompany["contact"]["email"] != "") {
                Contact::updateOrCreate(
                    ["billing_company_id" => $bc->id],
                    [
                        "mobile"             => $bcompany["contact"]["mobile"],
                        "phone"              => $bcompany["contact"]["phone"],
                        "fax"                => $bcompany["contact"]["fax"],
                        "email"              => $bcompany["contact"]["email"],
                        "billing_company_id" => $bc->id,
                        "contactable_type"   => BillingCompany::class,
                        "contactable_id"     => $bc->id
                    ]
                );
            }
        }

        /** Billing Manager */
        $user_bc = User::whereEmail('billingmanager@billing.com')->first();
        $bCompany = BillingCompany::first();
        $user_bc->billingCompanies()->attach($bCompany->id);
    }
}
        
<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Address;
use App\Models\BillingCompany;
use App\Models\Contact;
use Illuminate\Database\Seeder;

final class BillingCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
        ];

        $BCTest = [
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

        if ('production' !== env('APP_ENV', 'local')) {
            $billingCompanies = array_merge($billingCompanies, $BCTest);
        }

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
        }
    }
}

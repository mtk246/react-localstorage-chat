<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

final class CountrySubdivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['code' => 'US', 'name' => 'United States of America'],
        ];
        $states = [
            ['code' => 'AK', 'name' => 'Alaska'],
            ['code' => 'AL', 'name' => 'Alabama'],
            ['code' => 'AR', 'name' => 'Arkansas'],
            ['code' => 'AS', 'name' => 'American Samoa (see also separate entry under AS)'],
            ['code' => 'AZ', 'name' => 'Arizona'],
            ['code' => 'CA', 'name' => 'California'],
            ['code' => 'CO', 'name' => 'Colorado'],
            ['code' => 'CT', 'name' => 'Connecticut'],
            ['code' => 'DC', 'name' => 'District of Columbia'],
            ['code' => 'DE', 'name' => 'Delaware'],
            ['code' => 'FL', 'name' => 'Florida'],
            ['code' => 'GA', 'name' => 'Georgia'],
            ['code' => 'GU', 'name' => 'Guam (see also separate entry under GU)'],
            ['code' => 'HI', 'name' => 'Hawaii'],
            ['code' => 'IA', 'name' => 'Iowa'],
            ['code' => 'ID', 'name' => 'Idaho'],
            ['code' => 'IL', 'name' => 'Illinois'],
            ['code' => 'IN', 'name' => 'Indiana'],
            ['code' => 'KS', 'name' => 'Kansas'],
            ['code' => 'KY', 'name' => 'Kentucky'],
            ['code' => 'LA', 'name' => 'Louisiana'],
            ['code' => 'MA', 'name' => 'Massachusetts'],
            ['code' => 'MD', 'name' => 'Maryland'],
            ['code' => 'ME', 'name' => 'Maine'],
            ['code' => 'MI', 'name' => 'Michigan'],
            ['code' => 'MN', 'name' => 'Minnesota'],
            ['code' => 'MO', 'name' => 'Missouri'],
            ['code' => 'MP', 'name' => 'Northern Mariana Islands (see also separate entry MP)'],
            ['code' => 'MS', 'name' => 'Mississippi'],
            ['code' => 'MT', 'name' => 'Montana'],
            ['code' => 'NC', 'name' => 'North Carolina'],
            ['code' => 'ND', 'name' => 'North Dakota'],
            ['code' => 'NE', 'name' => 'Nebraska'],
            ['code' => 'NH', 'name' => 'New Hampshire'],
            ['code' => 'NJ', 'name' => 'New Jersey'],
            ['code' => 'NM', 'name' => 'New Mexico'],
            ['code' => 'NV', 'name' => 'Nevada'],
            ['code' => 'NY', 'name' => 'New York'],
            ['code' => 'OH', 'name' => 'Ohio'],
            ['code' => 'OK', 'name' => 'Oklahoma'],
            ['code' => 'OR', 'name' => 'Oregon'],
            ['code' => 'PA', 'name' => 'Pennsylvania'],
            ['code' => 'PR', 'name' => 'Puerto Rico (see also separate entry under PR)'],
            ['code' => 'RI', 'name' => 'Rhode Island'],
            ['code' => 'SC', 'name' => 'South Carolina'],
            ['code' => 'SD', 'name' => 'South Dakota'],
            ['code' => 'TN', 'name' => 'Tennessee'],
            ['code' => 'TX', 'name' => 'Texas'],
            ['code' => 'UM', 'name' => 'U.S. Minor Outlying Islands (cf. separate entry UM)'],
            ['code' => 'UT', 'name' => 'Utah'],
            ['code' => 'VA', 'name' => 'Virginia'],
            ['code' => 'VI', 'name' => 'Virgin Islands of the U.S. (see also separate entry VI)'],
            ['code' => 'VT', 'name' => 'Vermont'],
            ['code' => 'WA', 'name' => 'Washington'],
            ['code' => 'WI', 'name' => 'Wisconsin'],
            ['code' => 'WV', 'name' => 'West Virginia'],
            ['code' => 'WY', 'name' => 'Wyoming'],
        ];

        foreach ($countries as $country) {
            $countryDB = Country::updateOrCreate([
                'code' => $country['code'],
            ], [
                'name' => $country['name'],
            ]);

            foreach ($states as $state) {
                State::updateOrCreate([
                    'code' => $state['code'],
                ], [
                    'name' => $state['name'],
                    'country_id' => $countryDB->id,
                ]);
            }
        }
    }
}

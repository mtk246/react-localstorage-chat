<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\FacilityType;
use Illuminate\Database\Seeder;

class FacilityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facilityTypes = [
            ['code' => '1', 'type' => 'Hospital'],
            ['code' => '2', 'type' => 'Skilled Nursing'],
            ['code' => '3', 'type' => 'Home Health'],
            ['code' => '4', 'type' => 'Christian Science (Hospital)'],
            ['code' => '5', 'type' => 'Christian Science (Extended Care)'],
            ['code' => '6', 'type' => 'Intermediate Care'],
            ['code' => '7', 'type' => 'Clinic '],
            ['code' => '8', 'type' => 'Special Facility or Hospital ASC Surgery'],
        ];

        FacilityType::truncate();

        foreach ($facilityTypes as $type) {
            FacilityType::updateOrCreate($type, $type);
        }
    }
}

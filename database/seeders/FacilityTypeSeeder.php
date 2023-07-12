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
            ['type' => 'Hospital'],
            ['type' => 'Skilled Nursing'],
            ['type' => 'Home Health'],
            ['type' => 'Christian Science (Hospital)'],
            ['type' => 'Christian Science (Extended Care)'],
            ['type' => 'Intermediate Care'],
            ['type' => 'Clinic '],
            ['type' => 'Special Facility or Hospital ASC Surgery'],
        ];

        foreach ($facilityTypes as $type) {
            FacilityType::updateOrCreate($type, $type);
        }
    }
}

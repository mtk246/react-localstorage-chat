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
            ['type' => '01 - Clinics'],
            ['type' => '02 - Hospitals'],
            ['type' => '03 - Labs'],
            ['type' => '75X - Comprehensive Outpa...'],
            ['type' => '86X - Specialty Facility Res...'],
            ['type' => 'AL - Assisted Living Facility'],
            ['type' => 'ASC - Ambulatory Surgery Center'],
            ['type' => 'LAB - Free Standing Lab Facility'],
            ['type' => 'OT - Special Facility - Other'],
            ['type' => 'RRH - Rural Health Clinic'],
            ['type' => 'SN - Skilled Nursing Facility'],
        ];

        foreach ($facilityTypes as $type) {
            FacilityType::updateOrCreate($type, $type);
        }
    }
}

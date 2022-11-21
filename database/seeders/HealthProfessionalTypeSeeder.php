<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HealthProfessionalType;
use App\Models\CompanyHealthProfessionalType;

class HealthProfessionalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $healthProfessionalTypes = [
            ['type' => 'Medical'],
            ['type' => 'Male nurse'],
            ['type' => 'Attendees']
        ];

        foreach ($healthProfessionalTypes as $type) {
            HealthProfessionalType::updateOrCreate($type, $type);
        }

        $companyHealthProfessionalTypes = [
            ['type' => 'Service Provider'],
            ['type' => 'Billing Provider'],
            ['type' => 'Referred']
        ];

        foreach ($companyHealthProfessionalTypes as $type) {
            CompanyHealthProfessionalType::updateOrCreate($type, $type);
        }
    }
}

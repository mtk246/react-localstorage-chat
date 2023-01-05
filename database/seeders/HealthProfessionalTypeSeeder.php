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
            ['type' => 'Medical doctor'],
            ['type' => 'Nurse practitioners'],
            ['type' => 'Physician assistants'],
            ['type' => 'Certified nurse specialists trained in a particular field such as E/R, pediatric or diabetic nursing'],
            ['type' => 'Certified nurse midwives'],
            ['type' => 'Certified registered nurse anesthetists'],
            ['type' => 'Clinical social worker'],
            ['type' => 'Physical therapists'],
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

<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\CompanyHealthProfessionalType;
use Illuminate\Database\Seeder;

class HealthProfessionalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companyHealthProfessionalTypes = [
            ['type' => 'Service Provider'],
            ['type' => 'Billing Provider'],
            ['type' => 'Referred'],
        ];

        foreach ($companyHealthProfessionalTypes as $type) {
            CompanyHealthProfessionalType::updateOrCreate($type, $type);
        }
    }
}

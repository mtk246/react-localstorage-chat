<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InsurancePolicyType;

class InsurancePolicyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insurancePolicyTypes = [
            ['code' => '1', 'name' => 'Health'],
            ['code' => '2', 'name' => 'Auto'],
            ['code' => '3', 'name' => 'Work Comp'],
            ['code' => 'I', 'name' => 'Industrial'],
            ['code' => 'L', 'name' => 'Liability'],
            ['code' => 'O', 'name' => 'Other']
        ];

        foreach ($insurancePolicyTypes as $type) {
            InsurancePolicyType::updateOrCreate($type, $type);
        }
    }
}

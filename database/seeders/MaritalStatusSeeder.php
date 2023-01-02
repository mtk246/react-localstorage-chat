<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaritalStatus;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maritalStatus = [
            ['name' => 'Single'],
            ['name' => 'Married']
        ];

        foreach ($maritalStatus as $name) {
            MaritalStatus::updateOrCreate($name, $name);
        }
    }
}

<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Seeder;

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
            ['name' => 'Married'],
        ];

        foreach ($maritalStatus as $name) {
            MaritalStatus::updateOrCreate($name, $name);
        }
    }
}

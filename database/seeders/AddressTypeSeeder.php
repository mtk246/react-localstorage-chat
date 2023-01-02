<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AddressType;

class AddressTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addressTypes = [
            ['name' => 'Work'],
            ['name' => 'House / Residence'],
            ['name' => 'Other']
        ];

        foreach ($addressTypes as $name) {
            AddressType::updateOrCreate($name, $name);
        }
    }
}

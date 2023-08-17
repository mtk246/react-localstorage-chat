<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\AddressType;
use Illuminate\Database\Seeder;

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
            ['name' => 'Other'],
        ];

        foreach ($addressTypes as $name) {
            AddressType::updateOrCreate($name, $name);
        }
    }
}

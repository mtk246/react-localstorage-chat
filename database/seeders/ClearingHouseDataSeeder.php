<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TransmissionFormat;

class ClearingHouseDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transmissionFormats = [
            ['name' => 'ANSI X12'],
            ['name' => 'JSON'],
        ];

        foreach ($transmissionFormats as $format) {
            TransmissionFormat::updateOrCreate($format, $format);
        }
    }
}

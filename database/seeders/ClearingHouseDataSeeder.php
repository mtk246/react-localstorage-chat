<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\TransmissionFormat;
use Illuminate\Database\Seeder;

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

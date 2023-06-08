<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Diagnosis;
use Illuminate\Database\Seeder;

class DiagnosisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(json_decode(\File::get('database/data/Diagnoses.json')))
            ->map(function ($diagnosis) {
                $diagnosis->start_date = '2023-01-1';
                $diagnosis->end_date = null;
                $diagnosis->active = true;

                return (array) $diagnosis;
            })
            ->chunk(1000)
            ->each(fn ($chunk) => Diagnosis::upsert($chunk->toArray(), ['code']));
    }
}

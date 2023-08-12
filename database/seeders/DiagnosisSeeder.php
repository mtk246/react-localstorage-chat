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
                $diagnosis->end_date = null;
                $diagnosis->active = true;
                $diagnosis->clasifications = json_encode($diagnosis->clasifications);

                return (array) $diagnosis;
            })
            ->chunk(1000)
            ->each(fn ($chunk) => Diagnosis::upsert($chunk->toArray(), ['code']));
    }
}

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
        collect(\File::allFiles('database/data/diagnoses'))
            ->each(function ($file) {
                collect(json_decode($file->getContents()))
                    ->map(function ($diagnosis) {
                        $diagnosis->end_date = null;
                        $diagnosis->active = true;
                        $diagnosis->clasifications = json_encode($diagnosis->clasifications);
                        $diagnosis->protected = true;

                        return (array) $diagnosis;
                    })
                    ->chunk(1000)
                    ->each(fn ($chunk) => Diagnosis::upsert($chunk->toArray(), ['code']));
            });
    }
}

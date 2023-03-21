<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Procedure;
use Illuminate\Database\Seeder;

final class ProcedureSeeder extends Seeder
{
    public function run(): void
    {
        collect(json_decode(\File::get('database/data/Procedures.json')))
            ->map(function ($procedure) {
                $procedure->start_date = '2023-01-1';
                $procedure->end_date = null;
                $procedure->active = true;

                return (array) $procedure;
            })
            ->chunk(1000)
            ->each(fn ($chunk) => Procedure::upsert($chunk->toArray(), ['code']));
    }
}

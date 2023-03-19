<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Procedure;
use Illuminate\Database\Seeder;

final class ProcedureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procedures = collect(array_map(
            function ($procedure) {
                $procedure->start_date = '2023-01-1';
                $procedure->end_date = null;
                $procedure->active = true;

                return (array) $procedure;
            },
            json_decode(\File::get('database/data/Procedures.json')),
        ));

        $procedures->chunk(1000)->each(function ($chunk) {
            Procedure::upsert($chunk->toArray(), ['code']);
        });
    }
}

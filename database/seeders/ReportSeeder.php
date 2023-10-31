<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Reports\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

final class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect(json_decode(\File::get('database/data/BaseReports.json')))
            ->map(function (object $report) {
                $report->id = $report->id ?? Str::ulid();
                $report->configuration = json_encode($report->configuration);

                return (array) $report;
            })
            ->chunk(1000)
        ->each(fn ($chunk) => Report::upsert($chunk->toArray(), ['id']));
    }
}

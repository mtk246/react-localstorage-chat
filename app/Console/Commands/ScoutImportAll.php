<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;

final class ScoutImportAll extends Command
{
    /** @var string */
    protected $signature = 'scout:import-all {--m|meili-earch : Use MeiliSearch}';

    /** @var string */
    protected $description = 'import all models to search engine';

    public function handle(): int
    {
        $modelList = $this->option('meili-earch') ? $this->importMeiliSearch() : $this->importConfig();

        $this->newLine(1);
        $this->info(">> Importing {$modelList->first()}...");
        $this->withProgressBar($modelList, function ($model) {
            $this->newLine(2);
            $this->call('scout:import', ['model' => $model]);
            $this->newLine(2);
            $this->info(">> Importing {$model}...");
        });
        $this->newLine(2);

        $this->info('Sucefully imported all models to search engine!');

        return Command::SUCCESS;
    }

    public function importMeiliSearch(): Collection
    {
        return collect(config('scout.meilisearch.index-settings'))
            ->map(fn ($index, $key) => $key);
    }

    public function importConfig(): Collection
    {
        return collect(config('scout.index'));
    }
}

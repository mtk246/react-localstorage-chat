<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Modifier;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ChangeStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'status:change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the status of the modules when they reach their expiration date';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $modifiersQuery = Modifier::query()
            ->whereNot('end_date')
            ->where('end_date', '<=', now())
            ->where('active', true);

        Log::info("[schedule: status:change] Updating {$modifiersQuery->count()} modifiers");

        $modifiersQuery
            ->update([
                'active' => false,
            ]);

        return command::SUCCESS;
    }
}

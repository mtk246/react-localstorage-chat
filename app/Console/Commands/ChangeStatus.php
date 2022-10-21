<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Modifier;

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
        Modifier::whereNotNull('end_date')->where('end_date', '<=', now())->where('active', true)->update([
            'active' => false
        ]);
        return 0;
    }
}

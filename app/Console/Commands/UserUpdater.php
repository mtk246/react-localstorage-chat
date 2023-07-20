<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

final class UserUpdater extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /** Execute the console command. */
    public function handle(): int
    {
        $user = User::query()->with('billingCompanies')->where('billing_company_id', null)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Billing Manager');
            })
            ->get()
            ->each(function ($user) {
                $user->billing_company_id = $user->billingCompanies->first()?->id ?? 1;
                $user->save();
            });

        dump($user->count());

        return Command::SUCCESS;
    }
}

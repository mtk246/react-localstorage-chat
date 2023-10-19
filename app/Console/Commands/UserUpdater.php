<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\User\UserType;
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
        $user = User::all()
            ->load(['billingCompanies'])
            ->each(function (User $user) {
                if (UserType::ADMIN->value !== $user->type->value && is_null($user->billing_company_id)) {
                    $billingCompanyId = $user->billingCompanies?->first()?->id;

                    if (is_null($billingCompanyId)) {
                        $user->type = UserType::ADMIN;
                    }

                    $user->billing_company_id = $billingCompanyId;

                    $user->billingCompanies()->wherePivotNotIn('billing_company_id', $billingCompanyId)->detach();

                    $user->save();
                }
            });

        dump($user->count());

        return Command::SUCCESS;
    }
}

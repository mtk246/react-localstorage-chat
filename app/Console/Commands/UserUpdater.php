<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\Contact;
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
            ->each(function ($user) {
                Address::query()
                    ->where('addressable_id', $user->id)
                    ->where('addressable_type', 'App\Models\User')
                    ->update([
                        'addressable_id' => $user->profile->id,
                        'addressable_type' => 'App\Models\Profile',
                    ]);

                Contact::query()
                    ->where('contactable_id', $user->id)
                    ->where('contactable_type', 'App\Models\User')
                    ->update([
                        'contactable_id' => $user->profile->id,
                        'contactable_type' => 'App\Models\Profile',
                    ]);
            });

        dump($user->count());

        return Command::SUCCESS;
    }
}

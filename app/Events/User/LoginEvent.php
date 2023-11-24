<?php

declare(strict_types=1);

namespace App\Events\User;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

final class LoginEvent
{
    use Dispatchable;
    use SerializesModels;

    public readonly string $password;

    public function __construct(public readonly User $user, string $password)
    {
        Log::info(sprintf('User %s Login', $this->user->email));
        $this->password = Crypt::encryptString($password);
    }
}

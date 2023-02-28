<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class UserPolicy
{
    use HandlesAuthorization;

    /** Determine whether the user can perform super user actions. */
    public function super(User $user): bool
    {
        return $user->hasRole('superuser');
    }
}

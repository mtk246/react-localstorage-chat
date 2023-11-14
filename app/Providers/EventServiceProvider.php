<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\User\ChangePassword;
use App\Events\User\LoginEvent as LoginUserEvent;
use App\Events\User\StoreEvent as StoreUserEvent;
use App\Events\User\UpdateEvent as UpdateUserEvent;
use App\Events\User\UpdatePasswordEvent;
use App\Listeners\Notifications\User\SendChangePasswordNotification;
use App\Listeners\RocketChat\CreateUserListener as CreateRocketChatUserListener;
use App\Listeners\RocketChat\LoginUserListener as LoginRokectChatUserListener;
use App\Listeners\RocketChat\UpdateUserListener as UpdateRokectChatUserListener;
use App\Listeners\RocketChat\UpdateUserPasswordListener;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ChangePassword::class => [
            SendChangePasswordNotification::class,
        ],
        StoreUserEvent::class => [
            CreateRocketChatUserListener::class,
        ],
        UpdateUserEvent::class => [
            UpdateRokectChatUserListener::class,
        ],
        LoginUserEvent::class => [
            LoginRokectChatUserListener::class,
        ],
        UpdatePasswordEvent::class => [
            UpdateUserPasswordListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}

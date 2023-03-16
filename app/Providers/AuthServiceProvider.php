<?php

declare(strict_types=1);

namespace App\Providers;

use Detection\MobileDetect;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

final class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function register(): void
    {
        $request = app(Request::class);
        $this->app->singleton(MobileDetect::class, fn () => new MobileDetect(
            $request->header(),
            $request->header('User-Agent'),
        ));
    }

    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('is-admin', [\App\Policies\UserPolicy::class, 'super']);
        Gate::define('billingmanager', [\App\Policies\UserPolicy::class, 'billingmanager']);
    }
}

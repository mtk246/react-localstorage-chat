<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CompanyRepository;

class ActionsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(fn() => new CompanyRepository());
    }
}

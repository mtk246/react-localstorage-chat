<?php

namespace App\Providers;

use App\Actions\Company\AddServices;
use App\Repositories\CompanyRepository;
use Illuminate\Support\ServiceProvider;

class ActionsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(AddServices::class, fn() => new AddServices());
        $this->app->singleton(CompanyRepository::class, fn() => new CompanyRepository());
    }
}

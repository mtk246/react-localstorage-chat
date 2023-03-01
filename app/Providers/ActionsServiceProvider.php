<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\Company\AddCopays;
use App\Actions\Company\AddServices;
use App\Repositories\CompanyRepository;
use Illuminate\Support\ServiceProvider;

final class ActionsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(AddServices::class, fn () => new AddServices());
        $this->app->singleton(CompanyRepository::class, fn () => new CompanyRepository());
        $this->app->singleton(AddCopays::class, fn () => new AddCopays());
    }
}

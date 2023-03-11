<?php

declare(strict_types=1);

namespace App\Providers;

use App\Actions\BillingCompany\GetKeyboardShortcut;
use App\Actions\BillingCompany\StoreKeyboardShortcut;
use App\Actions\Company\AddContractFees;
use App\Actions\Company\AddCopays;
use App\Actions\Company\AddServices;
use App\Actions\Company\GetCompany;
use App\Repositories\CompanyRepository;
use Illuminate\Support\ServiceProvider;

final class ActionsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->singleton(AddServices::class, fn () => new AddServices());
        $this->app->singleton(CompanyRepository::class, fn () => new CompanyRepository());
        $this->app->singleton(AddCopays::class, fn () => new AddCopays());
        $this->app->singleton(AddContractFees::class, fn () => new AddContractFees());
        $this->app->singleton(GetCompany::class, fn () => new GetCompany());
        $this->app->singleton(GetKeyboardShortcut::class, fn () => new GetKeyboardShortcut());
        $this->app->singleton(StoreKeyboardShortcut::class, fn () => new StoreKeyboardShortcut());
    }
}

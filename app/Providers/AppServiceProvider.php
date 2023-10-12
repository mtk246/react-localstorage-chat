<?php

declare(strict_types=1);

namespace App\Providers;

use Elibyy\TCPDF\TCPDF as PDF;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);

        if ($this->app->environment(['local'])) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->singleton(PDF::class, function ($app) {
            return new PDF(config('app.name'));
        });

        Str::macro('onlyNumbers', function (string $str) {
            return preg_replace('/[^0-9]/', '', $str);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}

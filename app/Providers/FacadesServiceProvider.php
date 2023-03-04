<?php

declare(strict_types=1);

namespace App\Providers;

use App\Facades\Pagination;
use Illuminate\Support\ServiceProvider;

final class FacadesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind('Pagination', fn () => new Pagination());
    }
}

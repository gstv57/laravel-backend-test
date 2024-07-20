<?php

namespace App\Providers;

use App\Contracts\{ClienteContract, ProdutoContract};
use App\Repository\{ClienteRepository, ProdutoRepository};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ClienteContract::class, ClienteRepository::class);
        $this->app->bind(ProdutoContract::class, ProdutoRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

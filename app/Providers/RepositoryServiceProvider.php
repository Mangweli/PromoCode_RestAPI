<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\PromoCodeRepositoryInterface;
use App\Repositories\PromoCodeRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PromoCodeRepositoryInterface::class, PromoCodeRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

<?php

namespace App\Providers;

use App\Repositories\Api\LotRepository;
use App\Repositories\Interfaces\LotRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LotRepositoryInterface::class, LotRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

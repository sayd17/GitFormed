<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\RepositoryRepositoryInterface;
use App\Repositories\RepositoryRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(RepositoryRepositoryInterface::class, RepositoryRepository::class);
    }
}

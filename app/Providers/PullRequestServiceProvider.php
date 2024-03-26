<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\PullRequestRepositoryInterface;
use App\Repositories\PullRequestRepository;

class PullRequestServiceProvider extends ServiceProvider
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
        $this->app->bind(PullRequestRepositoryInterface::class, PullRequestRepository::class);
    }
}

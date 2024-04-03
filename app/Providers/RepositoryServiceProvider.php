<?php

namespace App\Providers;

use App\Interfaces\AreaGroupRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\AreaGroupRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(AreaGroupRepositoryInterface::class,AreaGroupRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

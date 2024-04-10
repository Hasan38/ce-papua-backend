<?php

namespace App\Providers;

use App\Interfaces\AreaGroupRepositoryInterface;
use App\Interfaces\CustomerRepositoryInterface;
use App\Interfaces\MachineRepositoryInterface;
use App\Interfaces\RegionalRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\DashboardRepositoryInterface;
use App\Repositories\AreaGroupRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\MachineRepository;
use App\Repositories\RegionalRepository;
use App\Repositories\UserRepository;
use App\Repositories\DashboardRepository;
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
        $this->app->bind(RegionalRepositoryInterface::class,RegionalRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class,CustomerRepository::class);
        $this->app->bind(MachineRepositoryInterface::class,MachineRepository::class);
        $this->app->bind(DashboardRepositoryInterface::class,DashboardRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\SettingRepositoryInterface;
use App\Repositories\SettingRepository;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\EmployeeRepository;
use App\Interfaces\OvertimeRepositoryInterface;
use App\Repositories\OvertimeRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(OvertimeRepositoryInterface::class, OvertimeRepository::class);
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

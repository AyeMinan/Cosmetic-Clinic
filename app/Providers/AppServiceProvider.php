<?php

namespace App\Providers;

use App\Interfaces\TimeInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\VacationInterface;
use App\Repositories\TimeRepository;
use App\Repositories\UserRepository;
use App\Repositories\VacationRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(VacationInterface::class, VacationRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(TimeInterface::class, TimeRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

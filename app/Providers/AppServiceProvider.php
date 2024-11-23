<?php

namespace App\Providers;

use App\Repository\Eloquent\UserRepository;
use App\Repository\UserInterfaceRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(UserInterfaceRepository::class, UserRepository::class);
    }
}

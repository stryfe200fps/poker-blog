<?php

namespace App\Providers;

use App\Http\Controllers\Auth\LoginController;
use Dymantic\InstagramFeed\Instagram;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

        $this->app->bind(\Backpack\CRUD\app\Http\Controllers\Auth\LoginController::class, LoginController::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Instagram::ignoreRoutes();
    }
}

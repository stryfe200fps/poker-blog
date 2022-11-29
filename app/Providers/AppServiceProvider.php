<?php

namespace App\Providers;

use Laravel\Telescope\Telescope;
use Dymantic\InstagramFeed\Instagram;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SettingCrudController;
use App\Http\Controllers\Admin\PageCrudController;
use App\Http\Controllers\Admin\RoleCrudController;
use App\Http\Controllers\Admin\MenuItemCrudController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Telescope::ignoreMigrations();
        $this->app->bind(\Backpack\CRUD\app\Http\Controllers\Auth\LoginController::class, LoginController::class);
        $this->app->bind(\Backpack\PageManager\app\Http\Controllers\Admin\PageCrudController::class, PageCrudController::class);
        $this->app->bind(\Backpack\MenuCRUD\app\Http\Controllers\Admin\MenuItemCrudController::class, MenuItemCrudController::class);
        $this->app->bind(\Backpack\PermissionManager\app\Http\Controllers\RoleCrudController::class, RoleCrudController::class);
        $this->app->bind(\Backpack\Settings\app\Http\Controllers\SettingCrudController::class, SettingCrudController::class);

        // if ($this->app->environment('local')) { 
        //     $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        //     $this->app->register(TelescopeServiceProvider::class);
        // }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Model::preventLazyLoading(! app()->isProduction());
        // Instagram::ignoreRoutes();
    }
}

<?php

namespace App\Providers;

use Dymantic\InstagramFeed\Instagram;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Auth\LoginController;
<<<<<<< HEAD
use App\Http\Controllers\SettingCrudController;
=======
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
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
<<<<<<< HEAD
        $this->app->bind(\Backpack\CRUD\app\Http\Controllers\Auth\LoginController::class, LoginController::class);
        $this->app->bind(\Backpack\PageManager\app\Http\Controllers\Admin\PageCrudController::class, PageCrudController::class);
        $this->app->bind(\Backpack\MenuCRUD\app\Http\Controllers\Admin\MenuItemCrudController::class, MenuItemCrudController::class);
        $this->app->bind(\Backpack\PermissionManager\app\Http\Controllers\RoleCrudController::class, RoleCrudController::class);
        $this->app->bind(\Backpack\Settings\app\Http\Controllers\SettingCrudController::class, SettingCrudController::class);
=======
        //

        $this->app->bind(\Backpack\CRUD\app\Http\Controllers\Auth\LoginController::class, LoginController::class);
        $this->app->bind(\Backpack\PageManager\app\Http\Controllers\Admin\PageCrudController::class, PageCrudController::class);

        $this->app->bind(\Backpack\MenuCRUD\app\Http\Controllers\Admin\MenuItemCrudController::class, MenuItemCrudController::class);
        $this->app->bind(\Backpack\PermissionManager\app\Http\Controllers\RoleCrudController::class, RoleCrudController::class);
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
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

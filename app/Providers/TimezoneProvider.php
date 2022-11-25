<?php

namespace App\Providers;

use App\Helpers\Timezone;
use Illuminate\Support\ServiceProvider;

class TimezoneProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('timezone', function () {
            return new Timezone();
        });
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

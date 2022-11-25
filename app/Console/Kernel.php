<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('update:tweets')->everyTenMinutes();
<<<<<<< HEAD
=======
        $schedule->command('update:instagram')->days(3);
        // $schedule->command('update:tweets')->everyMinute();
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
        $schedule->command('instagram-feed:refresh-token')->monthly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

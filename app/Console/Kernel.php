<?php

namespace App\Console;

use App\Console\Commands\CallForecastApi;
use App\Console\Commands\ResultCron;
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
        $schedule->command(CallForecastApi::class)->cron('10 0 * * *');
        $schedule->command(ResultCron::class)
        ->everyThirtyMinutes(); 
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {  
            Commands\CallForecastApi::class;
            Commands\ResultCron::class;

        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

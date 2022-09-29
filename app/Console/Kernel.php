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
        $schedule->command('rent:cron')->everyMinute()->sendOutputTo(Storage_path('/logs/rent.log'));

        $schedule->command('queue:restart')
                ->everyFiveMinutes()
                ->withoutOverlapping()
                ->emailOutputOnFailure('codejutsu@protonmail.com')
                ->runInBackground();
        

        $schedule->command('queue:work --max-time=60')
                ->everyMinute()
                ->withoutOverlapping()
                ->emailOutputOnFailure('codejutsu@protonmail.com')
                ->sendOutputTo(storage_path('/logs/queue-jobs.log'))
                ->runInBackground();  
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

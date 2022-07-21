<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->command('validasi:reservasi')->everyMinute();
        $schedule->command('reminder:tangkil')->everyMinute();
        $schedule->command('reminder:muput')->everyMinute();
        $schedule->command('calculation:ranting')->everyMinute();
        $schedule->command('make:reminder')->everyMinute();
        $schedule->command('make:reminder')->dailyAt('05:00');
        $schedule->command('validasi:reservasi')->dailyAt('05:00');
        $schedule->command('reminder:tangkil')->dailyAt('05:00');
        $schedule->command('reminder:muput')->dailyAt('05:00');
        $schedule->command('calculation:ranting')->everyThreeMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

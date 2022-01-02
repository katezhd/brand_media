<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // \App\Console\Commands\ImportCurrency::class,
        // \App\Console\Commands\ImportHoroscope::class,
        // \App\Console\Commands\ImportWeather::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('activitylog:clean')->monthly();
        $schedule->command('import:horoscope')->daily();
        $schedule->command('import:currency')->hourly();
        $schedule->command('import:weather')->hourly();
        // $schedule->command('import:quote', [20])->everyMinute();
        $schedule->command('import:joke', [20])->everyMinute();
        $schedule->command('generate:sitemap')->everyThirtyMinutes();
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

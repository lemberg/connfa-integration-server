<?php

namespace App\Console;

use App\Console\Commands\ChangePassword;
use App\Console\Commands\EmulateEventsUpdates;
use App\Console\Commands\SeedEvents;
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
        ChangePassword::class,
        SeedEvents::class,
        EmulateEventsUpdates::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

    }
}

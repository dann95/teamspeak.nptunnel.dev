<?php

namespace NpTS\Console;

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
        \NpTS\Domain\Bot\Commands\UpdateCharactersOnline::class,
        \NpTS\Domain\Bot\Commands\UpdateVserversLists::class,
        \NpTS\Domain\Bot\Commands\UpdateDeaths::class,
        \NpTS\Domain\Bot\Commands\R2d2::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // using cron tab...
    }
}

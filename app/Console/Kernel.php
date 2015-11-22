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
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('r2d2:updateCharactersOnline')
            ->everyMinute();

        $schedule->command('r2d2:updateLists')
            ->everyMinute();

        $schedule->command('r2d2:updateDeaths')
            ->everyMinute();
    }
}

<?php

namespace NpTS\Domain\Bot\Commands;

use Illuminate\Console\Command;

class R2d2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'r2d2:bot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Try Connect in all teamspeaks for wait for commands.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}

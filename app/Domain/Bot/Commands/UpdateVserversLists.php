<?php

namespace NpTS\Domain\Bot\Commands;

use Illuminate\Console\Command;

class UpdateVserversLists extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'r2d2:updateLists';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Log in into every vserver and set the enemy list & friend list.';

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

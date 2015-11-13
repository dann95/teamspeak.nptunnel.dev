<?php

namespace NpTS\Domain\Bot\Commands;

use NpTS\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateCharacters extends Command implements SelfHandling
{
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}

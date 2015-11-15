<?php

namespace NpTS\Domain\Bot\Commands;

use Illuminate\Console\Command;
use NpTS\Domain\Bot\Models\TsBot;

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

    private $model;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TsBot $model)
    {
        parent::__construct();
        $this->model = $model;

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $bots = $this->model->all();

        $bots->each(function($bot){
            if($bot->tibia_list)
            {
                Queue::push(new \NpTS\Domain\Bot\Jobs\UpdateVserverList($bot->vserver , $bot->tibiaList , $bot->vserver->server()));
            }
        });

    }
}

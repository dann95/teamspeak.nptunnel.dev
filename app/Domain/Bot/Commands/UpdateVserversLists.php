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
                $ts = (new \NpTS\Domain\TeamSpeak\Manager($bot->vserver->server()->credentials))->selectServer($bot->vserver->v_sid);
                //Enemy List:
                $ts->channelGetById($bot->tibiaList->enemy_ch_id)
                    ->modify([
                        'channel_description'   => view('Bot.List.enemy' , ['chars' => $bot->tibiaList->onlineEnemies()]),
                        'channel_name'          => '[cspacer'.mt_rand(1,9999).'] '.'Enemy List ('.count($bot->tibiaList->onlineEnemies()).')',
                    ]);

                //Friend List:
                $ts->channelGetById($bot->tibiaList->friend_ch_id)
                    ->modify([
                        'channel_description'   => view('Bot.List.friend' , ['chars' => $bot->tibiaList->onlineFriends()]),
                        'channel_name'          => '[cspacer'.mt_rand(1,9999).'] '.'Friend List ('.count($bot->tibiaList->onlineFriends()).')',
                    ]);
            }
        });

    }
}

<?php

namespace NpTS\Domain\Bot\Commands;

use Illuminate\Console\Command;

use NpTS\Domain\Bot\Models\World;
use NpTS\Domain\Bot\Crawlers\Character;
use NpTS\Domain\TeamSpeak\Manager;
use NpTS\Domain\Bot\Models\Vocation;


class UpdateDeaths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'r2d2:updateDeaths';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Search for deaths of the characters.. also update the vocation, if it is wrong.';

    private $worldModel;
    private $vocationModel;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->worldModel = app(World::class);
        $this->vocationModel = app(Vocation::class);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $worlds = $this->worldModel->all();
        $vocations = $this->vocationModel->all()->lists('id','name');
        $worlds->each(function($world) use($vocations){
            if(count($world->onlineCharacters()))
            {
                $world->onlineCharacters()->each(function($char) use($vocations){
                    $crawler = new Character();
                    $crawler->select($char->name);

                    // Update Vocations:
                    if(($crawler->exists()) && ($char->vocation_id != $vocations[$crawler->attributes()['vocation']]))
                    {
                        $char->vocation_id = $vocations[$crawler->attributes()['vocation']];
                        $char->save();
                    }

                    if(($crawler->exists()) && ($char->last_death != $crawler->attributes()['last_death']))
                    {
                        $char->last_death = $crawler->attributes()['last_death'];
                        $char->save();

                        if(($char->last_death != '') && ($char->position == 0))
                        {
                            $vserver = $char->tibiaList->tsBot->vserver;
                            $credentials = $vserver->server()->credentials;
                            $credentials['nick'] = $char->world->name;
                            $manager = new Manager($credentials);
                            try
                            {
                                $msg = "Enemy: ".$char->name." died";
                                $ts = $manager->selectServer($vserver->v_sid);
                                foreach($ts->clientList() as $client)
                                {
                                    $client->poke($msg);
                                }
                            }catch (Ts3Exception $e)
                            {
                                //...
                            }
                        }

                    }
                });
            }
        });
    }
}

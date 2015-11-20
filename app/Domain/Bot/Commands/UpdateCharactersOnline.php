<?php

namespace NpTS\Domain\Bot\Commands;

use Illuminate\Console\Command;
use NpTS\Domain\Bot\Models\World;
use NpTS\Domain\Bot\Crawlers\World as WorldCrawler;
use NpTS\Domain\TeamSpeak\Manager;
use TeamSpeak3\Ts3Exception;

class UpdateCharactersOnline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'r2d2:updateCharactersOnline';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all character status (online/offline) and the actual level.';

    private $woldModel;
    private $worldCrawler;
    public function __construct()
    {
        parent::__construct();
        $this->woldModel = app(World::class);
        $this->worldCrawler = app(WorldCrawler::class);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $servers = $this->woldModel->all();
        $servers->each(function($world){
           $chars = $world->characters;
           $onlineChars = $this->worldCrawler
               ->select($world->name)
               ->online();
           $chars->each(function($char) use($onlineChars){
               $status = (in_array($char->name , array_keys($onlineChars))) ? 1 : 0;

               if($char->online != $status)
               {
                   $char->online = $status;
                   $char->online_since = new \DateTime();
                   $char->save();
               }
               if(($char->online) && ($char->lvl != $onlineChars[$char->name]))
               {

                   if(($char->position == 0) && ($onlineChars[$char->name] > $char->lvl))
                   {
                       $vserver = $char->tibiaList->tsBot->vserver;
                       $credentials = $vserver->sever()->credentials;
                       $credentials['nick'] = $char->world->name;
                       $manager = new Manager($credentials);
                       try
                       {
                           $ts = $manager->selectServer($vserver->v_sid);
                           foreach($ts->clientList() as $client)
                           {
                               $client->poke("Enemy ".$char->name." got ".$onlineChars[$char->name]-$char-lvl." lvls");
                           }
                       }catch (Ts3Exception $e)
                       {
                           //...
                       }
                   }
                   $char->lvl = $onlineChars[$char->name];
                   $char->save();
               }

           });
            usleep(100);
        });
    }
}

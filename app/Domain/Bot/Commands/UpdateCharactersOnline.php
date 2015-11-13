<?php

namespace NpTS\Domain\Bot\Commands;

use Illuminate\Console\Command;
use NpTS\Domain\Bot\Models\World;
use NpTS\Domain\Bot\Crawlers\World as WorldCrawler;

class UpdateCharactersOnline extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'r2d2:updateCharacters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all character status (online/offline) and the actual name.';

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
               $status = (in_array($char->name , $onlineChars)) ? 1 : 0;
               $char->online = $status;
               $char->save();
           });
        });
    }
}

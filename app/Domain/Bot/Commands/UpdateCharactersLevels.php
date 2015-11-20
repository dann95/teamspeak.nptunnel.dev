<?php

namespace NpTS\Domain\Bot\Commands;

use Illuminate\Console\Command;
use NpTS\Domain\Bot\Crawlers\World;
use NpTS\Domain\Bot\Models\World as WorldModel;

class UpdateCharactersLevels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'r2d2:updateCharactersLevel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update each character online level.';

    private $worldCrawler;
    private $worldModel;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->worldCrawler = app(World::class);
        $this->worldModel = app(WorldModel::class);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $worlds = $this->worldModel->all();
        $worlds->each(function($world){
            $crawler = $this->worldCrawler->select($world->name);
            $world->onlineCharacters()->each(function($char) use($crawler){
                $lvl = $crawler->getLevelByName($char->name);

                if($char->lvl != $lvl)
                {
                    //TODO: alert on teamspeak that char has difference of lvl.
                    $char->lvl = $lvl;
                    $char->save();
                }

            });
        });
    }
}

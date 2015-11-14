<?php

namespace NpTS\Domain\Bot\Service;

use NpTS\Domain\Bot\Crawlers\Guild as GuildCrawler;
use NpTS\Domain\Bot\Models\TibiaList;
use NpTS\Domain\Bot\Service\Exceptions\CharacterAlreadyInThisList;
use NpTS\Domain\Bot\Service\Exceptions\CharacterDosntExists;
use NpTS\Domain\Bot\Service\Exceptions\GuildDosntExists;
use NpTS\Domain\Bot\Service\Character;


class Guild
{
    private $crawler;

    public function __construct()
    {
        $this->crawler = app(GuildCrawler::class);
        $this->characterCrawler = app(Character::class);
    }

    public function insert(TibiaList $list , $name , $position)
    {
        $this->crawler->select($name);

        if ($this->crawler->exists())
            throw new GuildDosntExists;

        $chars = collect($this->crawler->characters());

        $chars->each(function($char) use($list , $position){
            try{
                $this->characterCrawler->insert($list, $char , $position);
                usleep(100);
            }catch (CharacterAlreadyInThisList $e)
            {

            }catch(CharacterDosntExists $e)
            {

            }
        });
    }
}
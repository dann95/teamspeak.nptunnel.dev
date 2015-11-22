<?php

namespace NpTS\Domain\Bot\Service;

use Illuminate\Support\Facades\Queue;
use NpTS\Domain\Bot\Crawlers\Guild as GuildCrawler;
use NpTS\Domain\Bot\Models\TibiaList;
use NpTS\Domain\Bot\Service\Exceptions\CharacterAlreadyInThisList;
use NpTS\Domain\Bot\Service\Exceptions\CharacterDosntExists;
use NpTS\Domain\Bot\Service\Exceptions\GuildAlreadyInThisList;
use NpTS\Domain\Bot\Service\Exceptions\GuildDosntExists;


class Guild
{
    private $crawler;

    public function __construct()
    {
        $this->crawler = app(GuildCrawler::class);
    }

    public function insert(TibiaList $list , $name , $position)
    {
        $this->crawler->select($name);

        if ($this->crawler->exists())
            throw new GuildDosntExists;

        if (count($list->guilds()->where(['name' => $name])->get()))
            throw new GuildAlreadyInThisList;

        $chars = collect($this->crawler->characters());

        $chars->each(function($char) use($list , $position){
            Queue::push(new \NpTS\Domain\Bot\Jobs\AddCharacter($list , $char , $position));
        });
        $list->guilds()->create([
            'name' => $name,
            'position' => $position
        ]);
    }
}
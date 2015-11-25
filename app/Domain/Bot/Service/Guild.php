<?php

namespace NpTS\Domain\Bot\Service;

use Illuminate\Support\Facades\Queue;
use NpTS\Domain\Bot\Crawlers\Guild as GuildCrawler;
use NpTS\Domain\Bot\Models\TibiaList;
use NpTS\Domain\Bot\Service\Exceptions\CharacterAlreadyInThisList;
use NpTS\Domain\Bot\Service\Exceptions\CharacterDosntExists;
use NpTS\Domain\Bot\Service\Exceptions\GuildAlreadyInThisList;
use NpTS\Domain\Bot\Service\Exceptions\GuildDosntExists;
use NpTS\Domain\Bot\Models\Guild as GuildModel;


class Guild
{
    private $crawler;
    private $guildModel;
    public function __construct()
    {
        $this->crawler = app(GuildCrawler::class);
        $this->guildModel = app(GuildModel::class);
    }

    public function insert(TibiaList $list , $name , $position)
    {
        $this->crawler->select($name);

        if (! $this->crawler->exists())
            throw new GuildDosntExists;

        if (count($this->guildModel->where(['name' => $name , 'tibia_list_id' => $list->id])->get()))
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

    public function remove(GuildModel $guild)
    {
        $crawler = $this->crawler->select($guild->name);
        if(! ($crawler->exists()))
            return $guild->delete();

        $chars = $crawler->characters();

        $guild->tibiaList
            ->characters
            ->filter(function($char) use($chars){
                return in_array($char->name , $chars);
            })
            ->each(function($char){
            $char->delete();
        });
        return $guild->delete();
    }
}
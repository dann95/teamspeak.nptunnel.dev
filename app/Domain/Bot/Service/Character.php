<?php

namespace NpTS\Domain\Bot\Service;

use NpTS\Domain\Bot\Crawlers\Character as CharacterCrawler;
use NpTS\Domain\Bot\Models\World;
use NpTS\Domain\Bot\Models\Vocation;
use NpTS\Domain\Bot\Models\TibiaList;
use NpTS\Domain\Bot\Service\Exceptions\CharacterDosntExists;
use NpTS\Domain\Bot\Service\Exceptions\CharacterAlreadyInThisList;
use NpTS\Domain\Bot\Models\Character as CharacterModel;

class Character
{
    private $worldModel;
    private $vocationModel;
    private $crawler;
    private $characterModel;
    public function __construct()
    {
        $this->worldModel = app(World::class);
        $this->vocationModel = app(Vocation::class);
        $this->crawler = app(CharacterCrawler::class);
        $this->characterModel = app(CharacterModel::class);
    }

    public function insert(TibiaList $list , $name , $position)
    {
        // select the caracter on the crawler
        $this->crawler->select($name);

        // Does the caracter exists?
        if(! $this->crawler->exists())
            throw new CharacterDosntExists;

        // Get attributes:
        $char = $this->crawler->attributes();

        // Does the char is already in the list?
        if(count($this->characterModel->where([
            'tibia_list_id' => $list->id,
            'name' => $char['name']])->get()
        ))
            throw new CharacterAlreadyInThisList;

        // Insert the character:
        $list->characters()->create([
            'position'      => $position,
            'online'        => 0,
            'vocation_id'   => $this->getVocations()[$char['vocation']],
            'world_id'      => $this->getWorlds()[$char['world']],
            'lvl'           => $char['level'],
            'register_lvl'  => $char['level'],
            'name'          => $char['name'],
            'last_death'    => $char['last_death'],
        ]);

    }

    public function delete()
    {

    }

    public function changePosition()
    {

    }


    private function getWorlds()
    {
        return $this->worldModel->all()->lists('id','name');
    }

    private function getVocations()
    {
        return $this->vocationModel->all()->lists('id','name');
    }
}
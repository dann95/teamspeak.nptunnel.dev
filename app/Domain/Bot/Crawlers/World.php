<?php

namespace NpTS\Domain\Bot\Crawlers;

use NpTS\Abstracts\Bot\Crawlers\AbstractTibiaCrawler;

class World extends AbstractTibiaCrawler
{
    private $name;
    const baseUrl = 'https://secure.tibia.com/community/?subtopic=worlds&world=';
    public function select($name)
    {
        $this->name = $name;
        return $this;
    }

    public function extractOnline($html)
    {
        $online = $this->arrayDataByKnowTags('<a href="https://secure.tibia.com/community/?subtopic=characters&name=' , '" >' , $html);
        return $online;
    }

    public function online()
    {
        $html = $this->getHtml(self::baseUrl.$this->name);
        $chars = array_map(array($this , 'decodeName') ,$this->extractOnline($html));
        return $chars;
    }
}
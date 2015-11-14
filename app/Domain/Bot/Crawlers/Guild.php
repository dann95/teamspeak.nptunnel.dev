<?php

namespace NpTS\Domain\Bot\Crawlers;

use NpTS\Abstracts\Bot\Crawlers\AbstractTibiaCrawler;

class Guild extends AbstractTibiaCrawler
{
    const baseUrl = 'https://secure.tibia.com/community/?subtopic=guilds&page=view&GuildName=';
    private $name;

    /**
     * Choose what guild you want to withdraw data..
     * @param $name
     * @return $this
     */
    public function select($name)
    {
        $this->name = $this->encodeName($name);
        return $this;
    }

    public function exists()
    {
        $html = $this->getHtml(self::baseUrl.$this->name);
        $expExists = explode('<td>An internal error has occurred. Please try again later!</td>' , $html);
        return (count($expExists) > 1) ? TRUE : FALSE;
    }

    private function extractCharacters($html)
    {
        // <A HREF="https://secure.tibia.com/community/?subtopic=characters&name=Tanksz+Bellator">Tanksz&#160;Bellator</A>
        return $this->arrayDataByKnowTags('HREF="https://secure.tibia.com/community/?subtopic=characters&name=' , '">' , $html);
    }

    public function characters()
    {
        $html = $this->getHtml(self::baseUrl.$this->name);
        $characters = array_map(array($this , 'decodeName') ,$this->extractCharacters($html));
        return $characters;
    }
}
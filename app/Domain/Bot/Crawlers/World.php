<?php

namespace NpTS\Domain\Bot\Crawlers;

use NpTS\Abstracts\Bot\Crawlers\AbstractTibiaCrawler;

class World extends AbstractTibiaCrawler
{
    private $name;
    private $html;
    const baseUrl = 'https://secure.tibia.com/community/?subtopic=worlds&world=';
    public function select($name)
    {
        $this->name = $name;
        $this->html = $this->getHtml(self::baseUrl.$this->name);
        return $this;
    }

    public function extractOnline($html)
    {
        $online = $this->arrayDataByKnowTags('<a href="https://secure.tibia.com/community/?subtopic=characters&name=' , '" >' , $html);
        return $online;
    }

    public function online()
    {
        $html = $this->html;
        $chars = array_map(array($this , 'decodeName') ,$this->extractOnline($html));
        return $chars;
    }

    public function getLevelByName($name)
    {
        //href="https://secure.tibia.com/community/?subtopic=characters&name=Oxydrane" >Oxydrane</a></td><td style="width:10%;" >327</td>
        $name = str_replace(' ' , '&#160;',$name);
        $start = $name.'</a></td><td style="width:10%;" >';
        return $this->dataBetweenKnowTags($start , '</td>' , $this->html);
    }
}
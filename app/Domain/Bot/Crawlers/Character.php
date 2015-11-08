<?php

namespace NpTS\Domain\Bot\Crawlers;

use NpTS\Domain\Bot\Web\Grabber;

class Character
{

    private $grabber;
    private $name;
    const baseUrl = 'https://secure.tibia.com/community/?subtopic=characters&name=';

    public function __construct(Grabber $grabber)
    {
        $this->grabber = $grabber;
    }

    public function select($name)
    {
        $this->name = $this->encodeName($name);
        return $this;
    }

    public function encodeName($name)
    {
        $name = str_replace(' ' , '%20' , $name);
        $name = str_replace("'" , '%27' , $name);
        return $name;
    }

    public function getHtml($url)
    {
        return $this->grabber->grab($url);
    }

    private function extractName($html)
    {
        // Name:</td><td>Dann iel <div
        $name = explode('Name:</td><td>' , $html);
        $name = $name[1];
        $name = explode(' <div' , $name);
        $name = $name[0];
        return $name;
    }

    private function extractVocation($html)
    {
        // Vocation:</td><td>Elite Knight</td>
        $vocation = explode('Vocation:</td><td>' , $html);
        $vocation = $vocation[1];
        $vocation = explode('</td>',$vocation);
        $vocation = $vocation[0];
        return $vocation;
    }


    private function extractLevel($html)
    {
        // <td>Level:</td><td>429</td>
        $level = explode('Level:</td><td>' , $html);
        $level = $level[1];
        $level = explode('</td>' , $level);
        $level = $level[0];
        return $level;
    }

    private function extractResidence($html)
    {
        //<td>Residence:</td><td>Roshamuul</td>
        $residence = explode('Residence:</td><td>' , $html);
        $residence = $residence[1];
        $residence = explode('</td>' , $residence);
        $residence = $residence[0];
        return $residence;
    }

    public function attributes()
    {
        $html = $this->getHtml(self::baseUrl.$this->name);

        $attributes = [
            'name'          => $this->extractName($html),
            'vocation'      => $this->extractVocation($html),
            'level'         => $this->extractLevel($html),
            'residence'     => $this->extractResidence($html),
        ];

        dd($attributes);
        return $attributes;
    }

}
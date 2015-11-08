<?php

namespace NpTS\Domain\Bot\Crawlers;


use NpTS\Abstracts\Bot\Crawlers\AbstractTibiaCrawler;

class Character extends AbstractTibiaCrawler
{

    private $name;
    const baseUrl = 'https://secure.tibia.com/community/?subtopic=characters&name=';


    /**
     * Select a Character.
     * @param $name
     * @return $this
     */
    public function select($name)
    {
        $this->name = $this->encodeName($name);
        return $this;
    }

    /**
     * Get Character name..
     * @param $html
     * @return string
     */
    private function extractName($html)
    {
        // Name:</td><td>Dann iel <div>
        return $this->dataBetweenKnowTags('Name:</td><td>' , ' <div' , $html);
    }

    /**
     * Get Character Vocation..
     * @param $html
     * @return string
     */
    private function extractVocation($html)
    {
        // Vocation:</td><td>Elite Knight</td>
        return $this->dataBetweenKnowTags('Vocation:</td><td>' , '</td>' , $html);
    }

    /**
     * Get Character Level
     * @param $html
     * @return string
     */
    private function extractLevel($html)
    {
        // <td>Level:</td><td>429</td>
        return $this->dataBetweenKnowTags('Level:</td><td>' , '</td>' , $html);
    }

    /**
     * Get Character Residence
     * @param $html
     * @return string
     */
    private function extractResidence($html)
    {
        //<td>Residence:</td><td>Roshamuul</td>
        return $this->dataBetweenKnowTags('Residence:</td><td>' , '</td>' , $html);
    }

    /**
     * Get Character World
     * @param $html
     * @return string
     */
    private function extractWorld($html)
    {
        //<td>World:</td><td>Garnera</td>
        return $this->dataBetweenKnowTags('World:</td><td>' , '</td>' ,$html);
    }

    /**
     * Get Character Last Death (30 days)
     * @param $html
     * @return null|string
     */
    private function extractLastDeath($html)
    {
        if(! $this->hasDeaths($html))
        {
            return NULL;
        }

        return $this->dataBetweenKnowTags('<td width="25%" valign="top" >' , '</td>' , $html);
    }

    /**
     * Did the character has deaths on the page?
     * @param $html
     * @return bool
     */
    private function hasDeaths($html)
    {
        $explode = explode('<b>Character Deaths</b></td>' , $html);
        return (count($explode) > 1) ? TRUE : FALSE;
    }

    /**
     * Get all attributes of a character in a array.
     * @return array
     */
    public function attributes()
    {
        $html = $this->getHtml(self::baseUrl.$this->name);

        $attributes = [
            'name'          => $this->extractName($html),
            'vocation'      => $this->extractVocation($html),
            'level'         => $this->extractLevel($html),
            'residence'     => $this->extractResidence($html),
            'world'         => $this->extractWorld($html),
            'last_death'    => $this->extractLastDeath($html),
        ];
        return $attributes;
    }

}
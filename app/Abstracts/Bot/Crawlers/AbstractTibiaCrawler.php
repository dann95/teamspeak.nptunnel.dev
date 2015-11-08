<?php

namespace NpTS\Abstracts\Bot\Crawlers;

use NpTS\Domain\Bot\Web\Grabber;

abstract class AbstractTibiaCrawler
{

    protected $grabber;

    public function __construct()
    {
        $this->grabber = app(Grabber::class);
    }

    /**
     * Encode a Name for links
     * @param $name
     * @return string
     */
    public function encodeName($name)
    {
        $name = str_replace(' ' , '%20' , $name);
        $name = str_replace("'" , '%27' , $name);
        return $name;
    }

    /**
     * Decode a name used on links..
     * @param $name
     * @return mixed
     */
    public function decodeName($name)
    {
        $name = str_replace('%20' , ' ' , $name);
        $name = str_replace('%27' , "'" , $name);
        return $name;
    }

    /**
     * Grab Html content from page.
     * @param $url
     * @return string
     */
    public function getHtml($url)
    {
        return $this->grabber->grab($url);
    }

    /**
     * Get content between two know tags like <td>:data:</td>
     * @param string $startTag
     * @param string $endTag
     * @param string $content
     * @return string
     */
    public function dataBetweenKnowTags($startTag , $endTag , $content)
    {
        $data = explode($startTag , $content);
        $data = $data[1];
        $data = explode($endTag , $data);
        $data = $data[0];
        return $data;
    }
}
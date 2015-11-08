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
        $name = str_replace('+' , ' ', $name);
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

    /**
     * Get array With Elements between know tags like <td>:data1:</td> <td>:data2:</td>
     * @param $startTag
     * @param $endTag
     * @param $content
     * @return array
     */
    public function arrayDataByKnowTags($startTag , $endTag , $content)
    {
        $dataAll = explode($startTag , $content);
        for ($i = 1; $i <= count($dataAll)-1; $i++)
        {
            $data[] = explode($endTag , $dataAll[$i])[0];
        }
        return $data;
    }
}
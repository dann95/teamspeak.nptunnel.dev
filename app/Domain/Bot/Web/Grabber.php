<?php

namespace NpTS\Domain\Bot\Web;

use NpTS\Domain\Bot\Web\Contracts\GrabberContract;
use NpTS\Domain\Bot\Models\CrawlerIp;

class Grabber implements GrabberContract
{
    private $model;
    public function __construct(CrawlerIp $model)
    {
        $this->model = $model;
    }

    public function grab($url)
    {
        return $this->getHtmlContent($url);
    }

    private function getHtmlContent($url)
    {
        return file_get_contents($url , FALSE , $this->getStreamContext());
    }

    private function getStreamContext()
    {
        return stream_context_create([
            'socket'    =>  [
                'bindto'    =>  $this->getIp()
            ]
        ]);
    }

    private function getIp()
    {
        $ip = $this->model->all()->sortBy('usage')->first();
        $ip->increaseUsage();
        return $ip->ip.":0";
    }
}
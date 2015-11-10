<?php

namespace NpTS\Domain\Bot\Web;

use NpTS\Domain\Bot\Web\Contracts\GrabberContract;

class Grabber implements GrabberContract
{
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
                'bindto'    =>  $this->getIps()->random()
            ]
        ]);
    }

    private function getIps()
    {
        return collect(config('ips'));
    }
}
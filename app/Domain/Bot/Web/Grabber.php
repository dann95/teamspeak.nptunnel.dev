<?php

namespace NpTS\Domain\Bot\Web;

use NpTS\Domain\Bot\Web\Contracts\GrabberContract;

class Grabber implements GrabberContract
{
    public function grab($url)
    {
        return $this->getHtmlContent($url);
    }

    public function getHtmlContent($url)
    {
        return file_get_contents($url);
    }
}
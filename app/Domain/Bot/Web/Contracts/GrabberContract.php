<?php

namespace NpTS\Domain\Bot\Web\Contracts;

interface GrabberContract
{
    public function grab($url);
}
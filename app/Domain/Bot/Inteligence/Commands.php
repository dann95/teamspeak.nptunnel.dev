<?php

namespace NpTS\Domain\Bot\Inteligence;

use NpTS\Domain\Bot\Service\Respawn;

class Commands
{
    private $commands = [
        '!resp' =>  \NpTS\Domain\Bot\Inteligence\Commands\Respawn::class,
        '!respnext' =>  \NpTS\Domain\Bot\Inteligence\Commands\RespawnNext::class,
        '!respdel'  =>  \NpTS\Domain\Bot\Inteligence\Commands\RespawnDel::class,
        '!respnextdel' => \NpTS\Domain\Bot\Inteligence\Commands\RespawnNextDel::class,
    ];

    private $request;
    private $api_key;

    public function __construct($api_key , $request)
    {
        $this->api_key = $api_key;
        $this->request = $request;
    }


    private function isValidCommand($command)
    {
        return in_array(strtolower($command) , array_keys($this->commands));
    }


    public function execute()
    {

        if($this->isValidCommand(explode(' ' , $this->request->msg)[0]))
        {
            $class = $this->getCommandClassName(strtolower(explode(' ' , $this->request->msg)[0]));
            return (new $class($this->api_key , $this->request))->handle();
        }
        return call_user_func_array(array($this , 'commandNotFound'),[]);
    }

    private function getCommandClassName($command)
    {
        return $this->commands[$command];
    }

    public function commandNotFound()
    {
        return json_encode(['type'=>'notFound']);
    }
}
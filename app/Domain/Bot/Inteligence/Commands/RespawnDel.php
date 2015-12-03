<?php

namespace NpTS\Domain\Bot\Inteligence\Commands;

use NpTS\Domain\Bot\Service\Exceptions\RespawnIsNotClaimed;
use NpTS\Domain\Bot\Service\Exceptions\RespawnNumberDosntExists;
use NpTS\Domain\Bot\Service\Exceptions\YouAreNotTheOwnerOfTheRespawn;
use NpTS\Domain\Bot\Service\Respawn as RespawnService;

class RespawnDel
{
    public function __construct($api_key , $request)
    {
        $this->api_key = $api_key;
        $this->request = $request;
        $service = app(RespawnService::class);
        $this->respawnService = $service->setApiKey($this->api_key);
    }

    public function handle()
    {
        $arguments = explode(' ' , $this->request->msg);
        unset($arguments[0]);

        if(! count($arguments))
            return json_encode(['type' => 'found' , 'msg' => 'Comando invalido, !respdel X onde [b]x[/b] é o número de respawn.. [b]!help  !ayuda  !ajuda[/b]']);

        try{
            $response = $this->respawnService->deleteRespawn($arguments[1],$this->request->cid,$this->request->uid ,$this->request->groups);
        }catch(RespawnNumberDosntExists $e)
        {
            return json_encode(['type' => 'found' , 'msg' => "Respawn como esse número não existe, veja o channel! [b]!help !ayuda !ajuda[/b]"]);
        }catch(RespawnIsNotClaimed $e)
        {
            return json_encode(['type' => 'found' , 'msg' => "Esse respawn está free!"]);
        }catch(YouAreNotTheOwnerOfTheRespawn $e)
        {
            return json_encode(['type' => 'found' , 'msg' => "Você não é dono desse respawn!"]);
        }

        return json_encode(['type' => 'found' , 'msg' => "Respawn deletado"]);
    }
}
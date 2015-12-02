<?php


namespace NpTS\Domain\Bot\Inteligence\Commands;

use NpTS\Domain\Bot\Service\Exceptions\RespawnNumberDosntExists;
use NpTS\Domain\Bot\Service\Exceptions\UserDontHavePermissionToClaimRespawn;
use NpTS\Domain\Bot\Service\Respawn as RespawnService;

class Respawn
{
    private $api_key;
    private $request;

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
            return json_encode(['type' => 'found' , 'msg' => 'Comando invalido, !resp X onde [b]x[/b] é o número de respawn.. [b]!help  !ayuda  !ajuda[/b]']);


        try{
            $response = $this->respawnService->claimRespawn($arguments[1],$this->request->cid,$this->request->uid,$this->request->nick , $this->request->groups);
            return json_encode(['type' => 'found' , 'msg' => $response]);
        }catch(RespawnNumberDosntExists $e)
        {
            return json_encode(['type' => 'found' , 'msg' => 'Número de respawn inválido, veja o channel!']);
        }catch(UserDontHavePermissionToClaimRespawn $e)
        {
            return json_encode(['type' => 'found' , 'msg' => 'Sem permissão de marcar respawn / no permission to claim respawn!']);
        }
    }
}
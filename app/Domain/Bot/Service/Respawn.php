<?php

namespace NpTS\Domain\Bot\Service;

use NpTS\Domain\Bot\Service\Exceptions\RespawnNumberDosntExists;
use NpTS\Domain\Bot\Models\Respawn as RespawnModel;
use NpTS\Domain\Bot\Models\TsBot as BotModel;
use NpTS\Domain\Bot\Service\Exceptions\UserDontHavePermissionToClaimRespawn;

class Respawn
{
    private $apiKey;
    private $respawnModel;
    public function __construct()
    {
        $this->respawnModel = app(RespawnModel::class);
        $this->botModel = app(BotModel::class);
    }

    public function setApiKey($key)
    {
        $this->apiKey = $key;
        return $this;
    }

    public function claimRespawn($resp_code , $cid , $uid , $nick , $groups)
    {
        // O respawn existe?
        if(! in_array($resp_code , $this->getRespawnsList()))
        {
            throw new RespawnNumberDosntExists;
        }

        // O cliente tem permissão de marcar resp?
        if(! count(array_intersect(explode(',',$groups) , $this->getAllowedGroupsToClaimRespawn())))
        {
            throw new UserDontHavePermissionToClaimRespawn;
        }

        if($this->isRespawnBusy($resp_code , 1))
        {
            return "[b][color=red]{$this->getRespawnByCode($resp_code)->respawn->name} ocupado a ".date("H:i",time()-$this->getRespawnByCode($resp_code)->created_at->timestamp)." por {$this->getRespawnByCode($resp_code)->client} [/color][/b]";
        }

        $this->getTibiaList()->claimedRespawns()
            ->create([
            'respawn_id'    =>  $resp_code,
            'state'         =>  1,
            'uid'           =>  $uid,
            'cid'           =>  $cid,
            'nick'          => $nick,
        ]);

        return 'Respawn adicionado!';

    }

    public function respnext()
    {
        //...
    }

    public function respdel()
    {
        //...
    }

    /**
     * @return Collection
     */
    private function getRespawnsList()
    {
        return $this->respawnModel->all()->lists('code')->toArray();
    }

    private function getAllowedGroupsToClaimRespawn()
    {
        return $this->getTibiaList()
            ->allowedGroupsClaimResp
            ->lists('group_id')
            ->toArray();
    }

    private function getTibiaList()
    {
        return $this->botModel->where(['api_code' => $this->apiKey])
            ->get()
            ->first()->tibiaList;
    }

    private function getClaimedRespawns()
    {
        return $this->getTibiaList()
            ->claimedRespawns;
    }

    private function isRespawnBusy($code , $state)
    {
        return count($this->getClaimedRespawns()->filter(function($respawn) use($code,$state){
            return (($respawn->respawn_id == $code) && ($respawn->state == $state));
        }));
    }

    private function getRespawnByCode($code)
    {
        return $this->getClaimedRespawns()->filter(function($respawn) use($code){
            return (($respawn->respawn_id == $code));
        })->first();
    }
}
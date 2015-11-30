<?php

namespace NpTS\Domain\Bot\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Bot\Models\TibiaList;
use NpTS\Domain\Client\Models\VirtualServer;

class TsBot extends Model
{

    protected $fillable = [
        'tibia_list',
        'auto_afk',
        'max_afk_time',
        'afk_ch_id',
        'login',
        'name',
        'is_installed',
        'password',
        'api_code'
    ];

    protected $hidden = [
        'api_code',
        'created_at',
        'updated_at',
        'id',
        'vserver_id',
        'tibia_list',
    ];

    public function tibiaList()
    {
        return $this->hasOne(TibiaList::class , 'ts_bot_id');
    }

    public function vserver()
    {
        return $this->belongsTo(VirtualServer::class);
    }

    public function getCredentialsAttribute()
    {
        return [
            'user'  =>  $this->login,
            'pass'  =>  $this->password,
            'nick'  =>  $this->name,
            'port'  =>  $this->vserver->port,
            'ip'    =>  $this->vserver->server()->ip,
        ];
    }
}

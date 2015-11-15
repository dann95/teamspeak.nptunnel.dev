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
    ];

    public function tibiaList()
    {
        return $this->hasOne(TibiaList::class , 'ts_bot_id');
    }

    public function vserver()
    {
        return $this->belongsTo(VirtualServer::class);
    }
}

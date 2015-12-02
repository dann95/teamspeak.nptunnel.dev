<?php

namespace NpTS\Domain\Bot\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Bot\Models\Respawn;

class AssignedRespawn extends Model
{
    protected $fillable = [
        'tibia_list_id',
        'respawn_id',
        'state',
        'uid',
        'cid',
        'nick',
    ];

    public function getClientAttribute()
    {
        return "[url=client://{$this->cid}/{$this->uid}]{$this->nick}[/url]";
    }

    public function respawn()
    {
        return $this->belongsTo(Respawn::class);
    }
}

<?php

namespace NpTS\Domain\Bot\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedRespawn extends Model
{
    protected $fillable = [
        'tibia_list_id',
        'respawn_id',
        'state'
    ];
}

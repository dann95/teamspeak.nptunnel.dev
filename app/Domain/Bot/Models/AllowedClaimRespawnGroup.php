<?php

namespace NpTS\Domain\Bot\Models;

use Illuminate\Database\Eloquent\Model;

class AllowedClaimRespawnGroup extends Model
{
    protected $fillable = [
        'tibia_list_id',
        'group_id',
    ];
}

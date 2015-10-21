<?php

namespace NpTS\Domain\Client\Models;

use Illuminate\Database\Eloquent\Model;

class VirtualServer extends Model
{
    protected $fillable = [
        'name',
        'server_id',
        'v_sid',
        'plan_id',
        'port'
    ];
}

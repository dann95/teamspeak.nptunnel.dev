<?php

namespace NpTS\Domain\Client\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Client\Models\VirtualServer;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'virtual_server_id',
        'active'
    ];

    public function virtualServer()
    {
        return $this->belongsTo(VirtualServer::class)->get()->first();
    }
}

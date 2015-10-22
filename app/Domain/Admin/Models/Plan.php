<?php

namespace NpTS\Domain\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Client\Models\VirtualServer;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'active',
        'slots',
        'price'
    ];

    /**
     * An plan has many virtual servers.
     * @return Collection
     */
    public function virtualServers()
    {
        return $this->hasMany(VirtualServer::class)->get();
    }
}

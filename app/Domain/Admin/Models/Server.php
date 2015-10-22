<?php

namespace NpTS\Domain\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Client\Models\VirtualServer;

class Server extends Model
{
    /**
     * Fillable filds.
     * @var array
     */
    protected $fillable = [
        'ip',
        'name',
        'dns',
        'user',
        'password',
        'slots',
        'max_slots',
    ];

    /**
     * An server has many virtual servers.
     * @return Collection
     */
    public function virtualServers()
    {
        return $this->hasMany(VirtualServer::class)->get();
    }

    /**
     * shortcut to put usage on view.
     * @return string
     */
    public function getUsageAttribute()
    {
        return $this->slots."/".$this->max_slots;
    }

    /**
     * How many slots this server got free?
     * @return int
     */
    public function getFreeSlotsAttribute()
    {
        $number = $this->max_slots-$this->slots;

        if($number > 0)
            return $number;

        return 0;
    }

    /**
     * Credentials to login in this server as serveradmin.
     * @return array
     */
    public function getCredentialsAttribute()
    {
        return [
            'ip'        =>  $this->ip,
            'user'      =>  $this->user,
            'password'  =>  $this->password,
        ];
    }

}

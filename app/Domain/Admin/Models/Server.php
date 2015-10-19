<?php

namespace NpTS\Domain\Admin\Models;

use Illuminate\Database\Eloquent\Model;

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
}

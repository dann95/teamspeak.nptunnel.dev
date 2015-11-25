<?php

namespace NpTS\Domain\Bot\Models;

use Illuminate\Database\Eloquent\Model;

class Respawn extends Model
{
    protected $fillable = [
        'name',
        'code'
    ];
}

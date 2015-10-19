<?php

namespace NpTS\Domain\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'active',
        'slots',
        'price'
    ];
}

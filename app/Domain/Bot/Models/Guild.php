<?php

namespace NpTS\Domain\Bot\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Bot\Models\TibiaList;

class Guild extends Model
{
    protected $fillable = [
        'name'
    ];

    public function tibiaList()
    {
        return $this->belongsTo(TibiaList::class);
    }
}

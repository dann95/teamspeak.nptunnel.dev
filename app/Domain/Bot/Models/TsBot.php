<?php

namespace NpTS\Domain\Bot\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Bot\Models\TibiaList;

class TsBot extends Model
{
    public function tibiaList()
    {
        return $this->hasOne(TibiaList::class , 'ts_bot_id');
    }
}

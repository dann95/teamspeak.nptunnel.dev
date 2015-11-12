<?php

namespace NpTS\Domain\Bot\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Bot\Models\Vocation;
use NpTS\Domain\Bot\Models\World;

class Character extends Model
{
    /**
     * An Character belongs to a vocation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vocation()
    {
        return $this->belongsTo(Vocation::class);
    }

    public function world()
    {
        return $this->belongsTo(World::class);
    }
}

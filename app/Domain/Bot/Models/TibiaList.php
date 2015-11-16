<?php

namespace NpTS\Domain\Bot\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Bot\Models\Character;
use NpTS\Domain\Bot\Models\Guild;

class TibiaList extends Model
{

    protected $fillable = [
        'enemy_ch_id',
        'friend_ch_id'
    ];

    public function onlineFriends()
    {
        return $this->friends()->where('online','1');
    }

    public function onlineEnemies()
    {
        return $this->enemies()->where('online','1');
    }

    public function friends()
    {
        return $this->characters->where('position','1');
    }

    public function enemies()
    {
        return $this->characters->where('position','0');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function guilds()
    {
        return $this->hasMany(Guild::class);
    }
}

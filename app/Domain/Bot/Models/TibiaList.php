<?php

namespace NpTS\Domain\Bot\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Bot\Models\Character;
use NpTS\Domain\Bot\Models\Guild;
use NpTS\Domain\Bot\Models\TsBot;

class TibiaList extends Model
{

    protected $fillable = [
        'enemy_ch_id',
        'friend_ch_id',
        'world_id'
    ];

    public function onlineFriends()
    {
        return $this->friends()
            ->filter(function($char){
                return (($char->world_id == $this->world_id) && (! $char->wasDeleted) && ($char->online));
            })
            ->sortByDesc('lvl');
    }

    public function onlineEnemies()
    {
        return $this->enemies()
            ->filter(function($char){
                return (($char->world_id == $this->world_id) && (! $char->wasDeleted) && ($char->online));
            })
            ->sortByDesc('lvl');
    }

    public function friends()
    {
        return $this->characters->filter(function($char){
            return ($char->position == 1);
        });
    }

    public function enemies()
    {
        return $this->characters->filter(function($char){
            return ($char->position == 0);
        });
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

    public function tsBot()
    {
        return $this->belongsTo(TsBot::class);
    }
}

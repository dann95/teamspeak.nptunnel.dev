<?php

namespace NpTS\Domain\Bot\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Bot\Models\Character;

class World extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    /**
     * @return Colllection
     */
    public function onlineCharacters()
    {
        return $this->characters->filter(function($char){
            return (($char->exists) && ($char->online));
        });
    }
}

<?php

namespace NpTS\Domain\Bot\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Bot\Models\Vocation;
use NpTS\Domain\Bot\Models\World;
use NpTS\Domain\Bot\Models\TibiaList;

class Character extends Model
{

    protected $dates = [
        'online_since',
        'updated_at',
        'created_at'
    ];
    protected $fillable = [
        'tibia_list_id',
        'online',
        'position',
        'vocation_id',
        'world_id',
        'residence',
        'last_death',
        'register_lvl',
        'lvl',
        'name'
    ];
    /**
     * An Character belongs to a vocation.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vocation()
    {
        return $this->belongsTo(Vocation::class);
    }

    /**
     * An character belongs to a world.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function world()
    {
        return $this->belongsTo(World::class);
    }


    /**
     * What is the link to view this char at tibia.com?
     * @return string
     */
    public function getUrlAttribute()
    {
        $name = str_replace(' ' , '%20' , $this->name);
        $name = str_replace("'" , '%27' , $name);
        return 'https://secure.tibia.com/community/?subtopic=characters&name='.$name;
    }

    /**
     * How much lvls this char up or loose since was added to the list?
     * @return string
     */
    public function getChangesLvlAttribute()
    {
        return (($this->lvl >= $this->register_lvl)) ? '+'.($this->lvl - $this->register_lvl) : '-'.($this->register_lvl - $this->lvl);
    }

    public function tibiaList()
    {
        return $this->belongsTo(TibiaList::class);
    }
}

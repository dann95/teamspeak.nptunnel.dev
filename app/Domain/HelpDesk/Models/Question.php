<?php

namespace NpTS\Domain\HelpDesk\Models;

use Illuminate\Database\Eloquent\Model;

use NpTS\Domain\HelpDesk\Models\Answer;
use NpTS\Domain\Client\Models\User;

class Question extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'body'
    ];
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace NpTS\Domain\HelpDesk\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Client\Models\User;

class Answer extends Model
{
    protected $fillable = [
        'user_id',
        'body'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

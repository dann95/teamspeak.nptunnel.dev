<?php

namespace NpTS\Domain\HelpDesk\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    protected $fillable = [
        'id',
        'name'
    ];
}

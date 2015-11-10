<?php

namespace NpTS\Domain\Bot\Models;

use Illuminate\Database\Eloquent\Model;

class CrawlerIp extends Model
{
    protected $fillable = [
        'ip',
        'usage'
    ];

    public function increaseUsage()
    {
        $this->usage += 1;
        $this->save();
    }
}

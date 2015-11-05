<?php

namespace NpTS\Domain\Client\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceStatus extends Model
{
    protected $fillable = [
        'id',
        'status'
    ];
}

<?php

namespace NpTS\Domain\Client\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Client\Models\User;
use NpTS\Domain\Client\Models\InvoiceService;
use NpTS\Domain\Client\Models\InvoiceStatus;
class Invoice extends Model
{
    protected $fillable = [
        'user_id',
        'invoice_status_id',
    ];

    public function items()
    {
        return $this->hasMany(InvoiceService::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->get();
    }

    public function getTotalAttribute()
    {
        $total = 0;
        foreach($this->items()->get() as $item)
        {
            $total += $item->plan()->price;
        }
        return "R$ ".number_format($total,2);
    }

    public function getStatusAttribute()
    {
        return $this->belongsTo(InvoiceStatus::class , 'invoice_status_id')->get()->first()->status;
    }

}

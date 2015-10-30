<?php

namespace NpTS\Domain\Client\Models;

use Illuminate\Database\Eloquent\Model;
use NpTS\Domain\Client\Models\Invoice;
use NpTS\Domain\Admin\Models\Plan;

class InvoiceService extends Model
{
    protected $fillable = [
        'plan_id',
        'invoice_id',
        'vserver_name',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class)->get();
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class)->get();
    }
}

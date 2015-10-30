<?php

namespace NpTS\Domain\Client\Repositories;

use NpTS\Abstracts\Repository\Repository;
use NpTS\Domain\Client\Repositories\Contracts\InvoiceRepositoryContract;
use NpTS\Domain\Client\Models\Invoice;
use Illuminate\Auth\Guard;


class InvoiceRepository extends Repository implements InvoiceRepositoryContract
{
    protected $model;
    private $guard;
    public function __construct(Invoice $model , Guard $guard)
    {
        $this->model = $model;
        $this->guard = $guard;
    }

    public function create(array $options)
    {
        $invoice = $this->model->create([
            'user_id' => $this->guard->user()->id,
            'invoice_status_id' =>  1
        ]);
        $items = $options['items'];
        $items->each(function($item , $key)use($invoice){
                $invoice->items()->create([
                    'plan_id' => $item['plan']->id,
                    'vserver_name' => $item['name'],
                ]);
        });

        return $invoice;
    }
}
<?php

namespace NpTS\Domain\Client\Service;

use NpTS\Domain\Client\Repositories\Contracts\VirtualServerRepositoryContract;
use NpTS\Domain\Client\Repositories\Contracts\SubscriptionRepositoryContract;
use NpTS\Domain\Admin\Repositories\Contracts\PlanRepositoryContract;
use NpTS\Domain\Client\Models\Invoice;

class VirtualServer
{
    private $vsRepository;
    private $subscriptionRepository;
    public function __construct()
    {
        $this->vsRepository = app(VirtualServerRepositoryContract::class);
        $this->subscriptionRepository = app(SubscriptionRepositoryContract::class);
    }

    public function create(Invoice $invoice)
    {
        // TODO: Separe each service
        $services = $invoice->items;
        // TODO: create each service
        $services->each(function($item , $key)use($invoice){
            $server = $this->vsRepository->create([
                'plan'  => $item->plan(),
                'name'  => $item->vserver_name,
                'user_id'   =>  $invoice->user_id,
            ]);
            $this->subscriptionRepository->create([
                'user_id' => $invoice->user_id,
                'virtual_server_id' =>  $server->id,
                'active'    =>  1
            ]);
            // TODO: create the tsBot and TibiaList..
            $server->bot()->create([

            ])->tibiaList()->create([

            ]);
        });
        $invoice->invoice_status_id = 3;
        $invoice->save();
        return true;
    }

    public function deactivate()
    {

    }

    public function reactivate()
    {

    }

    public function reallocate()
    {

    }
}